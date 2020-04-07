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
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','user_id','notes',$lang.'_desc','inventory_image')->get();
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
            'price' => 'required|numeric|min:0|not_in:0',
            'inventory_image' => 'required',
            'en_desc' => 'required',
            'ar_desc' => 'required',
        ]);

        $inventory = new Inventory();

        $inventory->en_name = $request->en_name;
        $inventory->ar_name = $request->ar_name;
        $inventory->quantity = $request->quantity;
        $inventory->price = $request->price;
        $inventory->notes = $request->notes;
        $inventory->user_id = $request->user_id;
        $inventory->en_desc = $request->en_desc;
        $inventory->ar_desc = $request->ar_desc;

        $image_path = public_path().'/uploads/inventories/';
        File::makeDirectory($image_path, $mode = 0777, true, true);

        if ($request->hasFile('inventory_image')){
            $imageName = time().'.'.request()->inventory_image->getClientOriginalExtension();
            $request->inventory_image->move($image_path, $imageName);
            $inventory->inventory_image = $imageName;
        }


        $inventory->save();

        return redirect()->route('inventory')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_inventory'))
            abort(403);
        $lang = \Lang::getLocale();
        $item = Inventory::select('*')->where('id',$id)->get()->first();
        
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
            'price' => 'required|numeric|min:0|not_in:0',
        ]);

        $inventory->en_name = $request->en_name;
        $inventory->ar_name = $request->ar_name;
        $inventory->quantity = $request->quantity;
        $inventory->price = $request->price;
        $inventory->notes = $request->notes;
        $inventory->user_id = $request->user_id;
        $inventory->en_desc = $request->en_desc;
        $inventory->ar_desc = $request->ar_desc;

        $image_path = public_path().'/uploads/inventories/';
        File::makeDirectory($image_path, $mode = 0777, true, true);

        if ($request->hasFile('inventory_image')){
            $path = $image_path . $inventory->inventory_image;
            if(file_exists($path)) {
                File::delete($path);
            }
            $imageName = time().'.'.request()->inventory_image->getClientOriginalExtension();
            $request->inventory_image->move($image_path, $imageName);
            $inventory->inventory_image = $imageName;
        }

        
        $inventory->save();

        return redirect()->route('inventory')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_inventory'))
            abort(403);
        $inventory = Inventory::findOrfail($id);
        $image_path = public_path().'/uploads/inventories/';
        File::makeDirectory($image_path, $mode = 0777, true, true);
        $path = $image_path . $inventory->inventory_image;
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
