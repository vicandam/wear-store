<?php

namespace App\Http\Controllers;

use App\Dealer;
use App\User;
use App\Order;
use App\Item;
use Illuminate\Http\Request;
use DB;
use Session;
use Auth;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth = auth()->user();

        $input = ($request->all() == null ?  json_decode($request->getContent(), true) : $request->all() );

        $users = new User();

        $users = $users->whereHas('dealer');

        if(! empty($input['keyword'])) {
            $users = $users->where('name', 'like', '%'. $input['keyword'] . '%');
        } else if (! empty($input['recruiter'])) {
            $users = $users->where('name', 'like', '%'. $input['recruiter'] . '%');
        }

        $users = $users->orderBy('updated_at', 'desc');

        $users = $users->paginate(5);

        foreach($users as $user) {
            $users->dealer = Dealer::where('user_id', $user->id)->get();
        }

        return view('dealers.index', ['users' => $users]);
    }

    public function create()
    {
        $users = User::all();
        return view('dealers.create', compact('users'));
    }

    public function store(Request $request)
    {                

        $input = ($request->all() == null ? json_decode($request->getContent(), true) : $request->all() );

        $user = new User;

        $dealer = new Dealer;

        $this->validateInput($request);

        DB::transaction(function() use ($user, $dealer, $input) {
            $user->name = $input['name'];
            $input['email'] != null ? $user->email = $input['email'] : '';
            $user->email_verified_at = now();
            $user->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
            $user->remember_token = str_random(10);

            $user->save();

            $dealer->user_id = $user->id;
            $dealer->recruiter = $input['dealer_group_recruiter'];
            $dealer->address = $input['address'];
            $dealer->contact_number = $input['contact_number'];
            $dealer->credit_limit = $input['credit_limit'];
            $dealer->credit_balanced = $input['credit_limit'];

            $dealer->save();
        });

        Session::flash('flash_message', 'Dealer successfully added.');
        Session::flash('alert', 'alert-success');

        return redirect()->route('dealers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {           
        $input = ($request->all() == null ? json_decode($request->getContent(), true) : $request->all() );

        $orders = new Order;

        $orders = $orders->where('dealer_id', $id);

        $orders = $orders->with(['order_details' => function($OrderDetail) {         

            $OrderDetail->with('item');       

        }])->with('dealer.user');

        if (! empty($input['keyword'])) {
            $status = $input['keyword'] == 'ordered' ? 'completed' : $input['keyword'];
            $orders = $orders->where('status', 'like', '%'. $status . '%');            
        } else if (! empty($input['status'])){
            $orders = $orders->where('status', 'like', '%'. $input['status'] . '%');            
        }

        $orders = $orders->orderBy('created_at', 'desc');

        $orders = $orders->paginate(10);

        $amount = 0;
        $payables = 0;
        $total_paid = 0;
        $total = [];

        foreach ($orders as $order) {                
            foreach ($order->order_details as $details) {
                $price = $details->item->price;
                $qty = $details->quantity;

                $amount += $qty * ($details->item->price - (($details->item->dealer_discount/100) * $details->item->price));
            }
            foreach ($order->payment_details as $payment) {
                $total_paid += $payment->total;
            }

            $total[$order->id] = $amount;
            $payables += $amount;
            $amount = 0;
        }
        
        $items = Item::all();
        return view('dealers.orders', compact(['orders', 'items', 'total', 'payables', 'total_paid']));
    }

    public function getCreditLimit($id)
    {              
        $dealer = new Dealer;

        $dealer = $dealer->whereId($id)->with('user')->get()->first();

        return $dealer;        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dealer = Dealer::find($id)->load('user');

        $users = User::all();

        return view('dealers.edit', compact(['dealer', 'users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $dealer = Dealer::find($id);
        
        $dealer->contact_number = $request->contact_number;
        $dealer->address = $request->address;
        $dealer->credit_limit = $request->credit_limit;
        $dealer->recruiter = $request->dealer_group_recruiter;

        $dealer->save();

        $user = User::find($dealer->user_id);
        
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        Session::flash('flash_message', 'Dealer successfully updated.');
        Session::flash('alert', 'alert-success');

        return redirect()->route('dealers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dealer  $dealer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dealer = Dealer::find($id)->delete();

        Session::flash('flash_message', 'Dealer successfully deleted.');
        Session::flash('alert', 'alert-success');

        return redirect()->route('dealers.index');
    }

    private function validateInput($request)
    {
        $this->validate($request,
            [ 
                'name' => 'required|string|max:255', 
                'dealer_group_recruiter' => 'required', 
                'address' => 'required', 
                'contact_number' => 'required|size:11'
            ]);
    }
}
