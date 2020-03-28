<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inventory;
use App\User;
use App\Customer;
use App\Withdraw;
use Auth;
use Image;
use File;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_inventory'))
            abort(403);

        $lang = \Lang::getLocale();
        $customers = Customer::all();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes',$lang.'_desc','inventory_image')->get();
        return view('backend.pages.inventory.index',compact('inventory','customers'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_inventory'))
            abort(403);
    
        $users = User::all();
        
        return view('backend.pages.inventory.create',compact('users'));
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_inventory'))
            abort(403);

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'quantity' => 'required|numeric|min:0|not_in:0',
            'orignal_price' => 'required|numeric|min:0|not_in:0',
            'price' => 'required|numeric|min:0|not_in:0',
            'add_value' => 'required|numeric',
            'inventory_image' => 'required',
            'en_desc' => 'required',
            'ar_desc' => 'required',
        ]);

        $inventory = new Inventory();

        $inventory->en_name = $request->en_name;
        $inventory->ar_name = $request->ar_name;
        $inventory->quantity = $request->quantity;
        $inventory->price = $request->price;
        $inventory->orignal_price = $request->orignal_price;
        $inventory->add_value = $request->add_value;
        $inventory->total_price = $request->add_value + ($request->quantity * $request->price);
        $inventory->total_orignal_price = $request->quantity * $request->orignal_price;
        $inventory->notes = $request->notes;
        $inventory->user_id = $request->user_id;
        $inventory->en_desc = $request->en_desc;
        $inventory->ar_desc = $request->ar_desc;

        if ($request->hasFile('inventory_image')) {

            $image = $request->file('inventory_image');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/inventories');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/inventories');

            $image->move($destinationPath, $image_name);
            $inventory->inventory_image = $image_name;

        }

        $inventory->save();

        return redirect()->route('inventory')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_inventory'))
            abort(403);
        $lang = \Lang::getLocale();
        $item = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes','en_desc','ar_desc','inventory_image')->where('id',$id)->get()->first();
        
        return view('backend.pages.inventory.show',compact('item'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_inventory'))
            abort(403);
        $item = Inventory::findOrfail($id);
        $users = User::all();
        return view('backend.pages.inventory.edit',compact('item','users'));
    }

    public function updateQuantity(Request $request,$id)
    {
        if(!Auth::user()->hasPermissionTo('edit_inventory'))
            abort(403);
        $request->validate([
            'newQty' => 'required|max:255|min:0'
        ]);

        $inventory = Inventory::findOrfail($request->item_id);
        $inventory->quantity = $inventory->quantity + $request->newQty;
        $inventory->save();
        return back()->with('success','');
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_inventory'))
            abort(403);
        $inventory = Inventory::findOrfail($id);

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'quantity' => 'required|numeric|min:0|not_in:0',
            'orignal_price' => 'required|numeric|min:0|not_in:0',
            'price' => 'required|numeric|min:0|not_in:0',
            'add_value' => 'required|numeric',
        ]);

        $inventory->en_name = $request->en_name;
        $inventory->ar_name = $request->ar_name;
        $inventory->quantity = $request->quantity;
        $inventory->price = $request->price;
        $inventory->orignal_price = $request->orignal_price;
        $inventory->add_value = $request->add_value;
        $inventory->total_price = $request->add_value + ($request->quantity * $request->price);
        $inventory->total_orignal_price = $request->quantity * $request->orignal_price;
        $inventory->notes = $request->notes;
        $inventory->user_id = $request->user_id;
        $inventory->en_desc = $request->en_desc;
        $inventory->ar_desc = $request->ar_desc;

        if ($request->hasFile('inventory_image')) {

            $path = public_path() . '/inventories/' . $inventory->inventory_image;
            if(file_exists($path)) {
                File::delete($path);
            }

            $image = $request->file('inventory_image');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/inventories');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/inventories');

            $image->move($destinationPath, $image_name);
            $inventory->inventory_image = $image_name;

        }

        $inventory->save();

        return redirect()->route('inventory')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_inventory'))
            abort(403);
        $inventory = Inventory::findOrfail($id);
        $path = public_path() . '/inventories/' . $inventory->inventory_image;
        if(file_exists($path)) {
            File::delete($path);
        }
        $inventory->delete();

        return redirect()->route('inventory')->with('success','');
    }

    public function items($id){
        $lang = \Lang::getLocale();
        $items = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes')->where('id',$id)->get()->first;
        return response()->json(['items'=>$items]);
    }

    public function withdraw_items($id)
    {
        $inv = Inventory::findOrfail($id);
        return response()->json(['inv'=>$inv]);
    }

    public function withdrawShow(){
        if(!Auth::user()->hasPermissionTo('show_menu_withdraw'))
            abort(403);
        $withdraw = Withdraw::all();
        return view('backend.pages.inventory.withdraw',compact('withdraw'));
    }

    public function withdraw(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('withdraw_inventory'))
            abort(403);

        $inventory = Inventory::findOrfail($request->item_inv);

        $withdraw = new Withdraw();
        $withdraw->inventory_id = $request->item_inv;
        $withdraw->customer_id = $request->customer_inv;
        $withdraw->quantity = $request->inv_quantity;
        $withdraw->total_price = ($request->inv_quantity * $inventory->price) + $inventory->add_value;
        $withdraw->save();

        
        $inventory->quantity = $inventory->quantity - $request->inv_quantity;
        $inventory->save();
        return redirect()->route('inventory')->with('success','');
    }

    
}
