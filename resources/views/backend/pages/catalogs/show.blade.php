@extends('backend.layouts.master')

@section('title',__('tr.Show Catalog'))

@section('catalogssactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Show Catalog')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    <hr>
                    <img src="{{ asset('catalogs/'.$catalog->catalog_img) }}" class="img-responsive img-thumbnail" style="width:200px;display:block;margin-left:auto;margin-right:auto;"><hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <p>@lang('tr.Catalog Name')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $catalog->name }}</p>
                        </div>

                        <div class="col-lg-12">
                            <p>@lang('tr.Catalog Descriptions')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $catalog->desc }}</p>
                        </div>
                        
                        <div class="col-lg-12">
                            <p>@lang('tr.Category')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $catalog->categoryName($catalog->categories_id)->name }}</p>
                        </div>

                        <div class="col-lg-12">
                            <p>@lang('tr.Price')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $catalog->price.' '.$system_currency }}</p>
                        </div>
                        
                    </div>
                    
                    <hr>
                    <br>
                    <h6 style="text-align:center;">
                        @can('edit_catalogs')
                        <a href="{{ route('edit_catalogs',$catalog->id) }}" style="background: purple; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.Edit')</a>&nbsp;
                        @endcan

                        @can('delete_catalogs')
                        <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_catalogs',$catalog->id) }}">@lang('tr.Delete')</a>
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