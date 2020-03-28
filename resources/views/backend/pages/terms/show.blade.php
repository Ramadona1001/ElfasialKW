@extends('backend.layouts.master')

@section('title',__('tr.Show Terms'))

@section('termsactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            
            
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1" style="padding:10px;">
                        <p>@lang('tr.English Name'): {{ $terms->en_name }}</p>
                        <p>@lang('tr.Arabic Name'): {{ $terms->ar_name }}</p>
                        <p>@lang('tr.Arabic Content'): {!! $terms->ar_desc !!}</p>
                        <p>@lang('tr.English Content'): {!! $terms->ar_desc !!}</p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')




@endsection