<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FromChoiceItems extends Model
{
    public function inventoryName($id){
        $lang = \Lang::getLocale();
        return Inventory::select($lang.'_name as name','id',$lang.'_desc as desc')->where('id',$id)->get()->first();
    }

    public function inventory(){
        return $this->belongsTo('App\Inventory','inventory_id');
    }
}
