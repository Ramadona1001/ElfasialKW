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
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id')->paginate(8);
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
        ]);
        
        $catalogs = new Catalog();

        $catalogs->en_name = $request->en_name;
        $catalogs->ar_name = $request->ar_name;
        $catalogs->en_desc = $request->en_desc;
        $catalogs->ar_desc = $request->ar_desc;
        $catalogs->categories_id = $request->categories_id;

        $image_path = public_path().'/uploads/catalogs/';
        File::makeDirectory($image_path, $mode = 0777, true, true);

        if ($request->hasFile('catalog_img')){
            $imageName = time().'.'.request()->catalog_img->getClientOriginalExtension();
            $request->catalog_img->move($image_path, $imageName);
            $catalogs->catalog_img = $imageName;
        }

        
        $catalogs->save();

        return redirect()->route('catalogs')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_catalogs'))
            abort(403);
        $lang = \Lang::getLocale();
        
        $catalog = Catalog::select($lang.'_name as name','id',$lang.'_desc as desc','catalog_img','categories_id')->where('id',$id)->get()->first();
        $items = CatalogItem::select('*')->where('catalog_id',$id)->get();
        return view('backend.pages.catalogs.show',compact('catalog','items'));
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

        $image_path = public_path().'/uploads/catalogs/';
        File::makeDirectory($image_path, $mode = 0777, true, true);

        if ($request->hasFile('catalog_img')){
            $path = $image_path . $catalogs->catalog_img;
            if(file_exists($path)) {
                File::delete($path);
            }

            $imageName = time().'.'.request()->catalog_img->getClientOriginalExtension();
            $request->catalog_img->move($image_path, $imageName);
            $catalogs->catalog_img = $imageName;
        }
        

        $catalogs->save();

        return redirect()->route('catalogs')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_catalogs'))
            abort(403);

        $image_path = public_path().'/uploads/catalogs/';
        File::makeDirectory($image_path, $mode = 0777, true, true);

        $catalog = Catalog::findOrfail($id);
        $path = $image_path . $catalogs->catalog_img;
        if(file_exists($path)) {
            File::delete($path);
        }
        $catalog->delete();

        return redirect()->route('catalogs')->with('success','');
    }
}
