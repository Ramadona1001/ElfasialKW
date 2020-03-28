@extends('backend.layouts.master')

@section('title',__('tr.Create New Customer'))

@section('customersactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Add New Customer')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('store_customers') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="name">@lang('tr.Name')</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="@lang('tr.Enter Customer Name')" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="email">@lang('tr.Email')</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="@lang('tr.Enter Customer Email')" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="mobile">@lang('tr.Mobile')</label>
                                <input type="text" onkeypress='validate(event)' minlength="11" maxlength="11" name="mobile" id="mobile" class="form-control" placeholder="@lang('tr.Enter Customer Mobile')" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="password">@lang('tr.Password')</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="•••••••••" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="password_confirmation">@lang('tr.Confirm Password')</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="•••••••••" required>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="container1" style="width: 100%; padding: 10px;">
                            <button class="add_form_field btn btn-primary">@lang("tr.Add Files") &nbsp; <span style="font-size:16px; font-weight:bold;">+ </span></button><br>
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
    $(document).ready(function() {
        var max_fields      = 100;
        var wrapper         = $(".container1"); 
        var add_button      = $(".add_form_field"); 
        var skillHtml       = '';
        var x = 1; 
        $(add_button).click(function(e){ 
            e.preventDefault();
            if(x < max_fields){ 
                x++;
                skillHtml += '<div style="border: 1px solid #e4e4e4; padding: 15px;margin-top:10px;">';
                skillHtml += '<div class="row">';
                skillHtml += '<div class="col-lg-6"><div class="form-group"><label for="file_name">@lang("tr.File Name")</label><input type="text" name="file_name[]" id="file_name" class="form-control" placeholder="@lang("tr.File Name")" required></div></div>';
                skillHtml += '<div class="col-lg-6"><div class="form-group"><label for="file">@lang("tr.File")</label><input type="file" name="file_path[]" accept=".png,.jpg,.jpeg,.pdf,.doc,.docx" id="file" class="form-control" required></div></div>';
                skillHtml += '</div>';


                skillHtml += '<a href="#" class="delete btn btn-danger">@lang("tr.Delete")</a></div>'; //add input box


                $(wrapper).append(skillHtml);

                skillHtml = '';
                $('.save_btn').html('<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; @lang("tr.Save")</button>');
            }
            else
            {
            alert('You Reached the limits')
            }
        });
        
        $(wrapper).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
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