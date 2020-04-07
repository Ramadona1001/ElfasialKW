<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function customer(){
        return $this->belongsTo('App\Customer','customer_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    
    public function department(){
        return $this->belongsTo('App\Department','department_id');
    }
    
    public function order(){
        return $this->belongsTo('App\Order','order_data_id');
    }

    public function mainorder(){
        return $this->belongsTo('App\MainOrder','order_id');
    }

    public function departmentName($id){
        $lang = \Lang::getLocale();
        return Department::select($lang.'_name as name','id')->where('id',$id)->get()->first();
    }

    public function departmentTaskName($id){
        $lang = \Lang::getLocale();
        return DepartmentTask::select($lang.'_name as name','id')->where('id',$id)->get()->first();
    }

    public function catalog(){
        return $this->belongsTo('App\Catalog','catalog_id');
    }

    public function catalogName($id){
        $lang = \Lang::getLocale();
        return Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc')->where('id',$id)->get()->first();
    }

    public function catalogItems($id){
        $lang = \Lang::getLocale();
        return CatalogItem::select($lang.'_name as name','id','price','quantity','total_price','cataglog_id')->where('cataglog_id',$id)->get();
    }

    public function taskStatus($status)
    {
        switch ($status) {
            case 1:
                return __('tr.Start');
                break;
            case 2:
                return __('tr.Pending');
                break;
            case 3:
                return __('tr.Finished');
                break;
            default:
                return __('tr.Start');
                break;
        }
    }
}
