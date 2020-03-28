<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function userStatus($status){
        return [
            0 => __('tr.New'),
            1 => __('tr.Paid'),
            0 => __('tr.Not Paid'),
        ][$status];
    }
}
