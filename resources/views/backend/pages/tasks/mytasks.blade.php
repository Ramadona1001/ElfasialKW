@extends('backend.layouts.master')

@section('mytasksactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.My Tasks'))
    
@section('stylesheet')
    {{-- Calendar --}}
	<link href="{{ asset('backend/calendar/main1.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('backend/calendar/main2.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('backend/calendar/main3.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('backend/calendar/main4.css')}}" rel="stylesheet" type="text/css" />

	<style>
	.fc-unthemed .fc-event .fc-title{
		color: #f05f78 !important;
    	font-weight: bold;
	}
	</style>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12">
        @can('show_calendar_tasks')
        <div class="row">
            <div class="kt-portlet ">
                <div class="kt-portlet__body">
                    <div class="col-lg-12 calbg" >
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>  
        </div>
        @endcan

    
    </div>
</div>

<div class="row">
    
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Tasks')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                   
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">

                    <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Order Task')</th>
                                <th class="tdesign">@lang('tr.Task Date')</th>
                                <th class="tdesign">@lang('tr.Status')</th>
                                <th class="tdesign">@lang('tr.Notes')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($myTasks as $index => $task)
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign">{{ $task->order_task }}</td>
                                <td class="tdesign">{{ $task->task_date }}</td>
                                <td class="tdesign" style="font-weight:bold;color:#f05f78;">
                                    {{ $task->taskStatus($task->status) }}
                                </td>
                                <td class="tdesign">{{ $task->notes }}</td>
                                <td class="tdesign">
                                    
                                    @can('change_tasks_status')
                                    @if($task->status == 1)
                                    <a href="{{ route('departments_pending_mytasks',$task->id) }}" class="pinkbutton">@lang('tr.Pending')</a>&nbsp;
                                    <a href="{{ route('departments_finish_mytasks',$task->id) }}" class="pinkbutton">@lang('tr.Finished')</a>&nbsp;
                                    @endif
                                    @if($task->status == 2)
                                    <a href="{{ route('departments_finish_mytasks',$task->id) }}" class="pinkbutton">@lang('tr.Finished')</a>&nbsp;
                                    @endif
                                    @endcan

                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tdesign">#</th>
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



{{-- Calendar --}}
<script src="{{ asset('backend/calendar/main1.js')}}"></script>
<script src="{{ asset('backend/calendar/main2.js')}}"></script>
<script src="{{ asset('backend/calendar/main3.js')}}"></script>
<script src="{{ asset('backend/calendar/main4.js')}}"></script>
<script src="{{ asset('backend/calendar/main5.js')}}"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({responsive:true});
    } );
</script>

<script>

	document.addEventListener('DOMContentLoaded', function() {
	  var calendarEl = document.getElementById('calendar');
  
	  var calendar = new FullCalendar.Calendar(calendarEl, {
		plugins: [ 'dayGrid', 'timeGrid', 'list', 'interaction' ],
		header: {
		  left: 'prev,next today',
		  center: 'title',
		  right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
		},
		defaultDate: '{{ date("Y-m-d") }}',
		navLinks: true, // can click day/week names to navigate views
		editable: true,
		eventLimit: true, // allow "more" link when too many events
		events: [

			<?php

				foreach($myTasks as $task){
					echo "{ title: '".$task->order_task."',start: '".$task->task_date."'},";
				}

			?>
		]
	  });
  
	  calendar.render();
	});
  
  </script>



@endsection