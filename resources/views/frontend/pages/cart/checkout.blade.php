@extends('frontend.layouts.master')

@section('title',__('tr.Checkout'))

@section('content')

@include('frontend.components.breadcrumb')
@section('stylesheet')
    <style>
 
.StripeElement {
  box-sizing: border-box;
  background: white;

  padding: 10px 12px;

  width: 100%;
  height: 45px;
  border: 1px solid #ddd;
  
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

#card-errors{
    color: #fa755a;
}
    </style>
@endsection
<div id="content" class="page-content-wrap">

  <div class="container wide">

    <div class="col-lg-12 col-md-12">

                    <div class="row">
                        <div class="col-lg-6 col-sm-12 col-xs-12" style="border: 2px dashed #f05f79; padding: 10px;">
                            <div class="checkout-title">
                                <h3>@lang('tr.Billing Details')</h3></div>
                                <hr>
                            <div class="theme-form">
                                <form action="{{ route('cart_checkout_post') }}" method="post" id="payment-form">
                                    @csrf
                                <div class="row check-out ">

                                    

                                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                        <label>@lang('tr.Mobile')</label>
                                        <input type="text" name="mobile" style="color:black;width: 100%; padding: 0 22px; height: 45px; border: 1px solid #ddd;" value="" placeholder="Mobile" required>
                                    </div>
                                    
                                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                        <label class="field-label">@lang('tr.Address')</label>
                                        <input type="text" name="address" style="color:black;width: 100%; padding: 0 22px; height: 45px; border: 1px solid #ddd;" value="" placeholder="Street address" required>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                      <label class="field-label">@lang('tr.Day / Time')</label>
                                      <input type="datetime-local" name="order_day"  style="color:black;width: 100%; padding: 0 22px; height: 45px; border: 1px solid #ddd;" value="" placeholder="Street address" required>
                                  </div>

                                    
                                    <div class="form-group col-md-10 col-sm-12 col-xs-12">
                                      <label style="font-weight: bold; color: #f05f79;">@lang('tr.Followers')</label>
                                      <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                        @php($lang = \App::getLocale())
                                        <button class="add_form_field " style="background: transparent; border: 0;"><i class="fa fa-plus-circle" title="@lang('tr.Add Followers')" style="font-size: 20px; color: #f05f79;"></i></button><br>
                                    </div>
                                    <div class="container1" style="width: 656px; padding: 10px;">
                                        
                                    </div>
                                    </div>
            
                                    
                                    
                                    
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="">@lang('Credit Or Debit Card')</label>
                                        
                                            <div class="form-row">

                                              <div id="card-element">
                                                <!-- A Stripe Element will be inserted here. -->
                                              </div>
                                          
                                              <!-- Used to display form errors. -->
                                              <div id="card-errors" role="alert"></div>
                                            </div>
                                            <br>
                                            <button class="btn-normal btn">@lang('tr.Submit Payment')</button>
                                          </form>
                                          
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    
                        <div class="col-lg-1"></div>
                    
                    
                        <div class="col-lg-5 col-sm-12 col-xs-12" style="border: 2px dashed #f05f79; padding: 10px;">
                            <div class="checkout-details theme-form  section-big-mt-space">
                                <div class="order-box">
                                    <div class="title-box">
                                        <h3>@lang('tr.Order') @lang('tr.Total')</h3>
                                    </div>
                                    <hr>
                                    <ul class="qty">
                                        @foreach (Cart::content() as $item)
                                        <li style="border: 1px solid #00000069; padding: 5px; box-shadow: 1px 1px 1px 1px #00000029;margin-bottom:10px;">{{ $item->name }} × <strong style="color:#b22827;">{{ $item->qty }}</strong> ({{ $item->options[0] }}) <span> : {{ $system_currency }} {{ $item->price }}</span></li>
                                        @endforeach
                                    </ul>
                                    
                                    <hr>
                                    <ul class="total">
                                        <li>@lang('tr.Total') <span class="count">: {{ $system_currency }} {{ Cart::subtotal() }}</span></li>
                                    </ul>
                                </div>
                                
                            </div>
                        </div>
                    </div>
</div>
</div>
</div>



@endsection

@section('javascript')
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create a Stripe client.
var stripe = Stripe('pk_test_IxWUgoTiGn7VRUlL2mSr4ql300FaCJgyh7');

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
              skillHtml += '<div class="col-lg-4"><div class="form-group"><label for="follow_name">@lang("tr.Follower Name")</label><input style="color:black;width: 100%; padding: 0 22px; height: 45px; border: 1px solid #ddd;" type="text" name="follow_name[]" id="follow_name" class="form-control" placeholder="@lang("tr.Follower Name")" required></div></div>';
              skillHtml += '<div class="col-lg-4"><div class="form-group"><label for="follow_mobile">@lang("tr.Follower Mobile")</label><input style="color:black;width: 100%; padding: 0 22px; height: 45px; border: 1px solid #ddd;" type="text" name="follow_mobile[]" id="follow_mobile" class="form-control" placeholder="@lang("tr.Follower Mobile")" required></div></div>';
              skillHtml += '<div class="col-lg-4"><div class="form-group"><label for="follow_email">@lang("tr.Follower Email")</label><input style="color:black;width: 100%; padding: 0 22px; height: 45px; border: 1px solid #ddd;" type="email" name="follow_email[]" id="follow_email" class="form-control" placeholder="@lang("tr.Follower Email")" required></div></div>';
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

@endsection