<?php

namespace App;
use App\Catalog;
use Illuminate\Database\Eloquent\Model;

class CatalogItem extends Model
{
    public function catalog($id){
        $lang = \Lang::getLocale();
        return Catalog::select($lang.'_name as name','id',$lang.'_desc as desc','catalog_img')->where('id',$id)->get()->first();
    }

    public function inventory(){
        return $this->belongsTo('App\Inventory','inventory_id');
    }

    public function inventoryData($id){
        $lang = \Lang::getLocale();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes',$lang.'_desc as desc','inventory_image')->where('id',$id)->get()->first();
        return $inventory;
    }
}
