@extends('backend.layouts.master')

@section('title',__('tr.Update Customer Choices'))

@section('fromchoicesactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Update Customer Choices')
                    </h3>
                </div>
            </div>
            
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('update_fromchoices',$fromchoice->id) }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="en_name">@lang('tr.English Name')</label>
                                        <input type="text" value="{{ $fromchoice->en_name }}" placeholder="@lang('tr.English Name')" name="en_name" id="en_name" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="ar_name">@lang('tr.Arabic Name')</label>
                                        <input type="text" value="{{ $fromchoice->ar_name }}" placeholder="@lang('tr.English Name')" name="ar_name" id="ar_name" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="en_desc">@lang('tr.English Descriptions')</label>
                                        <div class="kt-tinymce">
                                            <div class="kt-tinymce">
												<textarea id="kt-tinymce-4" name="en_desc" class="tox-target">{{ $fromchoice->en_desc }}</textarea>
											</div>
                                        </div>
                                    </div>
                                </div>
        
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="ar_desc">@lang('tr.Arabic Descriptions')</label>
                                        <div class="kt-tinymce">
                                            <div class="kt-tinymce">
												<textarea id="kt-tinymce-3" name="ar_desc" class="tox-target">{{ $fromchoice->ar_desc }}</textarea>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="categories_id">@lang('tr.Image')</label>
                                        <input type="file" name="categories_id" id="categories_id" class="form-control">
                                    </div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="categories_id">@lang('tr.Category')</label>
                                        <select name="categories_id" id="categories_id" class="form-control">
                                            <option value="">@lang('tr.Select Category')</option>
                                            @foreach ($categories as $category)
                                                @if($fromchoice->categories_id == $category->id)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="inventory_id">@lang('tr.Items')</label>
                                <select name="inventory_id" id="inventory_id" class="form-control">
                                    <option value="">@lang('tr.Select Items')</option>
                                    @foreach ($inventory as $item)
                                        @if($fromchoice->inventory_id == $item->id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                        @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
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
<script src="{{ asset('backend/assets/plugins/custom/tinymce/tinymce.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/assets/js/pages/crud/forms/editors/tinymce.js')}}" type="text/javascript"></script>

<script>
    
var KTTinymce = function () {    
    // Private functions
    var demos = function () {
        
       
        tinymce.init({
            selector: '#kt-tinymce-3',
            menubar: false,
            toolbar: ['styleselect fontselect fontsizeselect',
                'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
                'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'], 
            plugins : 'advlist autolink link image lists charmap print preview code'
        });
        
        tinymce.init({
            selector: '#kt-tinymce-4',
            menubar: false,
            toolbar: ['styleselect fontselect fontsizeselect',
                'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
                'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'], 
            plugins : 'advlist autolink link image lists charmap print preview code'
        });
        
        
    }

    return {
        // public functions
        init: function() {
            demos(); 
        }
    };
}();

// Initialization
jQuery(document).ready(function() {
    KTTinymce.init();
});
</script>


<script>
$(document).ready(function(){
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