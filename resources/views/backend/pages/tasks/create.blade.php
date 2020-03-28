@extends('backend.layouts.master')

@section('tasksactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Tasks'))
    
@section('stylesheet')
    
@endsection

@section('content')

<style>
    .formP{
        display: block;
        width: 100%;
        height: calc(1.5em + 1.3rem + 2px);
        padding: 0.65rem 1rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: black;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #d0cfcf;
        border-radius: 0;
        -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    }
</style>

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Assign Task')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('store_tasks') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                   <div class="row">
                       <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="order_id">@lang('tr.Order')</label>
                                    <select name="order_id" id="order_id" class="form-control" required>
                                        <option value="">@lang('tr.Select Order')</option>
                                        @foreach ($orders as $order)
                                            <option value="{{ $order->id }}">{{ $order->order_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
    
                        <div class="row" id="orderData" style="padding:10px;">
    
                        </div>
                       </div>
                       <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="department_id">@lang('tr.Department')</label>
                                    <select name="department_id" id="department_id" class="form-control" required>
                                        <option value="">@lang('tr.Select Department')</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="usersData" style="padding:10px;">
    
                        </div>

                       </div>
                   </div>

                   <div class="row" id="taskNote" style="display:none;">
                       <div class="col-lg-12" style="padding:10px;">
                            <label for="notes" style="font-weight:bold;">@lang('tr.Task Notes')</label>
                           <textarea name="notes" class="form-control" id="notes" cols="30" rows="10" placeholder="@lang('tr.Task Notes')"></textarea>
                       </div>
                   </div>

                 
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i>&nbsp;@lang('tr.Save')
                        </button>
                    </div>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>


    
@endsection

@section('javascript')
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#department_id").change(function(e){
       if($(this).val() != ''){
            var dep_id = $(this).val();
            var userUrl = '{{ route("users_tasks",["id"=>"#id"]) }}';
            var departmentTasksUrl = '{{ route("departments_tasks_tasks",["id"=>"#id"]) }}';
            userUrl = userUrl.replace('#id',dep_id);
            departmentTasksUrl = departmentTasksUrl.replace('#id',dep_id);

            var userhtmlData = '';
            $.ajax({
            type:'GET',
            url:userUrl,
            data:{},
                success:function(data){
                    userhtmlData += '<div style="margin-bottom: 35px; display: block; width: 100%;"><label for="user_id">@lang("tr.User")</label>';
                    userhtmlData += '<select name="user_id" class="form-control formP" required>';
                    userhtmlData += '<option value="">@lang("tr.Select User")</option>';
                    $.each(data.users, function( index, value ) {
                        userhtmlData += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    userhtmlData +='</select></div>';
                    $('#usersData').html(userhtmlData);
                    
                }
            });

            $.ajax({
            type:'GET',
            url:departmentTasksUrl,
            data:{},
                success:function(departmentTasks){
                    userhtmlData += '<label for="department_task_id">@lang("tr.Department Tasks")</label>';
                    userhtmlData += '<select name="department_task_id" class="form-control formP" required>';
                    userhtmlData += '<option value="">@lang("tr.Select Task")</option>';
                    $.each(departmentTasks.departmenttasks, function( index, value ) {
                        userhtmlData += '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    userhtmlData +='</select>';
                    
                    // Task Date
                    userhtmlData += '<div style="margin-top: 35px; display: block; width: 100%;"><label for="task_date">@lang("tr.Date")</label>';
                    userhtmlData += '<input type="date" name="task_date" id="task_date" class="form-control" required></div>';

                    // Task Status
                    userhtmlData += '<div style="margin-top: 35px; display: block; width: 100%;"><label for="task_status">@lang("tr.Status")</label>';
                    userhtmlData += '<select name="task_status" class="form-control formP" required>';
                    userhtmlData += '<option value="">@lang("tr.Select Status")</option>';
                    userhtmlData += '<option value="1">@lang("tr.Start")</option>';
                    userhtmlData += '<option value="2">@lang("tr.Pending")</option>';
                    userhtmlData += '<option value="3">@lang("tr.Finished")</option>';
                    userhtmlData += '</select>';

                    $('#taskNote').css('display','block');

                    $('#usersData').html(userhtmlData);
                    
                }
            });
       }else{
        $('#taskNote').css('display','none');
        $('#usersData').text('');
       }

	});

   

    $("#order_id").change(function(e){
       if($(this).val() != ''){
            var order_id = $(this).val();
            var orderUrl = '{{ route("orders_tasks",["id"=>"#id"]) }}';
            var catalogUrl = '{{ route("catalogs_tasks",["id"=>"#id"]) }}';
            var catalogItemUrl = '{{ route("catalogsitems_tasks",["id"=>"#id"]) }}';
            var customerUrl = '{{ route("customers_tasks",["id"=>"#id"]) }}';
            var url = orderUrl.replace('#id',order_id);
            var decode_order_data = '{{ route("decode_data_tasks",["id"=>"#id"]) }}';
            var orderData = '';
            var htmlData = '';
            $.ajax({
            type:'GET',
            url:url,
            data:{},
                success:function(data){
                    var catUrl = catalogUrl.replace('#id',data.orders.catalog_id);
                    var catItemUrl = catalogItemUrl.replace('#id',data.orders.id);
                    customerUrl = customerUrl.replace('#id',data.orders.customer_id);
                    decode_order_data = decode_order_data.replace('#id',data.orders.id);
                    orderData = data.orders.order_day;
                    htmlData += '<p style="background:#eee;width:100%;height:1px;"></p>';
                    htmlData += '<div class="col-lg-6">';
                    htmlData += '<div class="form-group">';
                    htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Order Code")</label>';
                    htmlData += '<p class="formP">'+data.orders.order_code+'</p>';
                    htmlData += '</div>';
                    htmlData += '</div>';

                    htmlData += '<div class="col-lg-6">';
                    htmlData += '<div class="form-group">';
                    htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Address")</label>';
                    htmlData += '<p class="formP">'+data.orders.address+'</p>';
                    htmlData += '</div>';
                    htmlData += '</div>';

                    htmlData += '<div class="col-lg-4">';
                    htmlData += '<div class="form-group">';
                    htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Day")</label>';
                    htmlData += '<p class="formP">'+data.orders.order_day+'</p>';
                    htmlData += '</div>';
                    htmlData += '</div>';
                    
                    htmlData += '<div class="col-lg-4">';
                    htmlData += '<div class="form-group">';
                    htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.From")</label>';
                    htmlData += '<p class="formP">'+data.orders.order_from+'</p>';
                    htmlData += '</div>';
                    htmlData += '</div>';

                    htmlData += '<div class="col-lg-4">';
                    htmlData += '<div class="form-group">';
                    htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.To")</label>';
                    htmlData += '<p class="formP">'+data.orders.order_to+'</p>';
                    htmlData += '</div>';
                    htmlData += '</div>';

                    $.ajax({
                        type:'GET',
                        url:decode_order_data,
                        data:{},
                            success:function(all_orders){
                                htmlData += '<div class="col-lg-12">';
                                htmlData += '<div class="form-group">';
                                htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Order Data")</label>';
                                htmlData += '<select class="form-control" name="order_task" required>';
                                htmlData += '<option value="">@lang("tr.Select Data")</option>';
                                $.each(all_orders.all_orders, function( index, value ) {
                                    htmlData += '<option value="'+value+'">'+value+'</option>';
                                });
                                htmlData += '</select>';
                                htmlData += '</div>';
                                htmlData += '</div>';
                            }

                        });
                    
                    

                    $.ajax({
                        type:'GET',
                        url:customerUrl,
                        data:{},
                            success:function(customers){
                                htmlData += '<input type="hidden" name="customer_id" value="'+customers.customers.id+'">';

                                htmlData += '<p style="background:#eee;width:100%;height:1px;"></p>';
                                htmlData += '<div class="col-lg-6">';
                                htmlData += '<div class="form-group">';
                                htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Customer")</label>';
                                htmlData += '<p class="formP">'+customers.customers.name+'</p>';
                                htmlData += '</div>';
                                htmlData += '</div>';

                                htmlData += '<div class="col-lg-6">';
                                htmlData += '<div class="form-group">';
                                htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Mobile")</label>';
                                htmlData += '<p class="formP">'+customers.customers.mobile+'</p>';
                                htmlData += '</div>';
                                htmlData += '</div>';


                                
                                $('#orderData').html(htmlData);
                            }
                        });


                    $('#orderData').html(htmlData);
                }
            });
       }else{
        $('#orderData').text('');
       }

	});


</script>

<script>
    function validate(evt) {
      var theEvent = evt || window.event;
    
      // Handle paste
      if (theEvent.type === 'paste') {
          key = event.clipboardData.getData('text/plain');
      } else {
      // Handle key press
          var key = theEvent.keyCode || theEvent.which;
          key = String.fromCharCode(key);
      }
      var regex = /[0-9]|\./;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }
    </script>
@endsection