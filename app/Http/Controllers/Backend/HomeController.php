<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Customer;
use App\Catalog;
use App\Department;
use App\CatalogItem;
use App\Inventory;
use App\Order;
use App\Task;
use App\ContactUs;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\Order_Review;
use App\Buffet;
use App\FromChoice;
use App\DepartmentTask;
use App\Withdraw;
use App\Feedback;
use DB;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changeOrderQuantity($order_date){ //Change Orders Quantity After time is expired
        date_default_timezone_set("Africa/Cairo");
        $date = new DateTime(date('Y-m-d H:i:s'));
        $interval = $date->diff($order_date);
        $days = $interval->format('%a');
        $hours = $interval->format('%h');
        $mins = $interval->format('%i');
        if($days == 0){
            return true;
        }else{
            return false;
        }
    }
    
    public function index()
    {
        //Check Order is Finish
        
        $orders = Order::where('orders.status','new')->get();
        
        // foreach ($orders as $order) {
        
        //     $order_date = new DateTime($order->order_day.' '.$order->order_to, new DateTimeZone('Africa/Cairo'));
        //     if ($order->status == 'new') {
        //         if ($this->changeOrderQuantity($order_date)) {
        //             $updateOrder = Order::findOrfail($order->id);
        //             $updateOrder->status = 'finished';
        //             $updateOrder->save();
                    
        //             $order_data = json_decode($order->order_data,true);
        //             $count = count($order_data) / 4;
        //             for ($i=0; $i < $count; $i++) {
        //                 $id = 'id_'.$i;
        //                 $quantity = 'quantity_'.$i;
        //                 $item = CatalogItem::findOrfail($order_data[$id]);
        //                 $inventory = Inventory::findOrfail($item->inventory_id);
        //                 $inventory->quantity = $inventory->quantity + $order_data[$quantity];
        //                 $inventory->save();
        //             }
        //         }
        //     }
        // }



        $user_count = User::count();
        $customer_count = Customer::count();
        $catalog_count = Catalog::count();
        $department_count = Department::count();
        // $catalog_item_count = CatalogItem::count();
        $inventory_count = Inventory::count();
        $order_count = Order::count();
        $task_count = Task::count();
        $contact_count = ContactUs::count();
        $review_count = Order_Review::count();
        $buffet_count = Buffet::count();
        $fromchoice_count = FromChoice::count();
        $departmenttasks_count = DepartmentTask::count();
        $withdraw_count = Withdraw::count();
        $feedback_count = Feedback::count();
        $myTasks = Task::where('user_id',Auth::user()->id)->get()->count();



        return view('backend.index',compact(
            'user_count',
            'customer_count',
            'catalog_count',
            'department_count',
            // 'catalog_item_count',
            'inventory_count',
            'order_count',
            'task_count',
            'contact_count',
            'review_count',
            'orders',
            'myTasks',
            'buffet_count',
            'fromchoice_count',
            'departmenttasks_count',
            'withdraw_count',
            'feedback_count'
        ));
    }




    public function  profitstatistic()
    {
       $orders = Order::all();
        $lang = \Lang::getLocale();
        $profits = DB::select('SELECT SUM(inventories.total_price) AS "price",
                                SUM( inventories.total_orignal_price ) AS "orignal_price",
                                SUM(inventories.total_price) - SUM( inventories.total_orignal_price ) AS "profit",
                                CASE
                                WHEN MONTH(orders.order_day) = 1 THEN   "'.__("tr.January").'"
                                WHEN MONTH(orders.order_day) = 2 THEN   "'.__("tr.February").'"
                                WHEN MONTH(orders.order_day) = 3 THEN   "'.__("tr.March").'" 
                                WHEN MONTH(orders.order_day) = 4 THEN   "'.__("tr.April").'" 
                                WHEN MONTH(orders.order_day) = 5 THEN   "'.__("tr.May").'"
                                WHEN MONTH(orders.order_day) = 6 THEN   "'.__("tr.June").'" 
                                WHEN MONTH(orders.order_day) = 7 THEN   "'.__("tr.July").'"
                                WHEN MONTH(orders.order_day) = 8 THEN   "'.__("tr.August").'" 
                                WHEN MONTH(orders.order_day) = 9 THEN   "'.__("tr.September").'" 
                                WHEN MONTH(orders.order_day) = 10 THEN  "'.__("tr.Octobar").'" 
                                WHEN MONTH(orders.order_day) = 11 THEN  "'.__("tr.November").'" 
                                WHEN MONTH(orders.order_day) = 12 THEN  "'.__("tr.December").'" 
                                
  END AS "month" FROM `inventories` INNER JOIN catalog_items ON catalog_items.inventory_id = inventories.id INNER JOIN catalogs ON catalogs.id = catalog_items.cataglog_id INNER JOIN orders ON orders.catalog_id = catalogs.id GROUP BY MONTH(orders.order_day)');

       return response()->json(['profits'=>$profits]);

      //return response()->json($orders);
    }

   public function statistic()
   {
           $lang = \Lang::getLocale();
            $orders = DB::select('select COUNT(*) as "count", order_day FROM orders WHERE order_day = (SELECT CURDATE())');
            $tasks = DB::select('select COUNT(*) as "count", task_date FROM tasks WHERE task_date = (SELECT CURDATE())');
            $contacts = DB::select('select COUNT(*) as "count",DATE(created_at) FROM contact_us  where DATE(created_at) = (SELECT CURDATE())');
         return response()->json(['orders'=> $orders ,'tasks'=>$tasks , 'contacts'=>$contacts]);
   }

   public function feedbacks()
   {
        if(!Auth::user()->hasPermissionTo('show_menu_feedbacks'))
        abort(403);
        $feedback = Feedback::all();
       return view('backend.pages.feedbacks.index',compact('feedback'));
   }
 
}
