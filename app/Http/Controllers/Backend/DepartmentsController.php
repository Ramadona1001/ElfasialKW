<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;
use App\UserDeartment;
use Lang;
use Auth;

class DepartmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_departments'))
            abort(403);
        $lang = \Lang::getLocale();
        $departments = Department::select($lang.'_name as name','id')->get();
        return view('backend.pages.departments.index',compact('departments'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_departments'))
            abort(403);
        return view('backend.pages.departments.create');
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_departments'))
            abort(403);
        $request->validate([
            'en_name' => 'required|unique:departments|max:255|min:2',
            'ar_name' => 'required|unique:departments|max:255|min:2',
        ]);

        $department = new Department();

        $department->en_name = $request->en_name;
        $department->ar_name = $request->ar_name;

        $department->save();

        return redirect()->route('departments')->with('success',__('tr.User Added'));
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_departments'))
            abort(403);
        $lang = \Lang::getLocale();
        $department = Department::select($lang.'_name as name','id')->where('id',$id)->get()->first();
        $usersDepartment = UserDeartment::where('department_id',$id)->get();
        
        return view('backend.pages.departments.show',compact('department','usersDepartment'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_departments'))
            abort(403);
        $department = Department::findOrfail($id);
        return view('backend.pages.departments.edit',compact('department'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_departments'))
            abort(403);
        $department = Department::findOrfail($id);

        $request->validate([
            'ar_name' => 'required|unique:departments,ar_name,'.$department->id,
            'en_name' => 'required|unique:departments,en_name,'.$department->id,
        ]);

        $department->en_name = $request->en_name;
        $department->ar_name = $request->ar_name;

        $department->save();

        return redirect()->route('departments')->with('success',__(''));
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_departments'))
            abort(403);
        $department = Department::findOrfail($id);
        $department->delete();

        return redirect()->route('departments')->with('success',__(''));
    }

    public function destroyusers($id){
        if(!Auth::user()->hasPermissionTo('delete_departments'))
            abort(403);
            
        $usersDepartment = UserDeartment::findOrfail($id);
        $usersDepartment->delete();
        return back()->with('success',__(''));
    }

}
