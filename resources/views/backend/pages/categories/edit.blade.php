@extends('backend.layouts.master')

@section('title',__('tr.Update Category'))

@section('categoriesactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Update Category')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')

                    <img src="{{ asset('categories/'.$category->cat_image) }}" class="img-responsive img-thumbnail" style="width:200px;display:block;margin-left:auto;margin-right:auto;"><hr>
                   
                <form action="{{ route('update_category',$category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="en_name">@lang('tr.English Name')</label>
                                <input type="text" name="en_name" id="name" class="form-control" value="{{ $category->en_name }}" placeholder="@lang('tr.Enter English Name')" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ar_name">@lang('tr.Arabic Name')</label>
                                <input type="text" name="ar_name" id="ar_name" class="form-control" value="{{ $category->ar_name }}" placeholder="@lang('tr.Enter Arabic Name')" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="en_desc">@lang('tr.English Descriptions')</label>
                                <textarea name="en_desc" id="en_desc" cols="30" rows="10" class="form-control" placeholder="@lang('tr.Enter English Descriptions')" required>{{ $category->en_desc }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ar_desc">@lang('tr.Arabic Descriptions')</label>
                                <textarea name="ar_desc" id="ar_desc" cols="30" rows="10" class="form-control" placeholder="@lang('tr.Enter Arabic Descriptions')" required>{{ $category->ar_desc }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="cat_image">@lang('tr.Category Image')</label>
                                <input type="file" name="cat_image" id="cat_image" class="form-control">
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

@endsection