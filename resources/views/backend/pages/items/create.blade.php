@extends('backend.layouts.master')

@section('itemsactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Create New Items'))
    
@section('stylesheet')
    
@endsection

@section('content')


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
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('store_items') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="en_name">@lang('tr.English Name')</label>
                                <input type="text" name="en_name" id="name" class="form-control" placeholder="@lang('tr.Enter English Name')" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ar_name">@lang('tr.Arabic Name')</label>
                                <input type="text" name="ar_name" id="ar_name" class="form-control" placeholder="@lang('tr.Enter Arabic Name')" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="en_desc">@lang('tr.English Descriptions')</label>
                                <textarea name="en_desc" id="en_desc" cols="30" rows="10" class="form-control" placeholder="@lang('tr.Enter English Descriptions')" required></textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ar_desc">@lang('tr.Arabic Descriptions')</label>
                                <textarea name="ar_desc" id="ar_desc" cols="30" rows="10" class="form-control" placeholder="@lang('tr.Enter Arabic Descriptions')" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="price">@lang('tr.Price')</label>
                                <input type="number" name="price" id="price" min="1" step="1" onkeypress='validate(event)' minlength="5" maxlength="6" class="form-control price" placeholder="@lang('tr.Price')" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="catalog_id">@lang('tr.Catalog')</label>
                                <select name="catalog_id" id="catalog_id" required class="form-control">
                                    <option value="">@lang('tr.Select Catalog')</option>
                                    @foreach ($catalogs as $catalog)
                                    <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="item_img">@lang('tr.Item Image')</label>
                                <input type="file" name="item_img" id="item_img" class="form-control" required>
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
<script>
    function validate(evt) {
      var theEvent = evt || window.event;
    
      // Handle paste
      if (theEvent.type === 'paste') {
          key = event.clipboardData.getData('text/plain');
      } else {
      // Handle key press
          var key = theEvent.keyCode || theEvent.which;
          key = String.fromCharCode(key);
      }
      var regex = /[0-9]|\./;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }
    </script>
@endsection