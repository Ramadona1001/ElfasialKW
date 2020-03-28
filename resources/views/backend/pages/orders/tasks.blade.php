@extends('backend.layouts.master')

@section('ordersactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Tasks'))
    
@section('stylesheet')
    
@endsection

@section('content')

<style>
    .formP{
        cursor: not-allowed;
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
                   
                <form action="{{ route('store_tasksorders_inventory') }}" method="post" enctype="multipart/form-data">
                    @csrf
                   <input type="hidden" name="order_id" value="{{ $orders->id }}">
                   <input type="hidden" name="customer_id" value="{{ $orders->customer->id }}">
                   <div class="row">
                       <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="order_id">@lang('tr.Order')</label>
                                    <p class="formP">{{ $orders->order_code }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="order_id">@lang('tr.Address')</label>
                                    <p class="formP">{{ $orders->address }}</p>
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="order_id">@lang('tr.Day')</label>
                                    <p class="formP">{{ $orders->order_day }}</p>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="order_id">@lang('tr.From')</label>
                                    <p class="formP">{{ $orders->order_from }}</p>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="order_id">@lang('tr.To')</label>
                                    <p class="formP">{{ $orders->order_to }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="order_id">@lang('tr.Customer')</label>
                                    <p class="formP">{{ $orders->customer->name }}</p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="order_id">@lang('tr.Mobile')</label>
                                    <p class="formP">{{ $orders->customer->mobile }}</p>
                                </div>
                            </div>
                            
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="order_id">@lang('tr.Order Data')</label>
                                    <select name="order_task" class="form-control" id="order_id" required>
                                        <option value="">@lang('tr.Order Data')</option>
                                        @foreach($all_orders as $index => $value)
                                        <option value="{{ $value }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="user_id">@lang('tr.User')</label>
                                    <select name="user_id" id="user_id" class="form-control" required>
                                        <option value="">@lang('tr.Select User')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="department_task_id">@lang('tr.Department Task')</label>
                                    <select name="department_task_id" id="department_task_id" class="form-control" required>
                                        <option value="">@lang('tr.Select Department Tasks')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6" id="taskDay" style="display:none;">
                                <div class="form-group">
                                    <label for="task_date">@lang('tr.Day')</label>
                                    <input type="date" name="task_date" id="task_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-lg-6" id="taskStatus" style="display:none;">
                                <div class="form-group">
                                    <label for="status">@lang('tr.Status')</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="">@lang('tr.Select Status')</option>
                                        <option value="1">@lang('tr.Start')</option>
                                        <option value="2">@lang('tr.Pending')</option>
                                        <option value="3">@lang('tr.Finished')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12" id="taskNote" style="display:none;">
                                <label for="notes">@lang('tr.Task Notes')</label>
                                <input type="text" name="notes" class="form-control" id="notes">
                            </div>


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

    $("#department_id").change(function(e){
       if($(this).val() != ''){

            
            var dep_id = $(this).val();
            var userUrl = '{{ route("users_tasks",["id"=>"#id"]) }}';
            var departmentTasksUrl = '{{ route("departments_tasks_tasks",["id"=>"#id"]) }}';
            userUrl = userUrl.replace('#id',dep_id);
            departmentTasksUrl = departmentTasksUrl.replace('#id',dep_id);

            var userhtmlData = '';
            var deprtmentTaskshtmlData = '';
            $.ajax({
            type:'GET',
            url:userUrl,
            data:{},
                success:function(data){
                    $.each(data.users, function( index, value ) {
                        userhtmlData = new Option(value.name,value.id);
                    });
                    
                    $('#user_id').append(userhtmlData);
                    
                }
            });

            $.ajax({
            type:'GET',
            url:departmentTasksUrl,
            data:{},
                success:function(departmentTasks){
                    $.each(departmentTasks.departmenttasks, function( index, value ) {
                        deprtmentTaskshtmlData = new Option(value.name,value.id);
                    });
                    
                    $('#department_task_id').append(deprtmentTaskshtmlData);
                    
                }
            });
            $('#taskNote').css('display','block');
            $('#taskDay').css('display','block');
            $('#taskStatus').css('display','block');
            
       }else{
        $('#user_id option').each(function() {
            if ( $(this).val() != '' ) {
                $(this).remove();
            }
        });

        $('#department_task_id option').each(function() {
            if ( $(this).val() != '' ) {
                $(this).remove();
            }
        });

        $('#taskNote').css('display','none');
        $('#taskDay').css('display','none');
        $('#taskStatus').css('display','none');
        

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