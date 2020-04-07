@extends('frontend.layouts.master')

@section('title',__('tr.Our Services').' | '.__('tr.Packages')))

@section('servicesactive','current')

@section('stylesheet')
    
@endsection

@section('content')
@php($langName = \Lang::getLocale().'_name')
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

      <div class="products-holder item-col-2">
        
        @foreach ($packages as $package)

        <div class="product">
                
          <!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->
          <figure class="product-image">
            <a href="{{ route('frontend_services_packages_details',$package->id) }}"><img src="{{ asset('uploads/packages/'.$package->package_image)  }}" style="width: 100%; height: 330px;" alt=""></a>
          </figure>
          <!-- - - - - - - - - - - - - - End of Product Image - - - - - - - - - - - - - - - - -->
      
          <!-- - - - - - - - - - - - - - Product Description - - - - - - - - - - - - - - - - -->
          <div class="product-description">
            <h5 class="product-name"><a href="{{ route('frontend_services_packages_details',$package->id) }}">{{$package->name }} | @lang('tr.No Members'): {{ $package->no_members }} | @lang('tr.Price'): {{ $package->price }}</a></h5>
          </div>
<br>          
<form action="{{ route('cart_store') }}" method="post">
  @csrf
  <input type="hidden" name="price" value="{{ $package->price }}">
  <input type="hidden" name="type" value="package">
  <input type="hidden" name="package_id" value="{{ $package->id }}">
  <input type="hidden" name="package_name" value="{{ $package->en_name.' | '.$package->ar_name }}">
  <input type="hidden" name="quantity" value="1">
  
  <hr>
  <button type="submit" class="btn btn-primary col-12">@lang('tr.Add To Cart')</button>
  </form>
          <!-- - - - - - - - - - - - - - End of Product Description - - - - - - - - - - - - - - - - -->
      
        </div>
            
            
        @endforeach
        
        
        <!-- Product -->

      </div>

    </div>

  </div>

</div>

@endsection

@section('javascript')
    
@endsection