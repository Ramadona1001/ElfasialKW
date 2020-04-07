@extends('frontend.layouts.master')

@section('title',__('tr.Our Services').' | '.__('tr.Buffets')))

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

      <div class="products-holder item-col-3">
        
        @foreach ($buffets as $buffet)

        <div class="product">
                
          <!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->
          <figure class="product-image">
            <a href="{{ route('frontend_services_single_buffets',$buffet->id) }}"><img src="{{ asset('uploads/itemsinventories/'.$buffet->iteminventory->inventory_image) }}" style="width: 420px; height: 330px;" alt=""></a>
          </figure>
          <!-- - - - - - - - - - - - - - End of Product Image - - - - - - - - - - - - - - - - -->
      
          <!-- - - - - - - - - - - - - - Product Description - - - - - - - - - - - - - - - - -->
          <div class="product-description">
      
            <h5 class="product-name"><a href="{{ route('frontend_services_single_buffets',$buffet->id) }}">{{$buffet->iteminventory->$langName }}</a></h5>
      
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