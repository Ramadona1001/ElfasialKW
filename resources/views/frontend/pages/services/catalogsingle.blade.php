@extends('frontend.layouts.master')

@section('title',__('tr.Our Services').' | '.__('tr.Catalog')))

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
            <img style="width: 100%; border: 2px dashed #f05f7999;" src="{{ asset('uploads/itemsinventories/'.$catalogsItem->iteminventory->inventory_image) }}" alt="" srcset="">
          </div>
          <div class="col-lg-8">
            <h4>{{ $catalogsItem->iteminventory->$langName }}</h4>
            <hr>
            <p>{{ $catalogsItem->iteminventory->$langDesc }}</p>
            <hr>
            <h5 style="font-family:tahoma;">@lang('tr.Price'): {{ $catalogsItem->iteminventory->price.' '.$system_currency }}</h5>
            <form action="{{ route('cart_store') }}" method="post">
            @csrf
            <input type="hidden" name="price" value="{{ $catalogsItem->iteminventory->price }}">
            <input type="hidden" name="type" value="catalog">
            <input type="hidden" name="catalog_id" value="{{ $catalogsItem->id }}">
            <input type="hidden" name="catalog_name" value="{{ $catalogsItem->iteminventory->en_name.' | '.$catalogsItem->iteminventory->ar_name }}">
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