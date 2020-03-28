<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CatalogItem;
use App\Inventory;
use App\Catalog;
use Auth;

class CatalogItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lang = \Lang::getLocale();
        $items = CatalogItem::select($lang.'_name as name','id','price','quantity','total_price','cataglog_id')->get();
        return view('backend.pages.items.index',compact('items'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_items'))
            abort(403);
        $lang = \Lang::getLocale();
        $catalogs = Catalog::select($lang.'_name as name','id')->get();
        return view('backend.pages.items.create',compact('catalogs'));
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_items'))
            abort(403);

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|max:255|min:2',
            'ar_desc' => 'required|max:255|min:2',
            'price' => 'required',
            'item_img' => 'required',
        ]);

        $items = new CatalogItem();

        $items->en_name = $request->en_name;
        $items->ar_name = $request->ar_name;
        $items->en_desc = $request->en_desc;
        $items->ar_desc = $request->ar_desc;
        $items->cataglog_id = $request->catalog_id;
        $items->price = $request->price;

        if ($request->hasFile('item_img')) {
            $image = $request->file('item_img');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/catalogs/items');
            $image->move($destinationPath, $name);
            $items->item_img = $name;
        }

        $items->save();

        return redirect()->route('items')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_items'))
            abort(403);
        $lang = \Lang::getLocale();
        $item = CatalogItem::select($lang.'_name as name','id','price','quantity','total_price','cataglog_id')->where('id',$id)->get()->first();
        return view('backend.pages.items.show',compact('item'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_items'))
            abort(403);
        $lang = \Lang::getLocale();
        $item = CatalogItem::findOrfail($id);
        $catalogs = Catalog::select($lang.'_name as name','id')->get();
        return view('backend.pages.items.edit',compact('item','catalogs'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_items'))
            abort(403);
            $items = CatalogItem::findOrfail($id);

            $request->validate([
                'en_name' => 'required|max:255|min:2',
                'ar_name' => 'required|max:255|min:2',
                'en_desc' => 'required|max:255|min:2',
                'ar_desc' => 'required|max:255|min:2',
                'price' => 'required',
            ]);

            $items->en_name = $request->en_name;
            $items->ar_name = $request->ar_name;
            $items->en_desc = $request->en_desc;
            $items->ar_desc = $request->ar_desc;
            $items->cataglog_id = $request->catalog_id;
            $items->price = $request->price;
    
            if ($request->hasFile('item_img')) {
                $image = $request->file('item_img');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/catalogs/items');
                $image->move($destinationPath, $name);
                $items->item_img = $name;
            }
            $items->save();

        return redirect()->route('items')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_items'))
            abort(403);
        $items = CatalogItem::findOrfail($id);
        $inventory = Inventory::findOrfail($items->inventory_id);
        //$inventory->quantity = $inventory->quantity + $items->quantity;
        $inventory->save();
        $items->delete();

        return back()->with('success','');
    }
}
