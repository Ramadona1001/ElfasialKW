<?php

namespace App;
use App\Catalog;
use App\CatalogItem;
use App\Task;
use App\Order_Review;
use App\Customer;
use Auth;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function customer(){
        return $this->belongsTo('App\Customer','customer_id');
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

    public function editOrdeleteOrder($id){
        return Task::where('order_id',$id)->get()->count();
    }

    public function expiredOrder($id){
        return Order::where('id',$id)->get()->first()->status;
    }

    public static function getMonth($month){
        switch ($month) {
            case 1:
                return __('tr.January');
                break;
            case 2:
                return __('tr.February');
                break;
            case 3:
                return __('tr.March');
                break;
            case 4:
                return __('tr.April');
                break;
            case 5:
                return __('tr.May');
                break;
            case 6:
                return __('tr.June');
                break;
            case 7:
                return __('tr.July');
                break;
            case 8:
                return __('tr.August');
                break;
            case 9:
                return __('tr.September');
                break;
            case 10:
                return __('tr.Octobar');
                break;
            case 11:
                return __('tr.November');
                break;
            case 12:
                return __('tr.December');
                break;
            
            default:
                return __('tr.no');
                break;
        }
    }

    public static function getCartCount()
    {
        $cart_count = 0;
        if(isset(Auth::user()->id) != null){
            $customer = Customer::where('user_id',Auth::user()->id);
            if($customer->count() > 0){
                $customer = $customer->get()->first()->id;   
                $cart_count = Order::where('customer_id',$customer)->count();
            }else{
                $cart_count = 0;
            }
        }else{
            $cart_count = 0;
        }

        return $cart_count;
    }

    public static function reviewOrder($customer_id){
        if (Customer::where('user_id',$customer_id)->get()->count() > 0) {
            $customer_id = Customer::where('user_id',$customer_id)->get()->first()->id;
            $orders = Order::where('status','finished')->get();
            $orderNotRated = [];

            $reviews = Order_Review::all();
            foreach ($reviews as $review) {
                array_push($orderNotRated,$review->order_id);
            }

            foreach ($orders as $order) {
                if (!in_array($order->id,$orderNotRated)) {
                    if ($order->customer_id == $customer_id) {
                        return $order->id;
                    }else{
                        return null;
                    }
                }
            
            }
        }else{
            return null;
        }
                
    }

    public function changeOrderQuantity($order_date){ //Change Orders Quantity After time is expired
        // return $order_date;
        date_default_timezone_set("Africa/Cairo");
        $date = new DateTime($order_date);
        $now = new DateTime();
        $date->diff($now)->format("%d days, %h hours and %i minuts");
        $days = $date->diff($now)->format("%d");
        $hours = $date->diff($now)->format("%h");
        $mins = $date->diff($now)->format("%i");

        return $days;
    }

}
