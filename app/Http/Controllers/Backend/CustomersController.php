<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\CustomerFile;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Session;
use Auth;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_customers'))
            abort(403);
        $customers = Customer::all();
        return view('backend.pages.customers.index',compact('customers'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_customers'))
            abort(403);
        return view('backend.pages.customers.create');
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_customers'))
            abort(403);
        $request->validate([
            'name' => 'required|max:255|min:2',
            'mobile' => 'required|max:255|min:2',
            'email' => 'required|unique:customers',
            'password' => 'required|confirmed|min:6|max:20',
        ]);
        
        
        $user = new User();
        $user->mobile = $request->mobile;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $customers = new Customer();

        $customers->name = $request->name;
        $customers->email = $request->email;
        $customers->password = Hash::make($request->password);
        $customers->user_id = $user->id;
        $customers->mobile = $request->mobile;
        $customers->save();
        
        

        if ($request->hasFile('file_path')) {
            for ($i=0; $i <count($request->file_name) ; $i++) { 
                $customersfiles = new CustomerFile();
                $customersfiles->file_name = $request->file_name[$i];

                $image = $request->file('file_path')[$i];
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/customers/files');
                $image->move($destinationPath, $name);
                $customersfiles->file_path = $name;
                $customersfiles->customer_id = $customers->id;
                $customersfiles->save();
            }
            
        }


        
        

        return redirect()->route('customers')->with('success',__('tr.User Added'));
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_customers'))
            abort(403);
        $customer = Customer::findOrfail($id);
        $userfiles = CustomerFile::where('customer_id',$customer->id)->get();
        return view('backend.pages.customers.show',compact('customer','userfiles'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_customers'))
            abort(403);
        $customer = Customer::findOrfail($id);
        $userfiles = CustomerFile::where('customer_id',$customer->id)->get();
        return view('backend.pages.customers.edit',compact('customer','userfiles'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_customers'))
            abort(403);
        $customer = Customer::findOrfail($id);

        $request->validate([
            'name' => 'required|unique:roles|max:255|min:2',
            'email' => 'unique:customers,email,'.$customer->id,
            'mobile' => 'required|max:255|min:2',
        ]);

        

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->mobile = $request->mobile;
        $customer->save();

        $user = User::findOrfail($customer->user_id);
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->save();
        
        if($request->hasFile('file_name')){
            for ($i=0; $i <count($request->file_name) ; $i++) { 
                $userfiles = CustomerFile::findOrfail($request->file_name_hidden[$i]);
                $userfiles->file_name = $request->file_name[$i];
                $userfiles->save();
            }
        }
        
        if ($request->hasFile('file_path')) {
            for ($i=0; $i <count($request->file_path) ; $i++) {
                $userfiles = CustomerFile::where('file_name',$request->file_name[$i])->where('file_path',$request->file_path[$i])->where('customer_id',$customer->id)->get()->first();
                
                $image = $request->file('file_path')[$i];
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/customers/files');
                $image->move($destinationPath, $name);
                $userfiles->file_path = $name;
                $userfiles->customer_id = $customer->id;
                $userfiles->save();
            }
            
        }


        return redirect()->route('customers')->with('success',__('tr.User Updated'));
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_customers'))
            abort(403);
        $customer = Customer::findOrfail($id);
        $customer->delete();

        return redirect()->route('customers')->with('success',__('tr.User Deleted'));
    }

}
