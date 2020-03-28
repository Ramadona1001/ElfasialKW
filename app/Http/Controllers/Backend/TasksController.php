<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
use App\Order;
use App\Customer;
use App\Catalog;
use App\CatalogItem;
use App\User;
use App\Department;
use App\UserDeartment;
use App\DepartmentTask;
use Auth;
use DB;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_tasks'))
            abort(403);

        $tasks = Task::all();
        return view('backend.pages.tasks.index',compact('tasks'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_tasks'))
            abort(403);
        $lang = \Lang::getLocale();
        $customers = Customer::all();
        $users = User::all();
        $orders = Order::all();
        $departments = Department::select($lang.'_name as name','id')->get();
        
        return view('backend.pages.tasks.create',compact('customers','users','orders','departments'));
    }

    public function orders(Request $request,$id){
        if($request->ajax()){
            $orders = Order::findOrfail($id);
            return response()->json(['orders'=>$orders]);
        }
    }
    
    public function decode_data(Request $request,$id){
        if($request->ajax()){
            $orders_data = Order::findOrfail($id)->order_data;
            $decode_data = json_decode($orders_data,true);
            $all_orders = [];
            
            $count = count($decode_data) / 4;
            for ($i=0; $i < $count; $i++) { 
                $id = 'id_'.$i;
                $title = 'title_'.$i;
                $quantity = 'quantity_'.$i;
                $total = 'total_'.$i;

                $all_orders[$decode_data[$id]] = $decode_data[$title].' - Quantity: '.$decode_data[$quantity];
            }

            return response()->json(['all_orders'=>$all_orders]);
        }
    }

    public function departmentTasks(Request $request,$id){
        if($request->ajax()){
            $lang = \Lang::getLocale();
            $departmenttasks = DepartmentTask::select($lang.'_name as name',$lang.'_desc as desc','department_id','id')->where('department_id',$id)->get();
            return response()->json(['departmenttasks'=>$departmenttasks]);
        }
    }
    
    public function catalogs(Request $request,$id){
        if($request->ajax()){
            $lang = \Lang::getLocale();
            $catalogs = Catalog::select($lang.'_name as name','id','catalog_img',$lang.'_desc as desc')->where('id',$id)->get()->first();
            return response()->json(['catalogs'=>$catalogs]);
        }
    }

    public function catalogsItems(Request $request,$id){
        if($request->ajax()){
            $lang = \Lang::getLocale();
            $ordersdata = Order::findOrfail($id);
            return response()->json(['ordersdata'=>$ordersdata]);
        }
    }

    public function customers(Request $request,$id){
        if($request->ajax()){
            $customers = Customer::where('id',$id)->get()->first();
            return response()->json(['customers'=>$customers]);
        }
    }

    public function users(Request $request,$id){
        if($request->ajax()){
            $lang = \Lang::getLocale();
            $users = User::select('users.name as name','users.id')->join('user_deartments','user_deartments.user_id','users.id')->where('user_deartments.department_id',$id)->get();
            return response()->json(['users'=>$users]);
        }
    }

    public function departments(Request $request,$id){
        if($request->ajax()){
            $lang = \Lang::getLocale();
            $departments = User::select('users.name as name','users.id')->join('user_deartments','user_deartments.user_id','users.id')->where('user_deartments.department_id',$id)->get();
            dd($departments);
            return response()->json(['departments'=>$departments]);
        }
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_tasks'))
            abort(403);

       
        $order_id = $request->order_id;
        $order_task = $request->order_task;
        $customer_id = $request->customer_id;
        $department_id = $request->department_id;
        $user_id = $request->user_id;
        $department_task_id = $request->department_task_id;
        $task_date = $request->task_date;
        $task_status = $request->task_status;

        if($request->notes !=null)
            $notes = $request->notes;

        $data = [];

        $task = new Task();

        $task->order_id = $order_id;
        $task->order_task = $order_task;
        $task->customer_id = $customer_id;
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

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_tasks'))
            abort(403);
        $tasks = Task::findOrfail($id);
        return view('backend.pages.tasks.show',compact('tasks'));
    }


    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_tasks'))
            abort(403);
        $tasks = Task::findOrfail($id);
        $tasks->delete();

        return redirect()->route('tasks')->with('success','');
    }

    public function mytasks(){
        if(!Auth::user()->hasPermissionTo('show_mytasks'))
            abort(403);
        $user = User::findOrfail(Auth::user()->id);
        $myTasks = Task::where('user_id',$user->id)->get();

        return view('backend.pages.tasks.mytasks',compact('myTasks'));
    }

    public function pendingMyTasks($id){
        if(!Auth::user()->hasPermissionTo('change_tasks_status'))
            abort(403);
        $myTasks = Task::findOrfail($id);
        if($myTasks->user_id != Auth::user()->id)
            abort(403);
        else{
            $myTasks->status = 2;
            $myTasks->save();
            return redirect()->route('departments_mytasks')->with('success','');
        }

    }

    public function finishMyTasks($id){
        if(!Auth::user()->hasPermissionTo('change_tasks_status'))
            abort(403);
        $myTasks = Task::findOrfail($id);
        if($myTasks->user_id != Auth::user()->id)
            abort(403);
        else{
            $myTasks->status = 3;
            $myTasks->save();
            return redirect()->route('departments_mytasks')->with('success','');
        }

    }
}
