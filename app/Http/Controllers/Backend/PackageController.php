<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\PackageItem;
use App\Category;
use App\Inventory;
use Auth;
use Image;

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_packages'))
            abort(403);

        $lang = \Lang::getLocale();
        $packagesCategory = Package::select($lang.'_name as name',$lang.'_desc as desc','category_id','id','price')->groupBy('category_id')->get();
        $categories = [];
        foreach ($packagesCategory as $cat) {
            array_push($categories,$cat->category_id);
        }
        $packages = Package::select($lang.'_name as name',$lang.'_desc as desc','category_id','id','price')->get();
        $packagesItems = PackageItem::all();
        return view('backend.pages.packages.index',compact('packages','packagesCategory','packagesItems','categories'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_packages'))
            abort(403);
        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        $packages = Package::select('category_id')->get();
        $catPackages = [];
        foreach ($packages as $package) {
            array_push($catPackages,$package->category_id);
        }
        return view('backend.pages.packages.create',compact('categories','catPackages'));
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_packages'))
            abort(403);
            

        $request->validate([
            'en_name' => 'required|min:2',
            'ar_name' => 'required|min:2',
            'en_desc' => 'required|min:2',
            'ar_desc' => 'required|min:2',
        ]);

        foreach ($request->category_id as $cat) {
            
            $package = new Package();
            $package->en_name = strip_tags($request->en_name);
            $package->ar_name = strip_tags($request->ar_name);
            $package->en_desc = strip_tags($request->en_desc);
            $package->ar_desc = strip_tags($request->ar_desc);
            $package->price = strip_tags($request->price);
            $package->no_members = strip_tags($request->no_members);

            $package->category_id = $cat;
            $package->save();
        }


        return redirect()->route('packages')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_packages'))
            abort(403);
        $lang = \Lang::getLocale();
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->where('id',$id)->get()->first();
        $packages = Package::select($lang.'_name as name',$lang.'_desc as desc','no_members','category_id','id','price')->where('category_id',$id)->get();
        $packagesItems = PackageItem::all();
        
        return view('backend.pages.packages.show',compact('packages','category','packagesItems'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('show_packages'))
            abort(403);
        $package = Package::where('id',explode(',',$id)[0])->where('category_id',explode(',',$id)[1])->get()->first();
        return view('backend.pages.packages.edit',compact('package'));
    }

    public function updateItems(Request $request,$id)
    {
        if(!Auth::user()->hasPermissionTo('edit_packages_items'))
            abort(403);
        $packages = Package::findOrfail($id);
        $packagesItems = PackageItem::findOrfail($request->item_id);
        $inventory = Inventory::findOrfail($request->inventory_id);

        $newQuantity = $packagesItems->quantity - $request->quantity;

        $inventory->quantity = $inventory->quantity + $newQuantity;
        $inventory->save();

        $packagesItems->quantity = $request->quantity;
        $packagesItems->save();
        

        return back()->with('success','');
    }

    public function deleteItems($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_packages_items'))
            abort(403);
        $packagesItems = PackageItem::findOrfail($id);
        $packagesItems->delete();
        return back()->with('success','');
    }

    public function createItemsPackage($id,Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_packages_items'))
        abort(403);
        $lang = \Lang::getLocale();
        $packages = Package::select($lang.'_name as name',$lang.'_desc as desc','category_id','id','price')->where('id',$id)->get()->first();
        // $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_price','user_id',$lang.'_desc as desc','inventory_image')->get();
        return view('backend.pages.packages.createItems',compact('packages'));

    }

    public function createItemsPackagePost($id,Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_packages_items'))
        abort(403);

        $lang = \Lang::getLocale();
        $packages = Package::select($lang.'_name as name',$lang.'_desc as desc','category_id','id','price')->where('id',$id)->get()->first();
        
        
        $packagesItems = new PackageItem();
        $packagesItems->ar_name = $request->ar_name;
        $packagesItems->en_name = $request->en_name;
        $packagesItems->ar_desc = $request->ar_desc;
        $packagesItems->en_desc = $request->en_desc;
        $packagesItems->package_id = $packages->id;

        if ($request->hasFile('package_imgs')) {

            $image = $request->file('package_imgs');

            $image_name = time() . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('/packages/items');

            $resize_image = Image::make($image->getRealPath());

            $resize_image->resize(150, 150, function($constraint){
            $constraint->aspectRatio();
            })->save($destinationPath . '/' . $image_name);

            $destinationPath = public_path('/packages/items');

            $image->move($destinationPath, $image_name);
            $packagesItems->package_imgs = $image_name;

        }
        
        $packagesItems->save();

        return redirect()->route('packages')->with('success','');
    }


    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_packages'))
            abort(403);
        $package = Package::where('category_id',$id)->delete();
        return redirect()->route('packages')->with('success','');
    }


    public function destroyPackage($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_packages'))
            abort(403);
        $ids = explode(',',$id);
        $package = Package::where('id',$ids[0])->where('category_id',$ids[1])->delete();
        return redirect()->route('packages')->with('success','');
    }
    
    public function deleteItemBuffet($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_packages'))
            abort(403);
        $buffets = \DB::select('DELETE FROM buffets WHERE buffets.id = '.$id);
        return redirect()->route('buffets')->with('success','');
    }

    public function createItems($id)
    {
        if(!Auth::user()->hasPermissionTo('create_packages'))
            abort(403);
        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->where('id',$id)->get()->first();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_price','user_id',$lang.'_desc as desc','inventory_image')->where('quantity','>',0)->get();
        return view('backend.pages.buffets.createItems',compact('inventory','categories'));
    }
}
