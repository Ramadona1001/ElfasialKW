@extends('frontend.layouts.master')

@section('title',__('tr.Mobile'))

@section('cartsactive','current')

@section('stylesheet')

@endsection

@section('content')

@include('frontend.components.breadcrumb')

<!-- - - - - - - - - - - - - - Content - - - - - - - - - - - - - - - - -->

<div id="content" class="page-content-wrap">

    <div class="container wide">
      
      <div class="content-element8">
        
            <div class="row">

                <div class="col-lg-3"></div>
                
                <div class="col-lg-6">
                    <h3>@lang('tr.Mobile')</h3>
                    <form action="{{ route('frontend_send_mobile_post') }}" method="post">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $total_price }}">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="descriptions" value="{{ $orders }}">
                        <input type="text" name="mobile" class="form-control" onkeypress='validate(event)' required id="" style="border: 1px solid #f05f79; margin-bottom: 20px; color: black; padding: 10px;">
                        <button type="submit" class="btn btn-primary">@lang('tr.Send Code')</button>
                    </form>
                </div>

            </div>

      </div>

      

    </div>
    
  </div>

  <!-- - - - - - - - - - - - - end Content - - - - - - - - - - - - - - - -->

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