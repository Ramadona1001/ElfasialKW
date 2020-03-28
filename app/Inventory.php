<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public static function getItemData($id)
    {
        $lang = \Lang::getLocale();
        return Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_price','user_id','notes')->where('id',$id)->get()->first;
    }

    public static function checkInventory()
    {
        $inventory = Inventory::where('quantity',0)->get();
        $inventory_arr = [];
        foreach ($inventory as $in) {
            if ($in->quantity <= 0) {
                array_push($inventory_arr,$in->id);
            }
        }
        if (count($inventory_arr) > 0) {
            return true;
        }else{
            return false;
        }

    }
}
