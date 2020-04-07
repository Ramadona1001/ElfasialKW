@extends('backend.layouts.master')

@section('title',__('tr.All Catalogs'))

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
                        @lang('tr.All Catalogs')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @can('create_catalogs')
                    <a href="{{ route('create_catalogs') }}" class="btn btn-primary">@lang('tr.Create New Catalogs')</a>
                    @endcan
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">

                    <div class="row" style="padding-bottom:10px;">
                        @foreach ($catalogs as $catalog)
                        <div class="col-lg-3">
                            <div class="card">
                                <img class="card-img-top" src="{{ asset('uploads/catalogs/'.$catalog->catalog_img ) }}" style="width:100%;height:300px;">
                                <div class="card-body">
                                  <h5 class="card-title">{{ $catalog->name }}</h5>
                                  <p class="card-text">
                                      {{ substr($catalog->desc,0,100) }}
                                  </p>
                                  <hr>
                                    @can('create_catalogs')
                                    <a href="{{ route('create_items',$catalog->id) }}" class="pinkbutton">@lang('tr.Create New Items')</a>&nbsp;
                                    @endcan

                                    @can('show_catalogs')
                                    <a href="{{ route('show_catalogs',$catalog->id) }}" class="pinkbutton">@lang('tr.View')</a>&nbsp;
                                    @endcan

                                    @can('edit_catalogs')
                                    <a href="{{ route('edit_catalogs',$catalog->id) }}" class="pinkbutton">@lang('tr.Edit')</a>&nbsp;
                                    @endcan

                                    @can('delete_catalogs')
                                    <a onclick="return confirm('Are You Sure ?')" class="pinkbutton" href="{{ route('delete_catalogs',$catalog->id) }}">@lang('tr.Delete')</a>
                                    @endcan

                                </div>
                              </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <hr>
                    <div class="row" style="padding-bottom:10px;">
                        {{ $catalogs->links() }}
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

@endsection