<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'packages';

    public static function category($id)
    {
        $lang = \Lang::getLocale();
        $categories = Category::select($lang.'_name as name','id','cat_image',$lang.'_desc as desc','id')->where('id',$id)->get()->first();
        return $categories;
    }

    public function item($id)
    {
        $packagesItems = PackageItem::where('package_id',$id)->get()->first();
        return $packagesItems;
    }

    public function inventory($id)
    {
        $lang = \Lang::getLocale();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes',$lang.'_desc','inventory_image')->where('id',$id)->get()->first();
        return $inventory;
    }
}
