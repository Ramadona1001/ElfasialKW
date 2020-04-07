@extends('frontend.layouts.master')

@section('title',__('tr.Our Services').' | '.__('tr.Packages')))

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

      
      <div class="products-holder item-col-3">
        @foreach ($packagesItems as $package)

        <div class="product">
                
          <!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->
          <figure class="product-image">
            <img src="{{ asset('uploads/itemsinventories/'.$package->iteminventory->inventory_image) }}" style="width: 100%; height: 330px;" alt="">
          </figure>
          <!-- - - - - - - - - - - - - - End of Product Image - - - - - - - - - - - - - - - - -->
      
          <!-- - - - - - - - - - - - - - Product Description - - - - - - - - - - - - - - - - -->
          <div class="product-description">
            <h5 class="product-name">{{$package->iteminventory->$langName }}</h5>
          </div>
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