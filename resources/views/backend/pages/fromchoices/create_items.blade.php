@extends('backend.layouts.master')

@section('title',__('tr.Create New Customer Choices'))

@section('fromchoicesactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
<link rel="stylesheet" href="{{ asset('backend/imageUpload/image-uploader.min.css') }}">
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Create New Customer Choices')
                    </h3>
                </div>
            </div>
            
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('store_items_fromchoices') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="fromchoice_id" value="{{ $fromChoice->id }}">
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="en_name">@lang('tr.English Name')</label>
                                <input type="text" name="en_name" id="en_name" class="form-control" required>
                            </div>
    
                        </div>
    
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ar_name">@lang('tr.Arabic Name')</label>
                                <input type="text" name="ar_name" id="ar_name" class="form-control" required>
                            </div>
    
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-lg-12">

                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="en_desc">@lang('tr.English Descriptions')</label>
                                        <textarea id="en_desc" name="en_desc" class="form-control"></textarea>
                                    </div>
                                </div>
        
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ar_desc">@lang('tr.Arabic Descriptions')</label>
                                        <textarea id="ar_desc" name="ar_desc" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                           
        
                           
                        </div>

                        
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="price">@lang('tr.Price')</label>
                                <input type="number" name="price" id="price" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="buffets_image">@lang('tr.Image')</label>
                                <div class="input-images"></div>
                                {{-- <input type="file" name="buffets_image" id="buffets_image" class="form-control" required> --}}
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="form-group">
                        <button type="submit" id="submitBtn" class="btn btn-success">
                            <i class="fa fa-save"></i>&nbsp;@lang('tr.Save')
                        </button>
                    </div>
                
                    
                </div>
            </div>
        </div>
    </div>
</div>

    
</form>
@endsection

@section('javascript')
<script src="{{ asset('backend/imageUpload/image-uploader.min.js') }}"></script>
    
<script>
$(document).ready(function(){
    $('.input-images').imageUploader({
        imagesInputName: 'fromchoice_items_image',
        preloadedInputName: 'old',
        maxSize: 2 * 1024 * 1024,
        maxFiles: 10
    });

    $('#submitBtn').click(function(){
        if($('input[type=checkbox]:checked').length > 0){
            $('input[type=checkbox]').removeAttr('required');
        }
    });
});

$(document).ready(function(){
    $('#submitBtn').click(function(){
        if($('.inventoryCheck:checked').length > 0){
            $('.inventoryCheck').removeAttr('required');
        }
    });
});
</script>

@endsection