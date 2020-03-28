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
        background-color: #e4e4e491;
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
                        @lang('tr.Tasks')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit" style="padding:20px;">
                <div id="printInvoice">
                <div class="col-xl-12 order-lg-2 order-xl-1" style="padding:20px;border: 2px solid #eee;">
                    <h4>@lang('tr.Tasks')</h4>
                    <div class="row">
                       <div class="col-lg-4">
                            <p class="formP">@lang('tr.Task Title') : {{ $tasks->task_title }}</p>
                       </div>
                       <div class="col-lg-4">
                        <p class="formP">@lang('tr.Task Date') : {{ $tasks->task_date }}</p>
                       </div>
                       
                       <div class="col-lg-4">
                        <p class="formP">@lang('tr.Status') : {{ $tasks->taskStatus($tasks->status) }}</p>
                       </div>
                   </div>

                   <div class="row">
                    <div class="col-lg-12">
                         <p class="formP">@lang('tr.Notes') : {{ $tasks->notes }}</p>
                    </div>
                </div>

                <hr>
                <h4>@lang('tr.User')</h4>
                   <div class="row">
                    <div class="col-lg-6">
                         <p class="formP">@lang('tr.User') : {{ $tasks->user->name }}</p>
                    </div>
                    <div class="col-lg-6">
                     <p class="formP">@lang('tr.Department') : {{ $tasks->departmentName($tasks->department_id)->name }}</p>
                    </div>
                </div>

                <hr>
                <h4>@lang('tr.Customer')</h4>
                <div class="row">
                    <div class="col-lg-4">
                         <p class="formP">@lang('tr.Customer') : {{ $tasks->customer->name }}</p>
                    </div>
                    <div class="col-lg-4">
                     <p class="formP">@lang('tr.Mobile') : {{ $tasks->customer->mobile }}</p>
                    </div>
                    <div class="col-lg-4">
                     <p class="formP">@lang('tr.Email') : {{ $tasks->customer->email }}</p>
                    </div>
                </div>
                
                <hr>

                <h4>@lang('tr.Orders')</h4>
                <div class="row">
                    <div class="col-lg-2">
                         <p class="formP">@lang('tr.Order') : {{ $tasks->order->order_code }}</p>
                    </div>
                    <div class="col-lg-2">
                     <p class="formP">@lang('tr.Catalog') : {{ $tasks->order->catalogName($tasks->catalog_id)->name }}</p>
                    </div>
                    <div class="col-lg-2">
                     <p class="formP">@lang('tr.Day') : {{ $tasks->order->order_day }}</p>
                    </div>
                    <div class="col-lg-2">
                        <p class="formP">@lang('tr.From') : {{ $tasks->order->order_from }}</p>
                    </div>
                    <div class="col-lg-2">
                        <p class="formP">@lang('tr.To') : {{ $tasks->order->order_to }}</p>
                    </div>
                    <div class="col-lg-2">
                        <p class="formP">@lang('tr.Total') : {{ $tasks->order->total_price }}</p>
                    </div>
                </div>

                   
                </div>
                    
                    <hr>
                    <br>
                    <h6 style="text-align:center;">

                        @can('delete_tasks')
                        <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_tasks',$tasks->id) }}">@lang('tr.Delete')</a>
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

<script>
function PrintElem(elem)
{
    window.print();

    return true;
}
</script>

@endsection