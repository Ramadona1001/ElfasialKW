@extends('backend.layouts.master')

@section('title',__('tr.Create New Buffets'))

@section('buffetssactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="{{ asset('backend/imageUpload/image-uploader.min.css') }}">
<style>
    .bootstrap-select{
        width:100% !important;
    }
</style>
@endsection

@section('content')

@php($langName = \Lang::getLocale().'_name')
<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Create New Buffets')
                    </h3>
                </div>
            </div>
            
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('store_buffets') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="row">
                                @foreach ($itemInventory as $item)
                                <div class="col-lg-2">
                                    <div class="card" style="border: 2px dashed #f05f7861; padding: 5px;">
                                        <img class="card-img-top" src="{{ asset('uploads/itemsinventories/'.$item->inventory_image) }}" style="width:100%;height:200px;">
                                        <div class="card-body">
                                          <h5 class="card-title">{{ $item->$langName }}</h5>
                                          <p class="card-text">
                                              @lang('tr.Price'): {{ $item->price }} <hr>
                                              <input type="checkbox" name="iteminventory[]" value="{{$item->id}}" id="" style="height: 30px; width: 30px; display: block; margin-left: auto; margin-right: auto;">
                                          </p>
                                          
                                            
        
                                        </div>
                                      </div>
                                </div>
                                @endforeach
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="no_members">@lang('tr.No Members')</label>
                                        <input type="number" min="1" value="1" step="1" name="no_members" id="no_members" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="price">@lang('tr.Price')</label>
                                        <input type="text" name="price" id="price" class="form-control" required>
                                    </div>
                                </div>

                               
                            </div>

                            
        
                            {{-- <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="buffets_image">@lang('tr.Image')</label>
                                        <div class="input-images"></div>
                                        <input type="file" name="buffets_image" id="buffets_image" class="form-control" required>
                                    </div>
                                </div>
                            </div> --}}
        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="categories_id">@lang('tr.Category')</label>
                                        <select name="categories_id" id="categories_id" class="form-control">
                                            <option value="">@lang('tr.Select Category')</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>



<script>
$(document).ready(function(){

    $('.selectpicker').selectpicker();


    $('.input-images').imageUploader({
        imagesInputName: 'buffets_image',
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