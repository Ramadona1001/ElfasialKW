<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Buffet;
use App\Inventory;
use App\Category;
use Auth;
use Image;
use File;

class BuffetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_buffets'))
            abort(403);

        $lang = \Lang::getLocale();
        $buffetCategory = Buffet::select($lang.'_name as name',$lang.'_desc as desc','categories_id','id','price','buffets_image')->groupBy('categories_id')->get();
        $categories = [];
        foreach ($buffetCategory as $cat) {
            array_push($categories,$cat->categories_id);
        }
        $buffets = Buffet::select($lang.'_name as name',$lang.'_desc as desc','categories_id','id','price','buffets_image')->get();
        
        return view('backend.pages.buffets.index',compact('buffets','buffetCategory','categories'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_buffets'))
            abort(403);
        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        return view('backend.pages.buffets.create',compact('categories'));
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_buffets'))
            abort(403);

            

        $request->validate([
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
            'ar_name' => 'required|min:2',
            'en_name' => 'required|min:2',
        ]);

        $buffets = new Buffet();

        $buffets->en_desc = $request->en_desc;
        $buffets->ar_desc = $request->ar_desc;
        $buffets->en_name = $request->en_name;
        $buffets->ar_name = $request->ar_name;

        $buffets->categories_id = $request->categories_id;
        $buffets->no_members = $request->no_members;
        $buffets->price = $request->price;



        if ($request->hasFile('external_image')) {

           
            $image = $request->file('external_image');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/buffets');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/buffets');

            $image->move($destinationPath, $image_name);
            $buffets->buffets_image = $image_name;

        }


        $buffets->save();

        if ($request->hasFile('buffets_image')) {
            foreach ($request->buffets_image as $image) {
                $newImg = time().'.'.$image->getClientOriginalExtension();
                \DB::select('insert into buffet_gallery (buffet_id,image_path) values('.$buffets->id.',"'.$newImg.'")');
                $destinationPath = public_path('/buffets');
                $image->move($destinationPath, $newImg);
            }
        }
        

        return redirect()->route('buffets')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_buffets'))
            abort(403);
        $lang = \Lang::getLocale();
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->where('id',$id)->get()->first();
        $buffets = Buffet::select($lang.'_name as name',$lang.'_desc as desc','no_members','categories_id','id','price','buffets_image')->where('categories_id',$id)->get();
        return view('backend.pages.buffets.show',compact('category','buffets'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_buffets'))
            abort(403);
        $lang = \Lang::getLocale();
        $buffet = Buffet::findOrfail($id);
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_price','user_id',$lang.'_desc as desc','inventory_image')->where('quantity','>',0)->get();
        return view('backend.pages.buffets.edit',compact('buffet','inventory','categories'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_buffets'))
            abort(403);
        $request->validate([
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);

        $buffets = Buffet::findOrfail($id);

        $buffets->en_desc = $request->en_desc;
        $buffets->ar_desc = $request->ar_desc;
        $buffets->en_name = $request->en_name;
        $buffets->ar_name = $request->ar_name;

        $buffets->categories_id = $request->categories_id;
        $buffets->no_members = $request->no_members;
        $buffets->price = $request->price;

        if ($request->hasFile('external_image')) {
            
            $path = public_path() . '/buffets/' . $buffets->buffets_image;
            if(file_exists($path)) {
                File::delete($path);
            }

            $image = $request->file('external_image');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/buffets');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/buffets');

            $image->move($destinationPath, $image_name);
            $buffets->buffets_image = $image_name;

        }

        $buffets->save();

        if ($request->hasFile('buffets_image')) {
            // \DB::select('delete from buffet_gallery where buffet_id = '.$buffets->id);
            foreach ($request->buffets_image as $image) {
                $newImg = time().'.'.$image->getClientOriginalExtension();
                \DB::select('insert into buffet_gallery (buffet_id,image_path) values('.$buffets->id.',"'.$newImg.'")');
                $destinationPath = public_path('/buffets');
                $image->move($destinationPath, $newImg);
            }
        }
        

        return redirect()->route('buffets')->with('success','');
        
    }

    public function deleteImg($id)
    {
        $img = \DB::select('select * from buffet_gallery where id = '.$id)[0]->image_path;
        $path = public_path() . '/buffets/' . $img;
            if(file_exists($path)) {
                File::delete($path);
            }
        \DB::select('delete from buffet_gallery where id = '.$id);
        return back();
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_buffets'))
            abort(403);
        $buffets = \DB::select('DELETE FROM buffets WHERE buffets.categories_id = '.$id);
        return redirect()->route('buffets')->with('success','');
    }
    
    public function deleteItemBuffet($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_buffets'))
            abort(403);
        $buffets = Buffet::findOrfail($id);
        $img = \DB::select('select * from buffet_gallery where buffet_id = '.$buffets->id);
        foreach ($img as $i) {
            $path = public_path() . '/buffets/' . $i->image_path;
            if(file_exists($path)) {
                File::delete($path);
            }
        }
        \DB::select('delete from buffet_gallery where buffet_id = '.$id);
        $path = public_path() . '/buffets/' . $buffets->buffets_image;
        if(file_exists($path)) {
            File::delete($path);
        }
        $buffets->delete();
        return redirect()->route('buffets')->with('success','');
    }

    public function createItems($id)
    {
        if(!Auth::user()->hasPermissionTo('create_buffets'))
            abort(403);
        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->where('id',$id)->get()->first();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_price','user_id',$lang.'_desc as desc','inventory_image')->where('quantity','>',0)->get();
        return view('backend.pages.buffets.createItems',compact('inventory','categories'));
    }
}
