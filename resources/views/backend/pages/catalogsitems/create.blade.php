@extends('backend.layouts.master')

@section('catalogssactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Create New Items'))
    
@section('stylesheet')
    
@endsection

@section('content')
@php($langName = \Lang::getLocale().'_name')

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Add New Items')
                    </h3>
                </div>

                

                
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    
                    <form action="{{ route('store_items',$catalogs->id) }}" method="post" id="saveItems">
                        @csrf
                        <div class="kt-portlet__head-toolbar">
                            <button type="submit" class="btn btn-primary SaveBtn">@lang('tr.Save')</button>
                        </div>
                    
                    <hr>
                    
                    <div class="row">
                        @foreach ($itemInventory as $item)
                        <div class="col-lg-2">
                            <div class="card" style="border: 2px dashed #f05f7861; padding: 5px;">
                                <img class="card-img-top" src="{{ asset('uploads/itemsinventories/'.$item->inventory_image) }}" style="width:100%;height:200px;">
                                <div class="card-body">
                                  <h5 class="card-title">{{ $item->$langName }}</h5>
                                  <p class="card-text">
                                      @lang('tr.Price'): {{ $item->price }} <hr>
                                      @if (in_array($item->id,$items))
                                      <input type="checkbox" name="iteminventory[]" value="{{$item->id}}" checked id="" style="height: 30px; width: 30px; display: block; margin-left: auto; margin-right: auto;">
                                      @else
                                      <input type="checkbox" name="iteminventory[]" value="{{$item->id}}" id="" style="height: 30px; width: 30px; display: block; margin-left: auto; margin-right: auto;">
                                      @endif
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


    
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({ responsive:true});

        $('.SaveBtn').on('click',function(e){
            var checks = $('[name="iteminventory[]"]:checked').length;
            e.preventDefault();
            if (checks == 0) {
                alert('@lang("tr.Please Choose")');
            }else{
                $('#saveItems').submit();
            }

        });


    } );



</script>
@endsection