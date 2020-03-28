@extends('frontend.layouts.master')

@section('title',__('tr.Checkout'))

@section('cartsactive','current')

@section('stylesheet')
<script src="https://js.stripe.com/v3/"></script>

<style>
  input[type="text"],input[type="number"],input[type="date"],input[type="time"],input[type="email"]{
    border: 1px solid #f05f79;
    margin-bottom: 20px;
    color: black;
    padding: 10px;
  }
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
</style>
@endsection

@section('content')

@include('frontend.components.breadcrumb')

<div id="content" class="page-content-wrap">
    <div class="row" style="display: initial;">
        <form action="{{ route('frontend_charge_cart') }}" method="post" id="payment-form">
            @csrf
            <input type="hidden" name="amount" value="{{ $total_price }}">
            <input type="hidden" name="descriptions" value="{{ $orders }}">

            <div class="col-lg-2"></div>
            <div class="col-lg-8" style="display:block;margin-left:auto;margin-right:auto;">
            <h2 style="color: #262626;text-align:center;">@lang('tr.Make New Order')</h2>
            <p style="background: #eeeeee; height: 6px; width: 100px; display: block; margin-left: auto; margin-right: auto;"></p>

                         {{-- <input type="hidden" name="customer_id" value="{{ $customers->id }}"> --}}
                          
                          <div class="row">
                            

                            <div class="col-lg-6">
                              <div class="form-group">
                                <input type="hidden" value="no_company" name="company" id="company" class="form-control" required>
                                <label for="address" style="font-weight: bold; color: #f05f79;">@lang('tr.Address')</label>
                                <input type="text" name="address" id="address" placeholder="@lang('tr.Address')" class="form-control" required>
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group">
                                  <label for="no_attendance" style="font-weight: bold; color: #f05f79;">@lang('tr.No. Attendance')</label>
                                  <input type="number" value="0" min="0" step="1" name="no_attendance" id="no_attendance" class="form-control price" placeholder="@lang('tr.No. Attendance')">
                              </div>
                            </div>

                          </div>

                         
                          <br>

                          <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="order_day" style="font-weight: bold; color: #f05f79;">@lang('tr.Day')</label>
                                    <input type="date" name="order_day" id="order_day" class="form-control price" placeholder="@lang('tr.Date')" min="{{ date("Y-m-d") }}"  value="{{ date("Y-m-d") }}" required>
                                </div>
                            </div>
    
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="order_from" style="font-weight: bold; color: #f05f79;">@lang('tr.From')</label>
                                    <input type="time" name="order_from" id="order_from"  class="form-control price" placeholder="@lang('tr.From')" required>
                                </div>
                            </div>
    
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="order_to" style="font-weight: bold; color: #f05f79;">@lang('tr.To')</label>
                                    <input type="time" name="order_to" id="order_to" class="form-control price" placeholder="@lang('tr.To')" readonly required>
                                </div>
                            </div>
    
                        </div>

                        <br>

                        <div class="row">
                        
                          <div class="col-lg-10">
                            <label style="font-weight: bold; color: #f05f79;">@lang('tr.Followers')</label>
                          </div>
  
                          <div class="col-lg-2">
                              @php($lang = \App::getLocale())
                              <button class="add_form_field " style="background: transparent; border: 0;"><i class="fa fa-plus-circle" title="@lang('tr.Add Followers')" style="font-size: 20px; color: #f05f79;"></i></button><br>
                          </div>
                          <div class="container1" style="width: 100%; padding: 10px;">
                              
                          </div>
  
                      </div>

                      <hr>
                        
                

            </div> 
    </div>
    
    <div class="row">
        <div class="container wide">
            
                <div class="form-row">
                    <label for="card-element" style="margin-bottom:20px;">
                        <h2 style="color: #262626;text-align:center;">@lang('tr.Checkout')</h2>
                        <p style="background: #eeeeee; height: 6px; width: 100px; display: block; margin-left: auto; margin-right: auto;"></p>
                    </label>
                    <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                    </div>
    
                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                    </div>
                    <br><hr><br>
                    <button class="btn btn-success" style="float:right;">@lang('tr.Submit Payment')</button>
                    <h4 style="float: left;font-family:tahoma">@lang('Total'): {{ $total_price }}&nbsp;<span style="font-family:tahoma">{{ $system_currency }}</span></h4>
            </form>
        </div>
    </div>
</div>

@endsection

@section('javascript')

<script>
$('#order_from').on("input",function(){
        if($(this).val() != ''){
           var times = $(this).val().split(':');
            
            $('#order_to').removeAttr('readonly');
            $('#order_to').attr('min',times[0]+":"+times[1]+":00");
            $('#order_to').val(times[0]+":"+times[1]+":00");
        }else{
            $('#order_to').attr('readonly');
        }
    });
    

    $('#order_to').on("input",function(){
        if($(this).val() != ''){
            var timesTo = $(this).val().split(':');
            var timesFrom = $('#order_from').val().split(':');
           if(timesTo[0] < timesFrom[0] || timesTo[1] < timesFrom[1]){
                    $(this).val($('#order_from').val());
           }
        }else{
            $(this).val($('#order_from').val());
        }
    });
$('#order_day').on("input",function(){
        if($(this).val() != ''){
            var d = '{{ date("Y-m-d") }}';
           if($(this).val() < d){
                $(this).val(d);
           }
        }
    });
</script>

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
                skillHtml += '<div class="col-lg-4"><div class="form-group"><label for="follow_name">@lang("tr.Follower Name")</label><input type="text" name="follow_name[]" id="follow_name" class="form-control" placeholder="@lang("tr.Follower Name")" required></div></div>';
                skillHtml += '<div class="col-lg-4"><div class="form-group"><label for="follow_mobile">@lang("tr.Follower Mobile")</label><input type="text" name="follow_mobile[]" id="follow_mobile" class="form-control" placeholder="@lang("tr.Follower Mobile")" required></div></div>';
                skillHtml += '<div class="col-lg-4"><div class="form-group"><label for="follow_email">@lang("tr.Follower Email")</label><input type="email" name="follow_email[]" id="follow_email" class="form-control" placeholder="@lang("tr.Follower Email")" required></div></div>';
                skillHtml += '</div><br>';


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


<script>
// Create a Stripe client.
var stripe = Stripe('pk_test_p0NFvvWsGmjQJ999Fp7v5drG00SCTuGkrG');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection