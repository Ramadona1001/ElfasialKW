@extends('backend.layouts.master')

@section('settingsactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.settings'))


@section('stylesheet')

@endsection

@section('content')

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.settings')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">

                    <div class="row">
                        <div class="col-lg-12">
                            @if(isset($setting->title))
                                <img src="{{ asset('/logo/'.$setting->logo) }}" class="img-responsive " style="display: block;margin-left: auto;margin-right: auto;width: 160px;height: 147px;" alt="">
                            @endif
                        </div>
                    </div>

                   
                    <form action="{{ route('settings_update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">@lang('tr.Title')</label>
                            <input type="text" value="@if(isset($setting->title)) {{ $setting->title }} @endif" name="title" class="form-control" id="title">
                        </div>



                        <div class="form-group">
                            <label for="logo">@lang('tr.Logo')</label>
                            <input type="file" name="logo" class="form-control" id="logo">
                        </div>


                        <div class="form-group">
                            <label for="email">@lang('tr.Email')</label>
                            <input type="email" value="@if(isset($setting->email)) {{ $setting->email }} @endif" name="email" class="form-control" id="email">
                        </div>

                        <div class="form-group">
                            <label for="phone_number">@lang('tr.Mobile')</label>
                            <input type="text" onkeypress='validate(event)' minlength="11" maxlength="11" value="@if(isset($setting->phone_number)) {{ $setting->phone_number }} @endif" name="phone_number" class="form-control" id="phone_number">
                        </div>

                        <div class="form-group">
                            <label for="currency">@lang('tr.Currency')</label>
                            <input type="text" value="@if(isset($setting->currency)) {{ $setting->currency }} @endif" name="currency" class="form-control" id="currency">
                        </div>



                        <div class="form-group">
                            <label for="descriptions">@lang('tr.Descriptions')</label>
                            <input type="description" value="@if(isset($setting->description)) {{ $setting->description }} @endif" name="description" class="form-control" id="description">
                        </div>


                        <div class="form-group">
                            <label for="descriptions">@lang('tr.English Terms and Conditions')</label>
                            <div class="kt-tinymce">
                                <div class="kt-tinymce">
                                    <textarea id="kt-tinymce-3" name="en_terms_conditions" class="tox-target">
                                    @if(isset($setting->en_terms_conditions)) {{ $setting->en_terms_conditions }} @endif
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descriptions">@lang('tr.Arabic Terms and Conditions')</label>
                            <div class="kt-tinymce">
                                <div class="kt-tinymce">
                                    <textarea id="kt-tinymce-4" name="ar_terms_conditions" class="tox-target">
                                    @if(isset($setting->ar_terms_conditions)) {{ $setting->ar_terms_conditions }} @endif
                                    </textarea>
                                </div>
                            </div>
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

