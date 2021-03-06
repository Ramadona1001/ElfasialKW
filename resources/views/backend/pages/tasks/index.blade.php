@extends('backend.layouts.master')

@section('tasksactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Tasks'))
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Tasks')
                    </h3>
                </div>
                <!-- <div class="kt-portlet__head-toolbar">
                    @can('create_tasks')
                    <a href="{{ route('create_tasks') }}" class="btn btn-primary">@lang('tr.Create New Task')</a>
                    @endcan
                </div> -->
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">

                    <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Customer')</th>
                                <th class="tdesign">@lang('tr.User')</th>
                                <th class="tdesign">@lang('tr.Order')</th>
                                <th class="tdesign">@lang('tr.Department Task')</th>
                                <th class="tdesign">@lang('tr.Department')</th>
                                <th class="tdesign">@lang('tr.Order Task')</th>
                                <th class="tdesign">@lang('tr.Task Date')</th>
                                <th class="tdesign">@lang('tr.Status')</th>
                                <th class="tdesign">@lang('tr.Notes')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $index => $task)
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign">{{ $task->customer_phone }}</td>
                                <td class="tdesign">{{ $task->user->name }}</td>
                                <td class="tdesign">{{ $task->mainorder->code }}</td>
                                <td class="tdesign">{{ $task->departmentTaskName($task->department_task_id)->name }}</td>
                                <td class="tdesign">{{ $task->departmentName($task->department_id)->name }}</td>
                                <td class="tdesign">{{ $task->order_task }}</td>
                                <td class="tdesign">{{ $task->task_date }}</td>
                                <td class="tdesign">
                                    {{ $task->taskStatus($task->status) }}
                                </td>
                                <td class="tdesign">{{ $task->notes }}</td>
                                <td class="tdesign">
                                    
                                    @can('delete_tasks')
                                    <a onclick="return confirm('Are You Sure ?')" class="redbutton" href="{{ route('delete_tasks',$task->id) }}">@lang('tr.Delete')</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Customer')</th>
                                <th class="tdesign">@lang('tr.User')</th>
                                <th class="tdesign">@lang('tr.Order')</th>
                                <th class="tdesign">@lang('tr.Department Task')</th>
                                <th class="tdesign">@lang('tr.Department')</th>
                                <th class="tdesign">@lang('tr.Order Task')</th>
                                <th class="tdesign">@lang('tr.Task Date')</th>
                                <th class="tdesign">@lang('tr.Status')</th>
                                <th class="tdesign">@lang('tr.Notes')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({responsive:true});
    } );
</script>
@endsection