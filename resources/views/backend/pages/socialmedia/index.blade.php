@extends('backend.layouts.master')

@section('soicalsactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Social Media'))


@section('stylesheet')

@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Social Media')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    <form action="{{ route('social_media_update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">@lang('tr.Facebook')</label>
                            <input type="text" value="@if(isset($SoicalMedia->facebook)) {{ $SoicalMedia->facebook }} @endif" name="facebook" class="form-control" id="facebook">
                        </div>




                        <div class="form-group">
                            <label for="title">@lang('tr.Twitter')</label>
                            <input type="text" value="@if(isset($SoicalMedia->twitter)) {{ $SoicalMedia->twitter }} @endif" name="twitter" class="form-control" id="twitter">
                        </div>




                        <div class="form-group">
                            <label for="title">@lang('tr.instagram')</label>
                            <input type="text" value="@if(isset($SoicalMedia->instagram)) {{ $SoicalMedia->instagram }} @endif" name="instagram" class="form-control" id="instagram">
                        </div>






                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> &nbsp;@lang('tr.save')
                        </button>
                    </form>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
    


@endsection
