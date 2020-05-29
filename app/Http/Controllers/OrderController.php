<?php

namespace App\Http\Controllers;

use App\Order;
use App\Dealer;
use App\Item;
use App\Category;
use App\OrderDetail;
use App\User;
use App\AttributeValues;
use App\ItemAttribute;
use App\OrderedItemAttributes;
use Illuminate\Http\Request;
use paginate;
use DB;
use Session;
use Carbon\Carbon;
use App\PaymentDetails;
use DateTime;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $input = ($request->all() == null ? json_decode($request->getContent(), true) : $request->all() );

        $users = User::all();

        $orders = new Order;

        $orders = $orders->whereStatus('completed');       
        
        if(! empty($input['keyword'])) {
            $orders = Order::Search($input['keyword'])->whereStatus('completed');
        }

        $orders = $orders->orderBy('updated_at', 'desc');

        $orders = $orders->paginate(10);
                
        $amount = 0;
        $total = [];

        foreach ($orders as $order) {
            foreach ($order->order_details as $details) {
                $price = $details->item->price;
                $qty = $details->quantity;

                $amount += $qty * $price;
            }

            $total[$order->id] = $amount;
            $amount = 0;
        }       

        return view('orders.index', compact('orders', 'total', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $input = ($request->all() == null ? json_decode($request->getContent(), true) : $request->all() );

        $keyword = isset($input['keyword']) ? $input['keyword'] : '';
        $category = isset($input['category']) ? $input['category'] : '';

        $dealers = Dealer::all()->load('user');
        $categories = Category::all();

        $items = new Item();

        if(! empty($keyword)) {
            $items = Item::Search($keyword);
        }
        else if (! empty($category)) {
            $items = Item::Search($category);
        }

        $items = $items->paginate(10);

        $values = AttributeValues::all();

        $select = [];

        foreach ($dealers as $dealer) {
            $select[$dealer->id] = $dealer->user->name;
        }
        
        return view('orders.create')
            ->with('select', $select)
            ->with('categories', $categories)
            ->with('items', $items)
            ->with('values', $values)
            ->with('dealers', $dealers);
    }

    public function getDealers()
    {
        $dealers = Dealer::all()->load('user');

        return $dealers;
    }

    public function order_progress(Request $request)
    {
        $dealer_id = $request->dealer_id;

        $items = Item::paginate(5);
        $cetagories = Category::all();

        return view('orders.order-step-2', compact(['items', 'cetagories', 'dealer_id']));

    }
    public function pay_order(Request $request)
    {        
        $input = ($request->all() == null ? json_decode($request->getContent(), true) : $request->all() );

        $auth = auth()->user();

        $pay = new PaymentDetails;

        $this->validate($request, ['total' => 'required|min:1']);

        DB::transaction(function() use ($auth, $pay, $input) {           
            $order_id = $input['order_id'];

            $pay->order_id = $order_id;
            $pay->total = $input['total'];

            $pay->save();

            $order = Order::find($order_id);

            $order->status = 'paid';

            $order->save();

            OrderDetail::where(['order_id' => $order_id])->update(['status' => 'paid']);
        });

        $orders = new Order;

        $orders = $orders->where('dealer_id', $request->dealer_id);

        $orders = $orders->with('payment_details')->get();

        $all_paid = 0;

        foreach ($orders as $order) {                            
            foreach ($order->payment_details as $payment) {
                $all_paid += $payment->total;
            }            
        }

        // Get payment sum
        $total = PaymentDetails::whereOrder_id($input['order_id'])->sum('total');

        return response()->json([
            'message' => 'Payment successfull!', 
            'total' => $input['total'],
            'total_paid' => $total,
            'all_paid' => $all_paid,
            'status' => 'paid'
        ]);
    }

    public function addOrderId(Request $request)
    {
        $input = ($request->all() == null ? json_decode($request->getContent(), true) : $request->all() );        

        $auth = auth()->user();

        $order = new Order;

        $this->validateInput($request);

        DB::transaction(function() use ($auth, $order, $input) {
            $dealer_id = $input['dealer_id']; 

            $user_id = Dealer::whereId($dealer_id)->pluck('user_id');
            
            $order->dealer_id = $dealer_id;
            $order->user_id = $auth->id;
            $order->status = 'pending';

            $order->save();
        });

        $data = ['order_id' => $order->id, 'status' => $order->status];

        return $data;
    }

    public function store(Request $request)
    {
        $input = ($request->all() == null ? json_decode($request->getContent(), true) : $request->all() );

        $dealer = Dealer::whereId($input['dealer_id'])->first(); 

        $credit_balance = $dealer->credit_balanced;
        
        $item = Item::whereId($input['item_id'])->first();

        $price = $item->price;
        $qty = $item->quantity;

        $quantity = $input['qty']; 

        $total = $quantity * floatval($price);            

        if ($quantity > $qty) {
            $data = ["invalid_quantity" => "true"];

            return $data;
        }

        if ($total > $credit_balance ) {
            $data = ["invalid_total" => "true"];

            return $data;
        }
        
        $auth = auth()->user();

        $order_details = new OrderDetail;        

        DB::transaction(function() use ($auth, $order_details, $price, $credit_balance, $input) {
            $order_id         = $input['order_id'];
            $item_id          = $input['item_id'];
            $quantity         = $input['qty']; 
            $dealer_id        = $input['dealer_id'];
            $attributes       = $input['attributes'];
            $attribute_values = array_map("intval", explode(",", $attributes));

            // Save order details
            $order_details->order_id = $order_id;
            $order_details->item_id = $item_id;
            $order_details->quantity = $quantity;

            $order_details->save();
            
            // Update dealer's credit balanced                     
            $dealer_credit_balance = $credit_balance - (floatval($price) * $quantity);

            $dealer = Dealer::find($dealer_id);        

            $dealer->credit_balanced = $dealer_credit_balance;

            $dealer->save();

            // Update items quantity            
            $item = Item::find($item_id);

            $quantity = $item->quantity - $quantity;
            $item->quantity = $quantity;

            $item->save();

            foreach ($attribute_values as $value) {
                # Check if your variable is an integer
                if ( filter_var($value, FILTER_VALIDATE_INT) == true ) {
                    $attributes = new OrderedItemAttributes;

                    // Ordered item attributes save
                    $attributes->item_id = $item_id;
                    $attributes->order_detail_id = $order_details->id;
                    $attributes->attribute_id = AttributeValues::whereId($value)->first()->attribute_id;
                    $attributes->attribute_value_id = $value;

                    $attributes->save();
                }
            }

        });

        $data = ['item_id' => $input['item_id'], 'qty' => $input['qty']];

        return $data;
    }

    public function completeOrder($id)
    {

        $order = Order::find($id);

        $order->status = 'completed';

        $order->save();
        
        OrderDetail::where(['order_id' => $id, 'order_status' => 'pending'])
                    ->update(['order_status' => 'completed']);

        return $order->status;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function pending($id)
    {

        $pending = Order::whereDealer_id($id)->whereStatus('pending')->first();

        
        if (isset($pending->id)) {            
            
            $orders = new Order;

            $orders = $orders->where('id', $pending->id);

            $orders = $orders->with(['order_details' => function($OrderDetail) {

                $OrderDetail->where('order_status', 'pending');

                $OrderDetail->with('item');

            }])->get()->first(); 

            // This will check if an order id has exist in orders table
            if (isset($orders->id)) 
            {    

                if (sizeof($orders->order_details) == 0) 
                {
                    // if all order details are deleted then delate the order id                    
                    $orders->delete();

                    return 'false';
                } 
                else 
                {
                    $amount = 0;
                    foreach ($orders->order_details as $details) 
                    {                            
                        $qty = $details->quantity;
                        $price = $details->item->price;

                        $amount += $qty * $price;
                    }

                    $data = ['orders' => $orders, 'amount' => $amount];

                    return $data;
                }
            } 
            else { return 'false'; }            

        } else { return 'false'; }
    }

    public function getNewOrders($id)
    {
        $orders = Order::find($id)
            ->load(
                'order_details.item_attributes.attribute_value',
                'order_details.item',
                'order_details.item_attributes.attribute'
            );

        $sub_total = 0;
        foreach ($orders->order_details as $order) {
            $sub_total += $order->item->price * $order->quantity;
        }

        $data = [$orders, $sub_total];

        return ['orders' => $orders, 'sub_total' => $sub_total];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $order_id         = $request->orderid;
        $dealer_id        = $request->dealerid;
        $item_id          = $request->itemid;
        $returned_credits = $request->price * $request->quantity;       

        OrderDetail::find($id)->delete();

        // Update item quantity
        $item_quantity = Item::whereId($item_id)
            ->get()
            ->pluck('quantity')
            ->first();
     
        $returned_quantity = $item_quantity + $request->quantity;
 
        $item = Item::find($item_id);
 
        $item->quantity = $returned_quantity;
 
        $item->save();

        // Update dealer's credit
        $dealer_credits = Dealer::whereId($dealer_id)
                ->get()
                ->pluck('credit_balanced')
                ->first();
        
        $dealer = Dealer::find($dealer_id);
        
        $dealer->credit_balanced = $dealer_credits + $returned_credits;
  
        $dealer->save();

        // Get pending orders
        $order_details = new OrderDetail;

        $order_details = $order_details->where('order_id', $order_id)
            ->where('order_status', 'pending')
            ->with('item')
            ->get();        

        if (!$order_details->isEmpty()) {
            $pending = 'true';
        } else {
            $pending = 'false';
        }

        $amount = 0;
        foreach ($order_details as $details) {
            
            $qty = $details->quantity;
            $price = $details->item->price;

            $amount += $qty * $price;

        }        
        
        $data = [
                'deleted' => 'deleted', 
                'pending' => $pending, 
                'order_details' => $order_details, 
                'amount' => $amount, 
                'new_qty' => $returned_quantity
            ];

        return $data;

    }

    public function receipt(Request $request)
    {
        $id = $request->receipt;

        $person = Order::where('id', $id)->with('dealer.user', 'user')->get()->first();
        
        $dealer_name = $person->dealer->user->name;
        $prepared_by = $person->user->name;

        $date_ordered = ($person->created_at)->addDays(30)->toFormattedDateString();

        $orders = new OrderDetail;

        $orders = $orders->where('order_id', $id)->with('item')->get();

        $amount = 0;
        $itemDiscount = 0;
        foreach ($orders as $order) {
            $qty = $order->quantity;
            $price = $order->item->price;
            $itemDiscount += ($order->item->category->discount/100) * $price;
            $amount += $qty * $price;
        }

        return view('reports.receipt', compact(
            'orders',
            'amount',
            'dealer_name',
            'prepared_by',
            'date_ordered',
            'itemDiscount'
        ));
    }

    private function validateInput($request)
    {
        $this->validate($request,
            [ 
                'dealer_id' => 'required'                
            ]);
    }
}
