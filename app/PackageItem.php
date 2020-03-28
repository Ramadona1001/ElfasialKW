<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    protected $table = 'packages_items';

    public function inventory($id)
    {
        $lang = \Lang::getLocale();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes',$lang.'_desc','inventory_image')->where('id',$id)->get()->first();
        return $inventory;
    }
}
