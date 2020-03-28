@extends('backend.layouts.master')

@section('profitsactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Profits'))
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Profits')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                
                <div class="row">

                    @foreach ($profits as $profit)
                    <div class="col-lg-3">
                        <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--height-fluid">
                            <div class="kt-portlet__head kt-portlet__space-x">
                                <div class="kt-portlet__head-label">
                                    <h3 class="kt-portlet__head-title kt-font-light">
                                        @lang('tr.Net Profit')
                                    </h3>
                                </div>
                                <div class="kt-portlet__head-toolbar">
                                    <p class="btn btn-outline-light btn-sm btn-bold">
                                        {{ \App\Order::getMonth($profit->month) }} , {{ $profit->year }}
                                    </p>
                                </div>
                            </div>
                            <div class="kt-portlet__body">
                                <div class="kt-widget27">
                                    <div class="kt-widget27__visual">
                                        <img src="{{ asset('backend/images/bg-4.jpg')}}" alt="">
                                        <h3 class="kt-widget27__title" style="text-shadow: 2px 2px 1px #db1430;"><span>{{ $profit->profit }}</span></h3>

                                        <div class="kt-widget27__btn"><p class="btn btn-pill btn-light btn-elevate btn-bold">@lang('tr.Profits')</p></div>
                                    </div>
                                    <div class="kt-widget27__container kt-portlet__space-x">
                                        <p style="font-size: 17px;font-weight: bold;">@lang('tr.Sale Total') : {{ $profit->price }}</p>
                                        <p style="font-size: 17px;font-weight: bold;">@lang('tr.Original Total') : {{ $profit->orignal_price }}</p>
                                        <p style="font-size: 17px;font-weight: bold;">@lang('tr.Profits') : {{ $profit->profit }}</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                  
                    
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@section('javascript')

@endsection