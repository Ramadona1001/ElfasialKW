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
                                            <option value="{{ $order->id }}">{{ $order->catalogName($order->catalog_id)->name }}</option>
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
                                    <label for="user_id">@lang('tr.User')</label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="">@lang('tr.Select User')</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="usersData" style="padding:10px;">
    
                        </div>

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

    $("#user_id").change(function(e){
       if($(this).val() != ''){
            var user_id = $(this).val();
            var userUrl = '{{ route("users_tasks",["id"=>"#id"]) }}';
            userUrl = userUrl.replace('#id',user_id);

            var userhtmlData = '';
            $.ajax({
            type:'GET',
            url:userUrl,
            data:{},
                success:function(data){
                    var departmentsUrl = '{{ route("departments_tasks",["id"=>"#id"]) }}';
                    departmentsUrl = departmentsUrl.replace('#id',data.users.id);
                    $.ajax({
                    type:'GET',
                    url:departmentsUrl,
                    data:{},
                        success:function(departments){
                            
                            userhtmlData += '<p style="background:#eee;width:100%;height:1px;"></p>';
                            userhtmlData += '<div class="col-lg-12">';
                            userhtmlData += '<div class="form-group">';
                            userhtmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Department")</label>';
                            userhtmlData += '<select name="department_id" class="form-control formP" required>';
                            userhtmlData += '<option value="">@lang("tr.Select Department")</option>';
                            $.each(departments.departments, function( index, value ) {
                                userhtmlData += '<option value="'+value.id+'">'+value.name+'</option>';
                            });
                            userhtmlData += '</select>';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';

                            userhtmlData += '<div class="col-lg-12">';
                            userhtmlData += '<div class="form-group">';
                            userhtmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Task Title")</label>';
                            userhtmlData += '<input type="text" class="form-control" required name="task_title" placeholder="@lang("tr.Task Title")">';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';

                            userhtmlData += '<div class="col-lg-12">';
                            userhtmlData += '<div class="form-group">';
                            userhtmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Date")</label>';
                            userhtmlData += '<input type="date" class="form-control" required name="task_date" value="{{ $order->order_day }}" min="{{ $order->order_day }}">';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';
                            
                            userhtmlData += '<div class="col-lg-12">';
                            userhtmlData += '<div class="form-group">';
                            userhtmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Notes")</label>';
                            userhtmlData += '<textarea class="form-control formP" name="notes"></textarea>';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';

                            userhtmlData += '<div class="col-lg-12">';
                            userhtmlData += '<div class="form-group">';
                            userhtmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Status")</label>';
                            userhtmlData += '<select name="status" class="form-control formP" required>';
                            userhtmlData += '<option value="">@lang("tr.Select Staus")</option>';
                            userhtmlData += '<option value="1">@lang("tr.Start")</option>';
                            userhtmlData += '<option value="2">@lang("tr.Pendding")</option>';
                            userhtmlData += '<option value="3">@lang("tr.Stop")</option>';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';
                            userhtmlData += '</div>';

                           

                            
                            $('#usersData').html(userhtmlData);
                        }
                    });
                    
                }
            });
       }else{
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
            
            var htmlData = '';
            $.ajax({
            type:'GET',
            url:url,
            data:{},
                success:function(data){
                    var catUrl = catalogUrl.replace('#id',data.orders.catalog_id);
                    var catItemUrl = catalogItemUrl.replace('#id',data.orders.catalog_id);
                    customerUrl = customerUrl.replace('#id',data.orders.customer_id);

                    htmlData += '<p style="background:#eee;width:100%;height:1px;"></p>';
                    htmlData += '<div class="col-lg-4">';
                    htmlData += '<div class="form-group">';
                    htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Order Code")</label>';
                    htmlData += '<p class="formP">'+data.orders.order_code+'</p>';
                    htmlData += '</div>';
                    htmlData += '</div>';

                    htmlData += '<div class="col-lg-4">';
                    htmlData += '<div class="form-group">';
                    htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Company")</label>';
                    htmlData += '<p class="formP">'+data.orders.company+'</p>';
                    htmlData += '</div>';
                    htmlData += '</div>';

                    htmlData += '<div class="col-lg-4">';
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
                        url:customerUrl,
                        data:{},
                            success:function(customers){
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



                    $.ajax({
                        type:'GET',
                        url:catUrl,
                        data:{},
                            success:function(catalog){
                                var cataImg = '{{ asset("catalogs/#id") }}';
                                htmlData += '<p style="background:#eee;width:100%;height:1px;"></p>';
                                htmlData += '<div class="col-lg-4">';
                                htmlData += '<img src="'+cataImg.replace("#id",catalog.catalogs.catalog_img)+'" style="width: 100%;">';
                                htmlData += '</div>';
                                htmlData += '<div class="col-lg-8">';
                                htmlData += '<div class="form-group">';
                                htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Catalog")</label>';
                                htmlData += '<p class="formP">'+catalog.catalogs.name+'</p>';
                                htmlData += '</div>';
                                htmlData += '</div>';


                                
                                $('#orderData').html(htmlData);
                            }
                        });

                    $.ajax({
                    type:'GET',
                    url:catItemUrl,
                    data:{},
                        success:function(catalogsItems){
                            htmlData += '<p style="background:#eee;width:100%;height:1px;"></p>';
                            htmlData += '<div class="col-lg-3">';
                            htmlData += '<div class="form-group">';
                            htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Item")</label>';
                            htmlData += '<p class="formP">'+catalogsItems.catalogsItems.name+'</p>';
                            htmlData += '</div>';
                            htmlData += '</div>';

                            htmlData += '<div class="col-lg-3">';
                            htmlData += '<div class="form-group">';
                            htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Price")</label>';
                            htmlData += '<p class="formP">'+catalogsItems.catalogsItems.price+'</p>';
                            htmlData += '</div>';
                            htmlData += '</div>';

                            htmlData += '<div class="col-lg-3">';
                            htmlData += '<div class="form-group">';
                            htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Quantity")</label>';
                            htmlData += '<p class="formP">'+catalogsItems.catalogsItems.quantity+'</p>';
                            htmlData += '</div>';
                            htmlData += '</div>';

                            htmlData += '<div class="col-lg-3">';
                            htmlData += '<div class="form-group">';
                            htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Added Value")</label>';
                            htmlData += '<p class="formP">'+(catalogsItems.catalogsItems.total_price - (catalogsItems.catalogsItems.price * catalogsItems.catalogsItems.quantity))+'</p>';
                            htmlData += '</div>';
                            htmlData += '</div>';

                            htmlData += '<div class="col-lg-12">';
                            htmlData += '<div class="form-group">';
                            htmlData += '<label for="formP" style="font-weight:bold;">@lang("tr.Total")</label>';
                            htmlData += '<p class="formP">'+catalogsItems.catalogsItems.total_price+'</p>';
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