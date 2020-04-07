<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\MainOrder;
use App\Customer;
use App\Catalog;
use App\CatalogItem;
use App\Inventory;
use App\Order_Review;
use App\Task;
use App\User;
use App\Department;
use Auth;
use DB;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use App\Contract;
use App\ContractItem;
use App\Package;
use App\PackageItem;

class OrdersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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
        
        if($days == 0){
            return true;
        }else{
            return false;
        }
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_orders'))
            abort(403);
        $orders = MainOrder::all();
        $ordersData = Order::all();
        $contracts = Contract::all();
        return view('backend.pages.orders.index',compact('orders','ordersData','contracts'));
    }

    public function printOrder(Request $request)
    {
        $orders = MainOrder::findOrfail($request->order_id);
        $contracts = Contract::findOrfail($request->contract);
        $terms = ContractItem::where('contract_id',$contracts->id)->get();
        $ordersData = Order::where('mainorder_id',$orders->id)->get();
        return view('backend.pages.orders.print',compact('orders','ordersData','contracts','terms'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_orders'))
            abort(403);
        $customers = Customer::all();
        $lang = \Lang::getLocale();
        $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc','categories_id')->get();
       
        return view('backend.pages.orders.create',compact('customers','catalogs'));
    }

    public function customers(Request $request,$id){
        if($request->ajax()){
            $customers = Customer::findOrfail($id);
            return response()->json(['customers'=>$customers]);
        }
    }
    
    public function catalogs(Request $request,$id){
        if($request->ajax()){
            $catalog_total = DB::select('SELECT SUM(total_price) AS "total" FROM catalog_items WHERE cataglog_id = '.$id)[0]->total;
            return response()->json(['catalog_total'=>$catalog_total]);
        }
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_orders'))
            abort(403);

        $request->validate([
            'company' => 'required|max:255|min:2',
            'address' => 'required|max:255|min:2',
            'order_day' => 'required',
            'order_from' => 'required',
            'order_to' => 'required',
            'no_attendance' => 'required',
        ]);

        $data = [];
        $order_data = [];
        
        $customer = Customer::findOrfail($request->customer_id);

        $order = new Order();
        $order->order_code = 'ORDER_'.date('Y').rand(1,99);
        $order->customer_id = $request->customer_id;
        $order->company = $request->company;
        $order->address = $request->address;
        $order->order_day = $request->order_day;
        $order->order_from = $request->order_from;
        $order->order_to = $request->order_to;
        $order->no_attendance = $request->no_attendance;
        $order->total_price = $request->amount;
        $descs = explode(',',$request->descriptions);

        

        for ($i=0; $i < count($descs); $i++) {
            $desc = explode('@',$descs[$i]);
            $order_data['id_'.$i] = $desc[0];
            $order_data['title_'.$i] = $desc[1];
            $order_data['quantity_'.$i] = $desc[2];
            $order_data['total_'.$i] = $desc[3];

            $item = CatalogItem::findOrfail($desc[0]);
            $inventory = Inventory::findOrfail($item->inventory_id);
            $inventory->quantity = $inventory->quantity - $desc[2];
            $inventory->save();
        }

        $order->order_data = json_encode($order_data);
        $customer->status = 1;
        $customer->save();
        
        if($request->follow_name != null){
            for ($i=0; $i < count($request->follow_name); $i++) { 
                $data['follow_name_'.$i] = $request->follow_name[$i];
                $data['follow_mobile_'.$i] = $request->follow_mobile[$i];
                $data['follow_email_'.$i] = $request->follow_email[$i];
            }
    
            $order->followers = json_encode($data);
            $order->save();
            
        }else{
            $order->save();
        }


        return redirect()->route('orders')->with('success','');
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_orders'))
            abort(403);
        $orders = Order::findOrfail($id);
        $customer = Customer::findOrfail($orders->customer_id);
        $contracts = Contract::all();
        
        return view('backend.pages.orders.show',compact('orders','customer','contracts'));
    }

    public function contractsTerms(Request $request,$id)
    {
        if($request->ajax()){
            $items = ContractItem::where('contract_id',$id)->count();
            if($items > 0){
                $items = DB::select('SELECT id, ar_name, en_name, ar_content, en_content FROM contract WHERE id = '.$id)[0];
                $terms = DB::select('SELECT terms.id,terms.ar_name,terms.en_name,terms.ar_desc,terms.en_desc from contract_terms inner join terms on terms.id = contract_terms.terms_id where contract_id = '.$id);
            }
                //$items = DB::select('SELECT contract.id AS "contract_id", contract.ar_name AS "contract_ar_name", contract.en_name AS "contract_en_name", contract.ar_content AS "contract_ar_desc", contract.en_content AS "contract_en_desc", terms.id AS "terms_id", terms.ar_name AS "terms_ar_name", terms.en_name AS "terms_en_name", terms.ar_desc AS "terms_ar_desc", terms.en_desc AS "terms_en_desc" FROM `contract_terms` INNER JOIN contract ON contract.id = contract_terms.contract_id INNER JOIN terms ON terms.id = contract_terms.terms_id WHERE contract.id ='.$id);
            else{
                $items = DB::select('SELECT id, ar_name, en_name, ar_content, en_content FROM contract WHERE id = '.$id)[0];
                $terms = [];
            }
        }

        return response()->json(['items'=>$items,'terms'=>$terms]);
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_orders'))
            abort(403);
        
        $order = Order::findOrfail($id);
        $lang = \Lang::getLocale();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes',$lang.'_desc','inventory_image')->get();
        return view('backend.pages.orders.edit',compact('order','inventory'));
    }

    public function updateItemOrder(Request $request){
        $order = Order::findOrfail($request->order_id);
        $oldOrders = [];
        $order_data = [];
        $order_data = json_decode($request->order_data,true);
        $count = count($order_data) / 4;

        for ($i = 0; $i < $count; $i++){
            $title = 'title_'.$i;
            $id = 'id_'.$i;
            $quantity = 'quantity_'.$i;
            $total = 'total_'.$i;
            array_push($oldOrders,$order_data[$id].'@'.$order_data[$title].'@'.$order_data[$quantity].'@'.$order_data[$total]);
        }
        array_push($oldOrders,$request->inventory_id.'@'.$request->item_title.'@'.$request->inventory_new_qty.'@'.($request->inventory_new_qty * $request->item_price));
        
        for ($i=0; $i < count($oldOrders); $i++) {
            $desc = explode('@',$oldOrders[$i]);
            $order_data['id_'.$i] = $desc[0];
            $order_data['title_'.$i] = $desc[1];
            $order_data['quantity_'.$i] = $desc[2];
            $order_data['total_'.$i] = $desc[3];
            
            
            if(CatalogItem::where('id',$desc[0])->count() > 0){
                $item = CatalogItem::findOrfail($desc[0]);
                $inventory = Inventory::findOrfail($item->inventory_id);
                $inventory->quantity = $inventory->quantity - $desc[2];
                $inventory->save();
            }else{
                $inventory = Inventory::findOrfail($desc[0]);
                $inventory->quantity = $inventory->quantity - $desc[2];
                $inventory->save();
            }
            
        }

        $order->order_data = json_encode($order_data);
        $order->save();
        return back();
        
    }

    public function deleteItemOrder(Request $request){
    
        $order_datas = [];
        $order = Order::findOrfail($request->order_id);
        $order_data = json_decode($order->order_data,true);
        $count = count($order_data) / 4;
        $oldOrders = [];

        if(CatalogItem::where('id',$request->order_item_id)->get()->count() > 0){
            
            $item = CatalogItem::findOrfail($request->order_item_id);
            $inventory = Inventory::findOrfail($item->inventory_id);
            $inventory->quantity = $inventory->quantity + $request->quantity;
            $inventory->save();
            
            
        }else{
            
            $item = Inventory::findOrfail($request->order_item_id);
            $inventory = Inventory::findOrfail($item->id);
            $inventory->quantity = $inventory->quantity + $request->quantity;
            $inventory->save();
        }

        for ($i = 0; $i < $count; $i++){
            $title = 'title_'.$i;
            $id = 'id_'.$i;
            $quantity = 'quantity_'.$i;
            $total = 'total_'.$i;
            if($item->id != $order_data[$id]){
                array_push($oldOrders,$order_data[$id].'@'.$order_data[$title].'@'.$order_data[$quantity].'@'.$order_data[$total]);
            }
        }


        for ($i=0; $i < count($oldOrders); $i++) {
            $desc = explode('@',$oldOrders[$i]);
            $order_datas['id_'.$i] = $desc[0];
            $order_datas['title_'.$i] = $desc[1];
            $order_datas['quantity_'.$i] = $desc[2];
            $order_datas['total_'.$i] = $desc[3];
         
        }

        $order->order_data = json_encode($order_datas);
        $order->save();
        return back();
    }

    public function returnItemOrder($id){
        if(!Auth::user()->hasPermissionTo('edit_orders'))
        abort(403);
        
        $order = Order::findOrfail($id);$lang = \Lang::getLocale();
        $inventory = Inventory::select($lang.'_name as name','id','price','quantity','add_value','total_orignal_price','orignal_price','total_price','user_id','notes',$lang.'_desc','inventory_image')->get();
        return view('backend.pages.orders.return',compact('order','inventory'));
        
    }

    public function returnItemOrderPost(Request $request){
        if(!Auth::user()->hasPermissionTo('edit_orders'))
        abort(403);

        $order = Order::findOrfail($request->order_id);
        $order_datas = [];
        $order = Order::findOrfail($request->order_id);
        $order_data = json_decode($order->order_data,true);
        $count = count($order_data) / 4;
        $oldOrders = [];
        $newQuantity = $request->order_item_quantity - $request->quantity;

        // dd($request->all());


        if(CatalogItem::where('id',$request->order_item_id)->get()->count() > 0){
            // dd(1);
            
            $item = CatalogItem::findOrfail($request->order_item_id);
            $inventory = Inventory::findOrfail($item->inventory_id);
            $inventory->quantity = $inventory->quantity + $newQuantity;
            $inventory->save();
            
            
        }
        elseif (Package::where('id',$request->order_item_id)->get()->count() > 0) {
            // dd(3);
            $items = PackageItem::where('package_id',$request->order_item_id)->get();
            foreach ($items as $item) {
                $inventory = Inventory::findOrfail($item->inventory_id);
                $inventory->quantity = $inventory->quantity + $item->quantity;
                $inventory->save();
            }

        }else{
            // dd(2);
            $item = Inventory::findOrfail($request->order_item_id);
            $inventory = Inventory::findOrfail($item->id);
            $inventory->quantity = $inventory->quantity + $newQuantity;
            $inventory->save();
        }

        for ($i = 0; $i < $count; $i++){
            $title = 'title_'.$i;
            $id = 'id_'.$i;
            $quantity = 'quantity_'.$i;
            $total = 'total_'.$i;
            if($item->id != $order_data[$id]){
                array_push($oldOrders,$order_data[$id].'@'.$order_data[$title].'@'.$order_data[$quantity].'@'.$order_data[$total]);
            }
        }
        
        if($newQuantity > 0)
            array_push($oldOrders,$request->order_item_id.'@'.$request->order_item_name.'@'.$request->quantity.'@'.$request->order_item_total);

        for ($i=0; $i < count($oldOrders); $i++) {
            $desc = explode('@',$oldOrders[$i]);
            $order_datas['id_'.$i] = $desc[0];
            $order_datas['title_'.$i] = $desc[1];
            $order_datas['quantity_'.$i] = $desc[2];
            $order_datas['total_'.$i] = $desc[3];
         
        }

        $order->order_data = json_encode($order_datas);
        $order->save();

        return back();
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_orders'))
            abort(403);
        if(Task::where('order_id',$id)->get()->count() > 0)
            abort(403);
        
        $request->validate([
            'company' => 'required|max:255|min:2',
            'address' => 'required|max:255|min:2',
            'order_day' => 'required',
            'order_from' => 'required',
            'order_to' => 'required',
            'no_attendance' => 'required',
        ]);

        $data = [];

        $order = Order::findOrfail($id);
        $order->company = $request->company;
        $order->address = $request->address;
        $order->order_day = $request->order_day;
        $order->order_from = $request->order_from;
        $order->order_to = $request->order_to;
        if ($request->catalog_id == null) {
            $order->catalog_id = $request->catalogs;
        }else{
            $order->catalog_id = $request->catalog_id;
        }
        $order->no_attendance = $request->no_attendance;
        $order->total_price = 0;

        
        
        if($request->follow_name != null){
            for ($i=0; $i < count($request->follow_name); $i++) { 
                $data['follow_name_'.$i] = $request->follow_name[$i];
                $data['follow_mobile_'.$i] = $request->follow_mobile[$i];
                $data['follow_email_'.$i] = $request->follow_email[$i];
            }
    
            $order->followers = json_encode($data);
            $order->save();
    
        }else{
            $order->save();
        }

        $catalog_total = DB::select('SELECT SUM(total_price) AS "total" FROM catalog_items WHERE cataglog_id = '.$order->catalog_id)[0]->total;

        $orderUpdateTotal = Order::findOrfail($order->id);
        $orderUpdateTotal->total_price = $catalog_total;
        $orderUpdateTotal->save();

        if ($request->catalog_id != null) {
            $catalog_items = CatalogItem::where('cataglog_id',$order->catalog_id)->get();

            foreach ($catalog_items as $item) {
                $inventory = Inventory::findOrfail($item->inventory_id);
                $inventory->quantity = $inventory->quantity + $item->quantity;
                $inventory->save();          
            }
        }

        return redirect()->route('orders')->with('success','');
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_orders'))
            abort(403);
        if(Task::where('order_id',$id)->get()->count() > 0)
            abort(403);
        // $inventory = Inventory::findOrfail($id);
        $updateOrder = Order::findOrfail($id);
        $updateOrder->status = 'finished';
        $updateOrder->save();
        
        $order_data = json_decode($updateOrder->order_data,true);
        $count = count($order_data) / 4;
        for ($i=0; $i < $count; $i++) {
            $id = 'id_'.$i;
            $quantity = 'quantity_'.$i;
            if(CatalogItem::where('id',$order_data[$id])->count() > 0){
                $item = CatalogItem::where('id',$order_data[$id])->get()->first();
            }else{
                $item = Inventory::findOrfail($order_data[$id]);
            }
            $inventory = Inventory::findOrfail($item->inventory_id);
            $inventory->quantity = $inventory->quantity + $order_data[$quantity];
            $inventory->save();
        }
        $updateOrder->delete();

        return redirect()->route('orders')->with('success','');
    }


    public function reviews($id)
    {
        
        $orders = Order::findOrfail($id);
        $reviews = Order_Review::where('order_id','=', $orders->id)
            ->join('orders','orders.id', '=', 'order__reviews.order_id')
            ->get(array('orders.id as id','order__reviews.order_id as order_id','order__reviews.rate as rate','order__reviews.comment as comment'));
        return view('backend.pages.reviews.index',compact('reviews'));
    }

    public function profits()
    {
        if(!Auth::user()->hasPermissionTo('show_profits'))
            abort(403);
        
        $lang = \Lang::getLocale();
        $profits = DB::select('SELECT SUM(inventories.total_price) AS "price", SUM(inventories.total_orignal_price) AS "orignal_price", SUM(inventories.total_price) - SUM(inventories.total_orignal_price) AS "profit", MONTH(orders.order_day) AS "month", YEAR(orders.order_day) AS "year" FROM `inventories` INNER JOIN catalog_items ON catalog_items.inventory_id = inventories.id INNER JOIN catalogs ON catalogs.id = catalog_items.cataglog_id INNER JOIN orders ON orders.catalog_id = catalogs.id GROUP BY MONTH(orders.order_day)');
        
        return view('backend.pages.profits.index',compact('profits'));
    }

    public function tasksOrders($id)
    {
        if(!Auth::user()->hasPermissionTo('create_tasks'))
            abort(403);
        $lang = \Lang::getLocale();
        $orders = MainOrder::findOrfail($id);
        $customers = Customer::all();
        $users = User::all();
        $departments = Department::select($lang.'_name as name','id')->get();
        $orders_data = Order::where('mainorder_id',$orders->id)->get();
        
        return view('backend.pages.orders.tasks',compact('orders','customers','users','departments','orders_data'));
    }

    public function storeTasksOrders(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_tasks'))
            abort(403);

            // dd($request->all());

       
        $order_id = $request->order_id;
        $order_task = $request->order_task;
        $customer_id = $request->customer_phone;
        $department_id = $request->department_id;
        $user_id = $request->user_id;
        $department_task_id = $request->department_task_id;
        $task_date = $request->task_date;
        $task_status = $request->status;
        $order_data = $request->order_data;
        $orders_data = Order::findOrfail($request->order_data);

        if($request->notes !=null)
            $notes = $request->notes;

        $data = [];

        $task = new Task();

        $task->order_id = $order_id;
        $task->order_data_id = $order_data;
        $task->order_task = $orders_data->name;
        $task->customer_phone = $customer_id;
        $task->department_id = $department_id;
        $task->user_id = $user_id;
        $task->department_task_id = $department_task_id;
        $task->task_date = $task_date;
        $task->status = $task_status;
       
        if ($request->notes != null)
            $task->notes = $notes;
        
        $task->save();

        return redirect()->route('tasks')->with('success','');
    }



}
