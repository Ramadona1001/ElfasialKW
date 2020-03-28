<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Catalog;
use App\Inventory;
use App\CatalogItem;
use App\Category;
use Auth;
use Image;
use File;

class CatalogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_catalogs'))
            abort(403);

        $lang = \Lang::getLocale();
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img','price',$lang.'_desc as desc','categories_id')->get();
        return view('backend.pages.catalogs.index',compact('catalogs'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_catalogs'))
            abort(403);
        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        return view('backend.pages.catalogs.create',compact('categories'));
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_catalogs'))
            abort(403);

        $quantities = [];
        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
            // 'catalog_img' => 'required',
        ]);
        
        $catalogs = new Catalog();

        $catalogs->en_name = $request->en_name;
        $catalogs->ar_name = $request->ar_name;
        $catalogs->en_desc = $request->en_desc;
        $catalogs->ar_desc = $request->ar_desc;
        $catalogs->categories_id = $request->categories_id;
        $catalogs->price = $request->price;

        if ($request->hasFile('catalog_img')) {
            $image = $request->file('catalog_img');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/catalogs');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/catalogs');

            $image->move($destinationPath, $image_name);
            $catalogs->catalog_img = $image_name;


        }

        
        $catalogs->save();

        // for ($i=0; $i < count($request->items); $i++) {
        //     $inventory = Inventory::findOrfail($request->items[$i]);
        //     $itemsSave = new CatalogItem();

        //     $itemsSave->en_name = $inventory->en_name;
        //     $itemsSave->ar_name = $inventory->ar_name;
        //     $itemsSave->price = $inventory->price;
        //     $itemsSave->quantity = $inventory->quantity;
        //     $itemsSave->cataglog_id = $catalogs->id;
        //     $itemsSave->inventory_id = $inventory->id;
        //     $itemsSave->total_price = ($inventory->price * $inventory->quantity) + $inventory->add_value;
        //     $itemsSave->save();

        // }

        

      

        return redirect()->route('catalogs')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_catalogs'))
            abort(403);
        $lang = \Lang::getLocale();
        
        $catalog = Catalog::select($lang.'_name as name','id',$lang.'_desc as desc','price','catalog_img','categories_id')->where('id',$id)->get()->first();
        // $items = CatalogItem::select($lang.'_name as name','id','price','quantity','total_price','inventory_id')->where('cataglog_id',$id)->get();
        return view('backend.pages.catalogs.show',compact('catalog'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_catalogs'))
            abort(403);
        $lang = \Lang::getLocale();
        $inventory_catalogs = [];
        $catalog = Catalog::findOrfail($id);
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        
        
        return view('backend.pages.catalogs.edit',compact('catalog','categories'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_catalogs'))
            abort(403);
        $catalogs = Catalog::findOrfail($id);

        // dd($request->all());

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);

        $catalogs->en_name = $request->en_name;
        $catalogs->ar_name = $request->ar_name;
        $catalogs->en_desc = $request->en_desc;
        $catalogs->ar_desc = $request->ar_desc;
        $catalogs->categories_id = $request->categories_id;
        $catalogs->price = $request->price;

        if ($request->hasFile('catalog_img')) {
            $path = public_path() . '/catalogs/' . $catalogs->catalog_img;
            if(file_exists($path)) {
                File::delete($path);
            }

            $image = $request->file('catalog_img');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/catalogs');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/catalogs');

            $image->move($destinationPath, $image_name);
            $catalogs->catalog_img = $image_name;


        }

        
        $catalogs->save();

        return redirect()->route('catalogs')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_catalogs'))
            abort(403);
        $catalog = Catalog::findOrfail($id);
        $path = public_path() . '/catalogs/' . $catalog->catalog_img;
        if(file_exists($path)) {
            File::delete($path);
        }
        $catalog->delete();

        return redirect()->route('catalogs')->with('success','');
    }
}
