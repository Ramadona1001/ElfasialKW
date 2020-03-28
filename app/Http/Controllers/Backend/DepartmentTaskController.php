<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DepartmentTask;
use App\Department;
use Auth;

class DepartmentTaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(!Auth::user()->hasPermissionTo('show_menu_departments_tasks'))
            abort(403);

        $lang = \Lang::getLocale();
        $departmentsTasks = DepartmentTask::select($lang.'_name as name',$lang.'_desc as desc','department_id','id')->get();
        return view('backend.pages.departmenttasks.index',compact('departmentsTasks'));
    }

  
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('create_departments'))
            abort(403);
        $lang = \Lang::getLocale();
        $departments = Department::select($lang.'_name as name','id')->get();
        return view('backend.pages.departmenttasks.create',compact('departments'));
    }

   
    public function store(Request $request)
    {
        if(!Auth::user()->hasPermissionTo('create_departments'))
            abort(403);
        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|max:255|min:2',
            'ar_desc' => 'required|max:255|min:2',
        ]);

        $departmentsTasks = new DepartmentTask();

        $departmentsTasks->en_name = $request->en_name;
        $departmentsTasks->ar_name = $request->ar_name;
        $departmentsTasks->ar_desc = $request->ar_desc;
        $departmentsTasks->en_desc = $request->en_desc;
        $departmentsTasks->department_id = $request->department_id;

        $departmentsTasks->save();

        return redirect()->route('department_tasks')->with('success',__('tr.User Added'));
    }

  
    public function show($id)
    {
        if(!Auth::user()->hasPermissionTo('show_departments'))
            abort(403);
        $lang = \Lang::getLocale();
        $department = Department::select($lang.'_name as name','id')->where('id',$id)->get()->first();
        
        return view('backend.pages.departmenttasks.show',compact('department'));
    }

    public function edit($id)
    {
        if(!Auth::user()->hasPermissionTo('edit_departments'))
            abort(403);
        $lang = \Lang::getLocale();
        $departments = Department::select($lang.'_name as name','id')->get();
        $departmentTask = DepartmentTask::findOrfail($id);
        return view('backend.pages.departmenttasks.edit',compact('departments','departmentTask'));
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()->hasPermissionTo('edit_departments'))
            abort(403);
        $departmentsTasks = DepartmentTask::findOrfail($id);

        $request->validate([
            'en_name' => 'required|max:255|min:2',
            'ar_name' => 'required|max:255|min:2',
            'en_desc' => 'required|max:255|min:2',
            'ar_desc' => 'required|max:255|min:2',
        ]);


        $departmentsTasks->en_name = $request->en_name;
        $departmentsTasks->ar_name = $request->ar_name;
        $departmentsTasks->ar_desc = $request->ar_desc;
        $departmentsTasks->en_desc = $request->en_desc;
        $departmentsTasks->department_id = $request->department_id;

        $departmentsTasks->save();

        return redirect()->route('department_tasks')->with('success',__('tr.User Updated'));
        
    }

    public function destroy($id)
    {
        if(!Auth::user()->hasPermissionTo('delete_departments'))
            abort(403);
        $departmentsTasks = DepartmentTask::findOrfail($id);
        $departmentsTasks->delete();

        return redirect()->route('department_tasks')->with('success',__('tr.User Deleted'));
    }
}
