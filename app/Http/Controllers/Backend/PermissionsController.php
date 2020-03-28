<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Auth;
use Session;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $permissions = Permission::all();
        $permissions_array = [];
        foreach ($permissions as $permission) {
            $permission = explode('_',$permission->name)[1];
            if (!in_array($permission,$permissions_array)) {
                array_push($permissions_array,$permission);
            }
            
        }
        return view('backend.pages.permissions.index',compact('permissions','permissions_array'));
    }

    
    public function create()
    {
        return view('backend.pages.permissions.create');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions|max:255|min:2',
        ]);

        Permission::create(['name' => $request->name]);
        return redirect()->route('permissions')->with('success',__('tr.Permissions Added'));
    }

   
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $permission = Permission::findOrfail($id);
        return view('backend.pages.permissions.edit',compact('permission'));
    }

    public function update(Request $request,$id)
    {
        $permission = Permission::findOrfail($id);
        $request->validate([
            'name' => 'required|unique:permissions,name,'.$permission->id,
        ]);

        $permission->name = $request->name;
        $permission->save();
        return redirect()->route('permissions')->with('success',__('tr.Permission Updated'));
    }

   
    public function destroy($id)
    {
        $permissions = Permission::findOrfail($id);
        $permissions->delete();
        return redirect()->route('permissions')->with('success',__('tr.Permissions Deleted'));
    }
}
