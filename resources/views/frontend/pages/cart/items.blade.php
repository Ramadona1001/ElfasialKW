<div class="row">
    @foreach (Cart::content() as $item)
    @if ($item->options[0] == 'catalog')
        @include('frontend.pages.cart.components.catalog')
    @endif

    @if ($item->options[0] == 'buffet')
        @include('frontend.pages.cart.components.buffet')
    @endif
    
    @if ($item->options[0] == 'package')
        @include('frontend.pages.cart.components.package')
    @endif
    @endforeach
</div>

<br>
<br>
<hr>

<div class="row cart-buttons">
    <div class="col-12">
        <a href="{{ route('cart_checkout') }}" class="btn btn-normal ml-3">@lang('tr.Check Out')</a>
        <a href="{{ route('cart_destroy') }}" class="btn btn-normal ml-3">@lang('tr.Empty Cart')</a>
    </div>
</div>