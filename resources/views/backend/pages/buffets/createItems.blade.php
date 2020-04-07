@extends('backend.layouts.master')

@section('title',__('tr.Create New Buffets'))

@section('buffetssactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('backend/imageUpload/image-uploader.min.css') }}">
@endsection

@section('content')
@php($langName = \Lang::getLocale().'_name')

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Create New Buffets') - ({{ $categories->$langName }})
                    </h3>
                </div>
            </div>
            
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    
                    <form action="{{ route('store_items',$categories->id) }}" method="post" id="saveItems">
                        @csrf
                        <div class="kt-portlet__head-toolbar">
                            <button type="submit" class="btn btn-primary SaveBtn">@lang('tr.Save')</button>
                        </div>
                    
                    <hr>
                    
                    <div class="row">
                        @foreach ($itemInventory as $item)
                        <div class="col-lg-2">
                            <div class="card" style="border: 2px dashed #f05f7861; padding: 5px;">
                                <img class="card-img-top" src="{{ URL::to('/') }}/itemsinventories/{{$item->inventory_image }}" style="width:100%;height:200px;">
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
                    <button type="submit" class="btn btn-primary SaveBtn">@lang('tr.Save')</button>
                </form>

                    <br>

                    
                    
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