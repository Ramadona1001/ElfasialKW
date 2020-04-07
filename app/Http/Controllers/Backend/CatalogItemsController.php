<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CatalogItem;
use App\ItemInventory;
use App\Catalog;
use Auth;

class CatalogItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  
    public function create($id)
    {
        if(!Auth::user()->hasPermissionTo('create_items'))
            abort(403);
        $lang = \Lang::getLocale();
        $catalogs = Catalog::findOrfail($id);
        $itemInventory = ItemInventory::all();
        $items = [];
        foreach (CatalogItem::select('*')->where('catalog_id',$id)->get() as $item) {
            array_push($items,$item->iteminventory_id);
        }
        return view('backend.pages.catalogsitems.create',compact('catalogs','itemInventory','items'));
    }

   
    public function store(Request $request,$id)
    {
        if(!Auth::user()->hasPermissionTo('create_items'))
            abort(403);

        

        if (isset($request->iteminventory)) {
            CatalogItem::where('catalog_id',$id)->delete();
            for ($i=0; $i < count($request->iteminventory); $i++) { 
                $catalogItems = new CatalogItem();
                $catalogItems->iteminventory_id = $request->iteminventory[$i];
                $catalogItems->catalog_id = $id;
                $catalogItems->save();
            }
        }

        return redirect()->route('catalogs')->with('success','');
    }

  
    
    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_items'))
            abort(403);
        $items = CatalogItem::findOrfail($id);
        $items->delete();

        return back()->with('success','');
    }
}
