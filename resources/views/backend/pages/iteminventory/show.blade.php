@extends('backend.layouts.master')

@section('iteminventorysactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Item Inventory'))
    
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
                   <div class="row">
                        <div class="col-lg-12">
                            <img src="{{ asset('uploads/itemsinventories/'.$item->inventory_image) }}" class="img-responsive img-thumbnail" style="width:200px;display:block;margin-left:auto;margin-right:auto;" alt="">
                        </div>
                   </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <p>@lang('tr.English Name')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $item->en_name }}</p>
                        </div>
                        <div class="col-lg-6">
                            <p>@lang('tr.Arabic Name')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $item->ar_name }}</p>
                        </div>
                        
                        
                    </div>

                    <div class="row">
                       

                        <div class="col-lg-12">
                            <p>@lang('tr.Price')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $item->price }}</p>
                        </div>
                       
                    </div>



                    <div class="row">
                        <div class="col-lg-6">
                            <p>@lang('tr.Arabic Descriptions')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $item->ar_desc }}</p>
                        </div>

                        <div class="col-lg-6">
                            <p>@lang('tr.English Descriptions')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $item->en_desc }}</p>
                        </div>
                        
                    </div>

                   
                    <hr>
                    <br>
                    <h6 style="text-align:center;">
                        @can('edit_inventory')
                        <a href="{{ route('edit_iteminventory',$item->id) }}" style="background: purple; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.Edit')</a>&nbsp;
                        @endcan

                        @can('delete_iteminventory')
                        <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_inventory',$item->id) }}">@lang('tr.Delete')</a>
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