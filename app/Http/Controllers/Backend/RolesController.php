<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use Auth;
use Session;
use DB;

class RolesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();
        return view('backend.pages.roles.index',compact('roles'));
    }


    public function create()
    {
        return view('backend.pages.roles.create');
    }
    
    public function edit($id)
    {
        $role = Role::findOrfail($id);
        return view('backend.pages.roles.edit',compact('role'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255|min:2',
        ]);

        Role::create(['name' => $request->name]);
        return redirect()->route('roles')->with('success',__('tr.Roles Added'));
    }


    public function show($id)
    {
        $role = Role::findOrfail($id);
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('backend.pages.roles.show',compact('role','users','roles'));
    }

    public function update(Request $request,$id)
    {
        $role = Role::findOrfail($id);

        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
        ]);

        $role->name = $request->name;
        $role->save();
        return redirect()->route('roles')->with('success',__('tr.Roles Updated'));
    }


    public function destroy($id)
    {
        $role = Role::findOrfail($id);
        //DB::select('delete from model_has_roles where role_id = '.$role->id);
        $role->delete();
        return redirect()->route('roles')->with('success',__('tr.Roles Deleted'));
    }

    public function assignPermission($id){
        $role = Role::findOrfail($id);
        $roles_permissions = array();
        if (count($role->permissions) > 0) {
            foreach ($role->permissions as $permission) {
                array_push($roles_permissions,$permission->id);
            }
            $permissions = DB::select('SELECT * FROM permissions WHERE id NOT IN ('.implode(',',$roles_permissions).')');
        }else{
            $permissions = Permission::all();
        }
        return view('backend.pages.roles.assign_permissions',compact('permissions','role'));
    }

    public function assignPermissionPost($id,Request $request){
        $role = Role::findOrfail($id);
        $permissions = Permission::all();
        
        foreach ($permissions as $permission) {
            $role->revokePermissionTo($permission->id);
        }

        foreach ($request->permission_id as $permission) {
            $role->givePermissionTo($permission);
        }
        
        return redirect()->route('roles')->with('success',__('tr.Permission Assigned To Role'));
    }
}
