<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FromChoice;
use App\Inventory;
use App\Category;
use App\FromChoiceItems;
use Auth;
use File;
use Image;

class FromChoiveController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_customer_choices'))
            abort(403);
        $lang = \Lang::getLocale();
        $fromChoiceCategory = FromChoice::select('id','fromchoice_image',$lang.'_desc as desc','categories_id')->groupBy('categories_id')->get();
        $fromChoice = FromChoice::select($lang.'_name as name','id','fromchoice_image',$lang.'_desc as desc','categories_id')->get();
        $items = FromChoiceItems::select('id',$lang.'_desc as desc','from_choices_id','price')->get();
        return view('backend.pages.fromchoices.index',compact('fromChoice','fromChoiceCategory','items'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_fromchoices'))
            abort(403);
        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_price','user_id',$lang.'_desc as desc','inventory_image')->where('quantity','>',0)->get();
        return view('backend.pages.fromchoices.create',compact('inventory','categories'));
    }
    
    public function itemsCreate($id)
    {
        if(!Auth::user()->hasPermissionTo('create_fromchoices'))
            abort(403);
        $lang = \Lang::getLocale();

        $fromChoice = FromChoice::findOrfail($id);
        return view('backend.pages.fromchoices.create_items',compact('fromChoice'));
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_fromchoices'))
            abort(403);

        $request->validate([
            'en_name' => 'required|min:2',
            'en_name' => 'required|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
            'fromchoice_image' => 'required',
        ]);

        $fromchoice = new FromChoice();
        $fromchoice->en_desc = $request->en_desc;
        $fromchoice->ar_desc = $request->ar_desc;
        $fromchoice->en_name = $request->en_name;
        $fromchoice->ar_name = $request->ar_name;
        $fromchoice->categories_id = $request->categories_id;

        if ($request->hasFile('fromchoice_image')) {
            $image = $request->file('fromchoice_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/fromchoices');
            $image->move($destinationPath, $name);
            $fromchoice->fromchoice_image = $name;
        }

        $fromchoice->save();
        

        return redirect()->route('fromchoices')->with('success','');
    }

    public function itemsStore(Request $request){
        if(!Auth::user()->hasPermissionTo('create_fromchoices'))
            abort(403);

        $request->validate([
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
            'ar_name' => 'required|min:2',
            'en_name' => 'required|min:2',
        ]);

        $fromchoice = new FromChoiceItems();

        $fromchoice->en_desc = $request->en_desc;
        $fromchoice->ar_desc = $request->ar_desc;
        $fromchoice->en_name = $request->en_name;
        $fromchoice->ar_name = $request->ar_name;
        $fromchoice->price   = $request->price;

        $fromchoice->from_choices_id = $request->fromchoice_id;

        $fromchoice->save();

        if ($request->hasFile('fromchoice_items_image')) {
            \DB::select('delete from fromchoices_gallery where fromchoice_id = '.$fromchoice->id);
            foreach ($request->fromchoice_items_image as $image) {
                $newImg = time().'.'.$image->getClientOriginalExtension();
                \DB::select('insert into fromchoices_gallery (fromchoice_id,image_path) values('.$fromchoice->id.',"'.$newImg.'")');
                $destinationPath = public_path('/fromchoices');
                $image->move($destinationPath, $newImg);
            }
        }
        

        return redirect()->route('fromchoices')->with('success','');
    }

    public function itemsUpdate(Request $request,$id){
        if(!Auth::user()->hasPermissionTo('edit_fromchoices'))
            abort(403);

        $request->validate([
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);

        $fromchoice = FromChoiceItems::findOrfail($id);
        $inventory = Inventory::findOrfail($request->inventory_id);

        $fromchoice->en_desc = $request->en_desc;
        $fromchoice->ar_desc = $request->ar_desc;
        $fromchoice->en_name = $request->en_name;
        $fromchoice->ar_name = $request->ar_name;
        $fromchoice->price = $request->price;


        $fromchoice->save();

        if ($request->hasFile('fromchoice_items_image')) {
            foreach ($request->fromchoice_items_image as $image) {
                $newImg = time().'.'.$image->getClientOriginalExtension();
                \DB::select('insert into fromchoices_gallery (fromchoice_id,image_path) values('.$fromchoice->id.',"'.$newImg.'")');
                $destinationPath = public_path('/fromchoices');
                $image->move($destinationPath, $newImg);
            }
        }
        

        return redirect()->route('fromchoices')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_fromchoices'))
            abort(403);
        $lang = \Lang::getLocale();
        
        $catalog = Catalog::select($lang.'_name as name','id',$lang.'_desc as desc','catalog_img','categories_id')->where('id',$id)->get()->first();
        $items = CatalogItem::select($lang.'_name as name','id','price','quantity','total_price','inventory_id')->where('cataglog_id',$id)->get();
        return view('backend.pages.fromchoices.show',compact('catalog','items'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_fromchoices'))
            abort(403);
        $lang = \Lang::getLocale();
        $fromchoice = FromChoiceItems::findOrfail($id);
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_price','user_id',$lang.'_desc as desc','inventory_image')->where('quantity','>',0)->get();
        return view('backend.pages.fromchoices.edit_items',compact('fromchoice','inventory','categories'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_fromchoices'))
            abort(403);
        $request->validate([
            'en_name' => 'required|min:2',
            'en_name' => 'required|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);

        $fromchoice = FromChoice::findOrfail($id);
        $fromchoice->en_desc = $request->en_desc;
        $fromchoice->ar_desc = $request->ar_desc;
        $fromchoice->en_name = $request->en_name;
        $fromchoice->ar_name = $request->ar_name;
        $fromchoice->categories_id = $request->categories_id;

        if ($request->hasFile('fromchoice_image')) {
            $image = $request->file('fromchoice_image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/fromchoices');
            $image->move($destinationPath, $name);
            $fromchoice->fromchoice_image = $name;
        }

        $fromchoice->save();
        

        return redirect()->route('fromchoices')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_fromchoices'))
            abort(403);
        $fromchoices = \DB::select('DELETE FROM from_choices WHERE from_choices.categories_id = '.$id);
        return redirect()->route('fromchoices')->with('success','');
    }
    
    public function deleteItemBuffet($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_fromchoices'))
            abort(403);
        $fromchoices = \DB::select('DELETE FROM from_choice_items WHERE id = '.$id);
        return redirect()->route('fromchoices')->with('success','');
    }

    public function deleteimg($id)
    {
        $img = \DB::select('select * from fromchoices_gallery where id = '.$id)[0]->image_path;
        $path = public_path() . '/fromchoices/' . $img;
            if(file_exists($path)) {
                File::delete($path);
            }
        \DB::select('delete from fromchoices_gallery where id = '.$id);
        return back();
    }
}
