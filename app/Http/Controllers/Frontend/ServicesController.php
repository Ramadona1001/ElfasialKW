<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\Catalog;
use App\Category;
use App\CatalogItem;
use App\Buffet;
use App\PackageItem;

class ServicesController extends Controller
{
    public function index(){
        $lang = \Lang::getLocale();
        $packagesCategory = Package::select($lang.'_name as name',$lang.'_desc as desc','category_id','id','price')->groupBy('category_id')->get();
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id')->get();
        
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        
        $buffetsCategory = Buffet::select('no_members','id','categories_id')->groupBy('categories_id')->get();
       
        return view('frontend.pages.services.index',compact('category','catalogs','buffetsCategory','packagesCategory'));
    }

    public function fromchoice($id)
    {
        $lang = \Lang::getLocale();
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id')->get();
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        $buffetsCategory = Buffet::select('no_members','id','categories_id')->groupBy('categories_id')->get();

        return view('frontend.pages.services.fromchoice',compact('category','catalogs','buffetsCategory'));
    }

    public function catalogs($id)
    {
        $catalogsItems = CatalogItem::where('catalog_id',$id)->get();
        return view('frontend.pages.services.catalogs',compact('catalogsItems'));
    }

    public function singleCatalog($id)
    {
        $catalogsItem = CatalogItem::findOrfail($id);
        return view('frontend.pages.services.catalogsingle',compact('catalogsItem'));
    }



    public function buffet_services($id){
        $lang = \Lang::getLocale();
        $category_id = $id;
        $buffets = Buffet::select('no_members','id','categories_id','iteminventory_id')->where('categories_id',$id)->get();
        
        return view('frontend.pages.services.buffets',compact('buffets','category_id'));
    }

    public function singleBuffets($id)
    {
        $buffet = Buffet::findOrfail($id);
        return view('frontend.pages.services.buffetsingle',compact('buffet'));
    }

    public function packages($id)
    {
        
        $lang = \Lang::getLocale();
        $category = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->get();
        $packages = Package::select($lang.'_name as name','en_name','ar_name',$lang.'_desc as desc','category_id','id','price','package_image')->where('category_id',$id)->get();
        

        return view('frontend.pages.services.packages',compact('category','packages'));
    }

    public function packagesDetails($id)
    {
        $lang = \Lang::getLocale();
        // $package = Package::select($lang.'_name as name',$lang.'_desc as desc','category_id','id','price')->where('id',$id)->get()->first();
        $packagesItems = PackageItem::select('*')->where('package_id',$id)->get();
        return view('frontend.pages.services.packagesingle',compact('packagesItems'));
    }
}
