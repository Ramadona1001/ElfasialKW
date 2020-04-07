@extends('backend.layouts.master')

@section('title',__('tr.Create New Items'))

@section('packagesactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
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
                        @lang('tr.Create New Items') - ({{ $packages->name }})
                    </h3>
                </div>
            </div>
            
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('create_items_packages_post', $packages->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

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
                    <br>

                    <input type="submit" value="@lang('tr.Save')" class="btn btn-success">
                </form>
                <br>
                </div>
            </div>
        </div>
    </div>
</div>

    

@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('.example').DataTable({responsive:true});
    } );
</script>
@endsection