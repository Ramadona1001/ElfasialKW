@extends('backend.layouts.master')

@section('itemsactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Show Item'))
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Show Item')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    <hr>
                    <img src="{{ asset('catalogs/items/'.$item->item_img) }}" class="img-responsive img-thumbnail" style="width:200px;display:block;margin-left:auto;margin-right:auto;"><hr>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>@lang('tr.Name')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $item->name }}</p>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p>@lang('tr.Descriptions')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $item->desc }}</p>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p>@lang('tr.Price')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $item->price }}</p>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p>@lang('tr.Catalog')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $item->catalog($item->cataglog_id)->name }}</p>
                        </div>
                        
                    </div>

                    <hr>
                    <br>
                    <h6 style="text-align:center;">
                        @can('edit_items')
                        <a href="{{ route('edit_items',$item->id) }}" style="background: purple; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.Edit')</a>&nbsp;
                        @endcan

                        @can('delete_items')
                        <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_items',$item->id) }}">@lang('tr.Delete')</a>
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