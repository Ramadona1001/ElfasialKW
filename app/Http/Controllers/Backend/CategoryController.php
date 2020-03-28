<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Catalog;
use Image;
use File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_categories'))
            abort(403);

        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        return view('backend.pages.categories.index',compact('categories'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_category'))
            abort(403);
        return view('backend.pages.categories.create');
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_category'))
            abort(403);

            

        $request->validate([
            'en_name' => 'required|min:2',
            'ar_name' => 'required|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
            
        ]);
        
        

        $categories = new Category();

        $categories->en_name = $request->en_name;
        $categories->ar_name = $request->ar_name;
        $categories->en_desc = $request->en_desc;
        $categories->ar_desc = $request->ar_desc;

        

        if ($request->hasFile('cat_image')) {

            $image = $request->file('cat_image');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/categories');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/categories');

            $image->move($destinationPath, $image_name);
            $categories->cat_image = $image_name;

        }

        $categories->save();

        return redirect()->route('category')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_category'))
            abort(403);
        $lang = \Lang::getLocale();
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc')->where('categories_id',$id)->get();
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->where('id',$id)->get()->first();
        return view('backend.pages.categories.show',compact('category','catalogs'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_category'))
            abort(403);
        $category = Category::findOrfail($id);
        return view('backend.pages.categories.edit',compact('category'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_category'))
            abort(403);
        
        $category = Category::findOrfail($id);

        

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);

        $category->en_name = $request->en_name;
        $category->ar_name = $request->ar_name;
        $category->en_desc = $request->en_desc;
        $category->ar_desc = $request->ar_desc;

       

        if ($request->hasFile('cat_image')) {
            $path = public_path() . '/categories/' . $category->cat_image;
            if(file_exists($path)) {
                File::delete($path);
            }

            $image = $request->file('cat_image');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/categories');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/categories');

            $image->move($destinationPath, $image_name);
            $categories->cat_image = $image_name;
        }

        

        $category->save();

        

        return redirect()->route('category')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_category'))
            abort(403);
        $category = Category::findOrfail($id);
        $path = public_path() . '/categories/' . $category->cat_image;
        if(file_exists($path)) {
            File::delete($path);
        }
        $category->delete();

        return redirect()->route('category')->with('success','');
    }
}
