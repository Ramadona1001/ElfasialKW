@extends('frontend.layouts.master')

@section('title',__('tr.Cart'))

@section('cartsactive','current')

@section('stylesheet')

@endsection

@section('content')

@include('frontend.components.breadcrumb')

<!-- - - - - - - - - - - - - - Content - - - - - - - - - - - - - - - - -->

<div id="content" class="page-content-wrap">

    <div class="container wide">
      
      <div class="content-element8">
        
        <div class="shop-cart-form table-type-1 responsive-table">
          @if($cart)
          @php($total = 0)
          <table>
            <thead>
              <tr>
                <th>@lang('tr.Item')</th>
                <th>@lang('tr.Quantity')</th>
                <th>@lang('tr.Price')</th>
                <th>@lang('tr.Total')</th>
                <th>@lang('tr.Action')</th>
              </tr>
            </thead>
            <form action="{{ route('frontend_checkout_cart') }}" method="post">
              @csrf
              {{-- {{dd($cart->items)}} --}}
            @foreach ($cart->items as $product)
                @if($product['type'] != 'package')
                <tr>
                    @php($maxQty = \App\Cart::getMaxQty($product['id']))
                    <td>{{ $product['title'] }}</td>
                    <input type="hidden" name="type" value="items">
                    <td><input type="number" name="quantity[]" class="form-control currentQty" onKeyDown="return false" value="{{ $product['quantity'] }}" min="1" max="{{ $maxQty }}" step="1" style="text-align: center; font-weight: bold; color: #f05f79;" required></td>
                    <td><span class="currentPrice">{{ $product['price'] }}</span>&nbsp;{{ $system_currency }}</td>
                    <td><span class="totalPrice">{{ $product['quantity'] * $product['price'] }}</span>&nbsp;{{ $system_currency }}</td>
                    @php($total = $total + ($product['quantity'] * $product['price']))
                    <td><a href="{{ route('frontend_remove_cart_item',$product['id']) }}" onclick="return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a></td>
                    <input type="hidden" name="ids[]" value="{{ $product['id'] }}">
                    <input type="hidden" name="title[]" value="{{ $product['title'] }}">
                    <input type="hidden" name="price[]" value="{{ $product['price'] }}">
                </tr>
                @else
                <tr>
                  <td>{{ $product['title'] }}</td>
                  <td>
                    <input type="hidden" name="type" value="packages">
                    <input type="hidden" name="quantity[]" value="{{$product['quantity']}}">  
                  {{ $product['quantity'] }}</td>
                  <td>{{ $product['price'] * $product['quantity'] }}&nbsp;{{ $system_currency }}</td>
                  <td>{{ $product['price'] * $product['quantity'] }}&nbsp;{{ $system_currency }}</td>
                  <td><a href="{{ route('frontend_remove_cart_item',$product['id']) }}" onclick="return confirm('Are You Sure ?')"><i class="fa fa-trash"></i></a></td>
                  <input type="hidden" name="ids[]" value="{{ $product['id'] }}">
                  <input type="hidden" name="title[]" value="{{ $product['title'] }}">
                  <input type="hidden" name="price[]" value="{{ $product['price'] }}">
              </tr>
                @endif
            @endforeach


            <tr>
                <td colspan="3">
                  
                </td>
                <td colspan="2">
                  <button type="submit" class="btn btn-success" @if(\Lang::getLocale() == 'en') {{ 'style=float:right' }} @else {{ 'style=float:left' }} @endif><i class="fa fa-money-bill"></i>&nbsp;@lang('tr.Checkout')</button>
                </td>
              </tr>
            </form>
           
          </table>
          @else
            <h1 style="text-align: center; padding: 20px; color: #f05f79;font-size:70px;"><i class="fas fa-exclamation-triangle"></i></h1>
            <h2 style="text-align: center; padding: 20px; color: #f05f79;">@lang('tr.There are no items')</h2>
          @endif
        </div>

      </div>

      

    </div>
    
  </div>

  <!-- - - - - - - - - - - - - end Content - - - - - - - - - - - - - - - -->

@endsection

@section('javascript')
<script>
$(document).ready(function(){

    $('.currentQty').change(function(){
      var current_price = $(this).closest("tr").find('.currentPrice').text();

      if($(this).val() > 0 || $(this).val() != ''){
        $(this).closest("tr").find('.totalPrice').text($(this).val() * current_price);
        $(this).closest("tr .totalPrice").text();
      }else{
        $(".totalPrice").text(current_price);
      }
    });

});
</script>
@endsection