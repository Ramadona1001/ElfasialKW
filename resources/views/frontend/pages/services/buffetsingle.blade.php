@extends('frontend.layouts.master')

@section('title',__('tr.Our Services').' | '.__('tr.Buffets')))

@section('servicesactive','current')

@section('stylesheet')
    
@endsection

@section('content')
@php($langName = \Lang::getLocale().'_name')
@php($langDesc = \Lang::getLocale().'_desc')
@include('frontend.components.breadcrumb')

<div id="content" class="page-content-wrap">

  <div class="container wide">

    <div class="col-lg-12 col-md-12">

      <div class="content-element4 ">

        <div class="align-center marginBottom">
          <h2 class="title-large style-2">@lang('tr.Make your day is nice from start to end')</h2>
          <p>@lang('tr.We offer you everything you need for occasions')</p>
        </div>

      </div>

      <div class="products-holder">
        
        <div class="row">
          <div class="col-lg-4">
            <img style="width: 100%; border: 2px dashed #f05f7999;" src="{{ asset('uploads/itemsinventories/'.$buffet->iteminventory->inventory_image) }}" alt="" srcset="">
          </div>
          <div class="col-lg-8">
            <h4>{{ $buffet->iteminventory->$langName }}</h4>
            <hr>
            <p>{{ $buffet->iteminventory->$langDesc }}</p>
            <hr>
            <h5 style="font-family:tahoma;">@lang('tr.Price'): {{ $buffet->iteminventory->price.' '.$system_currency }}</h5>
            <h5 style="font-family:tahoma;">@lang('tr.No Members'): {{ $buffet->no_members }}</h5>
            <hr>
            <form action="{{ route('cart_store') }}" method="post">
              @csrf
              <input type="hidden" name="price" value="{{ $buffet->iteminventory->price }}">
              <input type="hidden" name="type" value="buffet">
              <input type="hidden" name="buffet_id" value="{{ $buffet->id }}">
              <input type="hidden" name="buffet_name" value="{{ $buffet->iteminventory->en_name.' | '.$buffet->iteminventory->ar_name }}">
              <input type="number" style="border: 2px dashed #f05f79; color: #f05f79; padding: 10px; width: 30%; font-weight: bold; text-align: center;" name="quantity" value="1" min="1" step="1" class="form-control" id="">
              <hr>
              <button type="submit" class="btn btn-primary">@lang('tr.Add To Cart')</button>
              </form>
          </div>
        </div>
        
        
        <!-- Product -->

      </div>

    </div>

  </div>

</div>

@endsection

@section('javascript')
    
@endsection