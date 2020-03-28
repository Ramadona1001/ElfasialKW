@extends('backend.layouts.master')

@section('homesactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Home'))

@section('stylesheet')
	<link href="{{ asset('backend/backend/js/charts/Chart.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('backend/backend/css/chartstyle.css')}}" rel="stylesheet" type="text/css" />
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


@php($checkInventory = \App\Inventory::checkInventory())

@if($checkInventory)
<div class="row">
	<div class="col-lg-12">
		<div class="alert alert-danger fade show" role="alert">
			<div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
			<div class="alert-text">@lang('tr.Some Items are Out Of Inventory') - <a style="color: white; border-bottom: 1px dotted;" href="{{ route('inventory') }}">@lang('tr.Check')</a></div>
			<div class="alert-close">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true"><i class="la la-close"></i></span>
				</button>
			</div>
		</div>
	</div>
</div>
@endif

<div class="row">
	@can('show_statistics_users')
    <div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-users"></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('users') }}">@lang('tr.Users')</a>
						</h3>
						<div class="kt-iconbox__content">
							@lang('tr.Count') : {{ $user_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	@endcan


	@can('show_statistics_customers')
    <div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-customer" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('customers') }}">@lang('tr.Customers')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $customer_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan

	@can('show_statistics_departments')
    <div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-map" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('departments') }}">@lang('tr.Departments')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $department_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan
	
	@can('show_statistics_departments_tasks')
	<div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-open-box" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('department_tasks') }}">@lang('tr.Department Tasks')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $departmenttasks_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan

	@can('show_statistics_catalogs')
    <div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-book" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('catalogs') }}">@lang('tr.Catalogs')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $catalog_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan

	@can('show_statistics_catalogs_items')
    {{-- <div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-squares-3" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('items') }}">@lang('tr.Catalogs Items')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $catalog_item_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> --}}
	@endcan

	@can('show_statistics_inventory')
    <div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-layers" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('inventory') }}">@lang('tr.Inventory')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $inventory_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan

	@can('show_statistics_withdraw')
    <div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-folder-1" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('withdraw_inventory_show') }}">@lang('tr.Withdraw')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $withdraw_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan
	
	@can('show_statistics_orders')
	<div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-cart" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('orders') }}">@lang('tr.Orders')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $order_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan
	
	@can('show_statistics_tasks')
	<div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-list" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('tasks') }}">@lang('tr.Tasks')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $task_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan

	@can('show_statistics_my_tasks')
	<div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-list" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('departments_mytasks') }}">@lang('tr.My Tasks')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $myTasks }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan
	
	@can('show_statistics_buffets')
	<div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-menu-button" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('buffets') }}">@lang('tr.Buffets')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $buffet_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan
	
	@can('show_statistics_customers_choices')
	<div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-user-ok" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('fromchoices') }}">@lang('tr.Customer Choices')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $fromchoice_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan
	
	@can('show_statistics_contacts')
	<div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-support" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('contactus') }}">@lang('tr.Contacts')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $contact_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan
	
	@can('show_statistics_reviews')
	<div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-confetti" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="#">@lang('tr.Reviews')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $review_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan

	@can('show_statistics_feedbacks')
	<div class="col-lg-3">
        <div class="kt-portlet kt-iconbox kt-iconbox--danger ">
			<div class="kt-portlet__body">
				<div class="kt-iconbox__body">
					<div class="kt-iconbox__icon">
                        <i class="fa flaticon-confetti" ></i>
                    </div>
					<div class="kt-iconbox__desc">
						<h3 class="kt-iconbox__title">
							<a class="kt-link" href="{{ route('feedbacks') }}">@lang('tr.Feedback')</a>
						</h3>
						<div class="kt-iconbox__content" >
							@lang('tr.Count') : {{ $feedback_count }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endcan
	
	
</div>

<br>
<hr>
<br>

{{-- Calendar --}}

@can('show_calendar_orders')
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

<br>

<br>

{{-- Charts --}}
<div class="row">
	<div class="col-lg-6">

		<div class="kt-portlet ">
			<div class="kt-portlet__body">
				<canvas id="myDoughnutChart" class="mt-5" ></canvas>
			</div>
		</div>
	</div>


	<div class="col-lg-6">
		<div class="kt-portlet ">
			<div class="kt-portlet__body">

				<canvas id="myChart" class="mt-5"></canvas>
			</div>
		</div>
	</div>
</div>

@endsection

@section('javascript')

<script src="{{ asset('backend/js/charts/Chart.bundle.min.js')}}"></script>
<script src="{{ asset('backend/js/charts/Chart.min.js')}}"></script>



<script src="http://code.jquery.com/jquery-3.3.1.min.js"
		 		integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		 		crossorigin="anonymous">
</script>

{{-- Calendar --}}
<script src="{{ asset('backend/calendar/main1.js')}}"></script>
<script src="{{ asset('backend/calendar/main2.js')}}"></script>
<script src="{{ asset('backend/calendar/main3.js')}}"></script>
<script src="{{ asset('backend/calendar/main4.js')}}"></script>
<script src="{{ asset('backend/calendar/main5.js')}}"></script>


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

				foreach($orders as $order){
					echo "{ title: '".$order->order_code."',start: '".$order->order_day."',url: '".route("show_orders",$order->id)."',},";
				}

			?>
		]
	  });
  
	  calendar.render();
	});
  
  </script>


<script>
	$(document).ready(function () {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
		jQuery.ajax({
			url: "{{ route('profitstatistic') }}",
			method: 'get',
			data: {

			},
			success: function(result){
				//console.log(result.profits);
				var months = [];
				var profits = [];
				$.each(result.profits, function( index, value ) {
					months.push(value.month);
					profits.push(value.profit);
				});
				var ctx = document.getElementById('myChart');
				var myChart = new Chart(ctx, {
					type: 'line',
					data: {

						labels: months,

						datasets: [{
							label: 'profits',
							data: profits,
							backgroundColor: [
								'rgba(255, 99, 132, 0.2)',
								'rgba(54, 162, 235, 0.2)',
								'rgba(255, 206, 86, 0.2)',
								'rgba(75, 192, 192, 0.2)',
								'rgba(153, 102, 255, 0.2)',
								'rgba(255, 159, 64, 0.2)'
							],
							borderColor: [
								'rgba(255, 99, 132, 1)',
								'rgba(54, 162, 235, 1)',
								'rgba(255, 206, 86, 1)',
								'rgba(75, 192, 192, 1)',
								'rgba(153, 102, 255, 1)',
								'rgba(255, 159, 64, 1)'
							],
							borderWidth: 1

						}]
					},
					options: {
						scales: {
							yAxes: [{
								ticks: {
									beginAtZero: true
								}

							}]
						}
					}
				});
			}});
	});
</script>



<script>
		$(document).ready(function () {
				$.ajaxSetup({
							headers: {
							'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
		}

	});
				jQuery.ajax({
							url: "{{ route('statistic') }}",
							method: 'get',
							data: {
			
								},
					success: function(result){
							var arr_orders = [];
			
					                var orders = result.orders[0].count;
			
					                var tasks = result.tasks[0].count;
			
					                var contacts = result.contacts[0].count;
			
						    arr_orders.push(orders);
			                arr_orders.push(tasks);
			                arr_orders.push(contacts);
			
									console.log(arr_orders);
			
									var ctx = document.getElementById('myDoughnutChart');
							        var myDoughnutChart = new Chart(ctx, {
							   			type: 'doughnut',
										data: {
				
												labels: ['orders', 'tasks', 'contacts'],
						
														datasets: [{
											label: ['orders', 'tasks', 'contacts'],
													data: arr_orders,
						
															backgroundColor: [
													'#ffcd56',
													'#ff6384',
													'#36a2eb',
					
														],
													borderColor: [
													'#ffcd56',
													'#ff6384',
													'#36a2eb',
					
														],
													borderWidth: 1
				
										}]
									},
								options: {
										layout: {
												padding: {
														left: 10,
																right: 0,
																top: 0,
																bottom: 0
													}
											}
									}
							});
			
					}});
		
				
	});
</script>


@endsection