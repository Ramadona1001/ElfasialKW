@extends('backend.layouts.master')

@section('title',__('tr.Update User'))

@section('usersactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Update User')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('update_users',$user->id) }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">@lang('tr.Name')</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" placeholder="@lang('tr.Enter User Name')" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="email">@lang('tr.Email')</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control" placeholder="@lang('tr.Enter User Email')" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="mobile">@lang('tr.Mobile')</label>
                                <input type="text" name="mobile" id="mobile" value="{{ $user->mobile }}" onkeypress='validate(event)' minlength="11" maxlength="11" class="form-control" placeholder="@lang('tr.Mobile')" required>
                            </div>
                        </div>
                    </div>

                    

                    <hr>
                    <h4 style="color:tomato;">@lang('tr.Write Password If You Want to Change It')</h4>
                    <hr>
                    <div class="form-group">
                        <label for="password">@lang('tr.Password')</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="•••••••••">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">@lang('tr.Confirm Password')</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="•••••••••">
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