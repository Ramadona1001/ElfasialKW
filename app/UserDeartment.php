<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDeartment extends Model
{
    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public static function departmentName($id){
        $lang = \Lang::getLocale();
        return \DB::select('select user_deartments.department_id as "id",departments.'.$lang.'_name as "name" from user_deartments inner join departments on departments.id = user_deartments.department_id inner join users on users.id = user_deartments.user_id where user_deartments.department_id = '.$id)[0];
    }
}
