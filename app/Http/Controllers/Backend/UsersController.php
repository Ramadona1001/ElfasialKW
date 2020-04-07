<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Department;
use App\Customer;
use App\UserDeartment;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Hash;
use Session;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_users'))
            abort(403);

        $users = User::all();
        $lang = \Lang::getLocale();
        $departments = Department::select($lang.'_name as name','id')->get();
        return view('backend.pages.users.index',compact('users','departments'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_users'))
            abort(403);
        $lang = \Lang::getLocale();
        $departments = Department::select($lang.'_name as name','id')->get();
        return view('backend.pages.users.create',compact('departments'));
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_users'))
            abort(403);

        $request->validate([
            'name' => 'required|max:255|min:2',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6|max:20',
            'mobile' => 'required'
        ]);

        $user = new User();
        
        $user->mobile = $request->mobile;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        //$user->department_id = $request->department;

        $user->save();

        return redirect()->route('users')->with('success',__('tr.User Added'));
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_users'))
            abort(403);
        $user = User::findOrfail($id);
        $usersDepartment = UserDeartment::where('user_id',$id)->get();
        return view('backend.pages.users.show',compact('user','usersDepartment'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_users'))
            abort(403);
        $lang = \Lang::getLocale();
        $user = User::findOrfail($id);
        $departments = Department::select($lang.'_name as name','id')->get();
        return view('backend.pages.users.edit',compact('user','departments'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_users'))
            abort(403);
        $user = User::findOrfail($id);

        $request->validate([
            'name' => 'required|unique:roles|max:255|min:2',
            'email' => 'unique:users,email,'.$user->id,
            'mobile' => 'required'
        ]);

        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users')->with('success',__('tr.User Updated'));
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_users'))
            abort(403);
        $user = User::findOrfail($id);
        $roles = Role::all();
        foreach ($roles as $role) {
            $user->removeRole($role->id);
        }
        $user->delete();

        return redirect()->route('users')->with('success',__('tr.User Deleted'));
    }

    public function permissions($id){
        if(!Auth::user()->hasPermissionTo('permission_users'))
            abort(403);
        $user = User::findOrfail($id);
        $permissions = Permission::all();
        $permissions_users = [];

        $permissions_array = [];
        foreach ($permissions as $permission) {
            $permission = explode('_',$permission->name)[1];
            if (!in_array($permission,$permissions_array)) {
                array_push($permissions_array,$permission);
            }
        }

        if($user->permissions != null){
            if (count($user->permissions) > 0) {
                foreach ($user->permissions as $user_permission) {
                    array_push($permissions_users,$user_permission->id);
                }
            }else{
                $permissions = Permission::all();
            }
        }

        return view('backend.pages.permissions.index',compact('permissions','user','permissions_array','permissions_users'));
    
    }

    public function permissionsAssign(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('permission_users'))
            abort(403);
        $user_id = $request->user_id;
        $user = User::findOrfail($user_id);
        // \DB::select('delete from model_has_permissions where model_id = '.$user_id);
        $user->syncPermissions();
        if (isset($request->permissions)) {
            foreach ($request->permissions as $permission) {
                $user->givePermissionTo($permission);
            }
        }
        
        return back()->with('success',__(''));
    }

    public function departments(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('department_users'))
            abort(403);
        if (isset($request->department_id) != null) {
            $userDep = UserDeartment::where('department_id',$request->department_id)->get()->first();
            $userDep->department_id = $request->department;
            $userDep->user_id = $request->user_id;
        }else{
            $userDep = new UserDeartment();
            $userDep->department_id = $request->department;
            $userDep->user_id = $request->user_id;
        }
        
        $userDep->save();
        return back()->with('success',__(''));
    }

    public function assignRolesPost(Request $request,$id){
        $roles = Role::all();
        $user = User::findOrfail($id);
        
        foreach ($roles as $role) {
            $user->removeRole($role->id);
        }

        foreach ($request->role_id as $user_role) {
            $user->assignRole($user_role);
        }
        return redirect()->route('Users')->with('success',__(''));
    }

    public function profile($id){
        $user = User::findOrfail(Auth::user()->id);
        $lang = \Lang::getLocale();
        $departments = Department::select('departments.'.$lang.'_name as name','departments.id')->get();
        $user_deartments = UserDeartment::where('user_id',$id)->get()->first();
        return view('backend.pages.users.profile',compact('user','departments','user_deartments'));
    }
    
    public function profile_update(Request $request,$id){
        if(!Auth::user()->hasPermissionTo('edit_profiles'))
            abort(403);
        $user = User::findOrfail($id);
        if($request->password != null){
            $request->validate([
                'name' => 'required|unique:roles|max:255|min:2',
                'mobile' => 'required',
                'password' => 'required|confirmed|min:6|max:20',
            ]);

            $user = User::findOrfail($id);
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->password = Hash::make($request->password);
            $user->save();

            
        }else{
            $request->validate([
                'name' => 'required|unique:roles|max:255|min:2',
                'mobile' => 'required'
            ]);

            $user = User::findOrfail($id);
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->save();
        }

        // $userDep = UserDeartment::where('user_id',$id)->get()->first();
        // // $userDep->department_id = $request->department;
        // $userDep->user_id = $id;
        // $userDep->save();

        return redirect()->route('dashboard_index')->with('success','');
    }
}
