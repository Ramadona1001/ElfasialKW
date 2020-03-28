@extends('backend.layouts.master')

@section('title',__('tr.Show Department'))

@section('departmentsactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Show Department')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>@lang('tr.Name')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $department->name }}</p>
                        </div>
                        
                    </div>

                    <div class="row" style="padding:20px;">
                        <h2>@lang('tr.Users')</h2>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr><th style="text-align: center; color: #db1430; font-size: 15px;">#</th>
                                <th style="text-align: center; color: #db1430; font-size: 15px;">@lang('tr.User')</th>
                                <th style="text-align: center; color: #db1430; font-size: 15px;">@lang('tr.Action')</th>
                            </tr></thead>
                            <tbody>
                                @foreach ($usersDepartment as $index => $user)
                                <tr style="font-weight:bold;text-align:center;">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->user->name }}</td>
                                    <td>
                                    @can('delete_departments')
                                    <a onclick="return confirm('Are You Sure ?')" style="color: red;" href="{{ route('delete_users_departments',$user->id) }}"><i class="fa fa-trash"></i></a>
                                    @endcan
                                    </td>
                                </tr>
                                @endforeach  
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    <br>
                    <h6 style="text-align:center;">
                        @can('edit_departments')
                        <a href="{{ route('edit_departments',$department->id) }}" style="background: purple; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.Edit')</a>&nbsp;
                        @endcan

                        @can('delete_departments')
                        <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_departments',$department->id) }}">@lang('tr.Delete')</a>
                        @endcan
                    </h6>

                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>


    
@endsection

@section('javascript')
    

@endsection