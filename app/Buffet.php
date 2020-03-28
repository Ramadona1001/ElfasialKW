<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buffet extends Model
{
    public function inventory(){
        return $this->belongsTo('App\Inventory','inventory_id');
    }

    public function categoryName($id){
        $lang = \Lang::getLocale();
        return Category::select($lang.'_name as name','id',$lang.'_desc as desc')->where('id',$id)->get()->first();
    }

    public function inventoryName($id){
        $lang = \Lang::getLocale();
        return Inventory::select($lang.'_name as name','id',$lang.'_desc as desc')->where('id',$id)->get()->first();
    }
}
