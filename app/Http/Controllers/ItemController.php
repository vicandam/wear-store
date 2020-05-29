<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Attribute;
use App\AttributeValues;
use App\ItemAttribute;
use App\OrderedItemAttribute;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class ItemController extends Controller
{
    public function index(Request $request, $inventory = false)
    {    
        $input = ($request->all() == null ?  json_decode($request->getContent(), true) : $request->all() );

        $keyword = isset($input['keyword']) ? $input['keyword'] : '';
        $category = isset($input['category_name']) ? $input['category_name'] : '';
        
        $categories = Category::all();

        $items = new Item;

        if(! empty($keyword)) {            
            $items = Item::Search($keyword);
        }
        else if (! empty($category)) {            
            $items = Item::Search($category);
        }

        $items = $items->orderBy('updated_at', 'desc');

        $items = $items->paginate(10);
        
        $page = $inventory == true ? 'reports.inventory' : 'items.index';

        return view($page, compact('items', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validateInput($request);

        $input = ($request->all() == null ? json_decode($request->getContent(), true) : $request->all() ); 

        $attributes = $input['attributes'];

        $category = Category::find($request->category);

        $items = new Item;
        $attr_val = new AttributeValues;

        DB::transaction(function() use($input, $attributes, $attr_val, $items, $request, $category) {
            if($request->hasFile('photo')){
                $filenameWithExt = $request->file('photo')->getClientOriginalName();
                $filename =pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('photo')->getClientOriginalExtension();
                $fileNameToStore = $filename .'_'.time().'.'.$extension;
                $path = $request->file('photo')->storeAs('public/avatars', $fileNameToStore);
            }

            $user_id = Auth::user()->id;
            $category_id = $input['category'];
            $name = $input['name'];
            $price = $input['price'];
            $quantity = $input['quantity'];
            $dealer_discount = $category->discount;
            
            $items->user_id = $user_id;
            $items->category_id = $category_id;
            $items->name = $name;
            $items->price = $price;
            $items->quantity = $quantity;
            $items->dealer_discount = $dealer_discount;
            
            // this is not final need to update
            $items->store_profit = (40/100) - ($dealer_discount/100);
            
            $discount = ($dealer_discount/100) * $price;

            $items->net_amount = $price - $discount;
            $items->photo = isset($fileNameToStore) ? $fileNameToStore : '';

            $items->save();

            foreach ($attributes as $attribute_id) {

                $item_attr = new ItemAttribute;

                $item_attr->item_id = $items->id;                    
                $item_attr->attribute_id = $attribute_id;
                
                $item_attr->save();
            }
        });

        Session::flash('flash_message', 'Item successfully added.');
        Session::flash('alert', 'alert-success');

        return redirect()->route('items.index');

    }

    public function edit($id)
    {
        $items = Item::find($id);
        $categories = Category::all();
        $item_attributes = ItemAttribute::all();
        $attributes = new Attribute;

        $attributes = $attributes::with('values', 'item_attributes.attribute')->get();

        return view('items.edit', compact(['items', 'categories', 'attributes', 'item_attributes', 'id']));
    }

    public function update(Request $request, Item $item)
    {
        $this->validateInput($request);

        $input = ($request->all() == null ? json_decode($request->getContent(), true) : $request->all() ); 

        $attributes = $input['attributes'];

        $category = Category::find($input['category']);

        if($request->hasFile('photo')){ 
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename =pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename .'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/avatars', $fileNameToStore);
        }

        $items = Item::find($item->id);

        $items->user_id = Auth::user()->id;
        $items->category_id = $input['category'];
        $items->name = $input['name'];
        $items->quantity = $input['quantity'];
        $items->price = $input['price'];
        $items->dealer_discount = $category->discount;

        ItemAttribute::where('item_id', $item->id)->delete();

        foreach ($attributes as $attribute_id) {

            $item_attr = new ItemAttribute;

            $item_attr->item_id = $item->id;                 
            $item_attr->attribute_id = $attribute_id;
            
            $item_attr->save();
        }

        // this is not final need to update        
        $items->store_profit = (18/100) * $request->price;
        $items->net_amount = $request->price - ($request->price * ($category->discount/100));

        isset($fileNameToStore) ? $items->photo = $fileNameToStore : '';
        
        $items->save();

        Session::flash('flash_message', 'Item successfully updated.');
        Session::flash('alert', 'alert-success');

        return redirect()->route('items.index');
    }

    public function destroy($id)
    {

        Item::find($id)->delete();
        Session::flash('flash_message', 'Item deleted successfully');
        Session::flash('alert', 'alert-success');

        return redirect()->route('items.index');
    }

    public function saveAttribute(Request $request)
    {
        $attribute = new Attribute;

        $attribute->name = $request->attribute;

        $attribute->save();

        return  $request->attribute;
    }

    public function updateAttribute(Request $request)
    {
        $attribute = Attribute::find($request->id);

        $attribute->name = $request->value;

        $attribute->save();

        return $request->value;
    }

    public function update_attrvalue(Request $request)
    {
        $attribute = AttributeValues::find($request->id);

        $attribute->attribute_value = $request->value;

        $attribute->save();

        return $request->value;
    }

    public function getAttribute()
    {

        $attributes = new Attribute;
        $item_attribute = new ItemAttribute;

        $attributes = $attributes::with('values', 'item_attributes');
        $item_attribute = $item_attribute::with('attribute')->get();

        $attributes = $attributes->orderBy('created_at', 'desc')->get();

        $info = ['attribute' => $attributes, 'item_attribute' => $item_attribute];
        return $info;
    }

    public function addAttributeValue($id, Request $request)
    {        
        $value = new AttributeValues;

        $value->attribute_value = $request->value;
        $value->attribute_id = $id;

        $value->save();
    }

    private function validateInput($request)
    {
        $this->validate($request,
            [ 
                'name' => 'required|string|max:255', 
                'price' => 'required',
                'quantity' => 'required',
                'category' => 'required',
                'attributes' => 'required'
            ]);
    }
}