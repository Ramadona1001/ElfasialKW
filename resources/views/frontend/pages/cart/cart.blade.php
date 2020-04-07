@extends('frontend.layouts.master')

@section('title',__('tr.Cart'))

@section('content')

@include('frontend.components.breadcrumb')

@if($errors->any())
    @foreach($errors->all() as $error)
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endforeach
@endif


<div id="content" class="page-content-wrap">
    <div class="content-element4 ">

        <div class="align-center marginBottom">
            @if(\Cart::count() > 0)
          <h2 class="title-large style-2">{{ \Cart::count()}} @lang('tr.Quantity In Your Cart')</h2>
          <p style="font-size: 27px; color: #f05f79; font-weight: bold;">@lang('tr.Total'): {{ Cart::subtotal().' '.$system_currency }}</p>
          @else
          <h2 class="title-large style-2">@lang('tr.No Product(s) In Your Cart')</h2>
          @endif
        </div>

      </div>
      
      <div class="content-element8" style="padding:15px;">

                    @if(\Cart::count() > 0)
                        @include('frontend.pages.cart.items')
                    @endif

                
    </div>
</div>





@endsection