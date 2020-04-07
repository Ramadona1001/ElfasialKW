<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ItemInventory;
use Auth;
use Image;
use File;

class ItemInventoryController extends Controller
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
        $inventory = ItemInventory::select($lang.'_name as name','id','price',$lang.'_desc','inventory_image')->get();
        return view('backend.pages.iteminventory.index',compact('inventory'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_inventory'))
            abort(403);
    
        
        
        return view('backend.pages.iteminventory.create');
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_inventory'))
            abort(403);

        

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'price' => 'required|numeric|min:0|not_in:0',
            'inventory_image' => 'required',
            'en_desc' => 'required',
            'ar_desc' => 'required',
        ]);

        $inventory = new ItemInventory();

        $inventory->en_name = $request->en_name;
        $inventory->ar_name = $request->ar_name;
        $inventory->price = $request->price;
        $inventory->en_desc = $request->en_desc;
        $inventory->ar_desc = $request->ar_desc;

        $image_path = public_path().'/uploads/itemsinventories/';
        File::makeDirectory($image_path, $mode = 0777, true, true);

        if ($request->hasFile('inventory_image')){
            $imageName = time().'.'.request()->inventory_image->getClientOriginalExtension();
            $request->inventory_image->move($image_path, $imageName);
            $inventory->inventory_image = $imageName;
        }

        $inventory->save();

        return redirect()->route('iteminventory')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_inventory'))
            abort(403);
        $item = ItemInventory::findOrfail($id);
        
        
        return view('backend.pages.iteminventory.show',compact('item'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_inventory'))
            abort(403);
        $item = ItemInventory::findOrfail($id);
        return view('backend.pages.iteminventory.edit',compact('item'));
    }


    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_inventory'))
            abort(403);
        $inventory = ItemInventory::findOrfail($id);

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'price' => 'required|numeric|min:0|not_in:0',
        ]);


        $image_path = public_path().'/uploads/itemsinventories/';
        File::makeDirectory($image_path, $mode = 0777, true, true);

        $inventory->en_name = $request->en_name;
        $inventory->ar_name = $request->ar_name;
        $inventory->price = $request->price;
        $inventory->en_desc = $request->en_desc;
        $inventory->ar_desc = $request->ar_desc;

        if ($request->hasFile('inventory_image')) {

            $path = $image_path . $inventory->inventory_image;
            if(file_exists($path)) {
                File::delete($path);
            }

            $imageName = time().'.'.request()->inventory_image->getClientOriginalExtension();
            $request->inventory_image->move($image_path, $imageName);
            $inventory->inventory_image = $imageName;

        }

        $inventory->save();

        return redirect()->route('iteminventory')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_inventory'))
            abort(403);
        $image_path = public_path().'/uploads/itemsinventories/';
        File::makeDirectory($image_path, $mode = 0777, true, true);

        $inventory = ItemInventory::findOrfail($id);
        $path = $image_path . $inventory->inventory_image;
        if(file_exists($path)) {
            File::delete($path);
        }
        $inventory->delete();

        return redirect()->route('iteminventory')->with('success','');
    }

    
}
