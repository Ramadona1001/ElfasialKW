<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentTask extends Model
{
    public static function departmentName($id){
        $lang = \Lang::getLocale();
        return Department::select($lang.'_name as name','id')->where('id',$id)->get()->first();
    }
}
