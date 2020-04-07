@extends('frontend.layouts.master')


@section('servicesactive','current')

@section('stylesheet')
    
@endsection

@section('content')

@include('frontend.components.breadcrumb')

<div id="content" class="page-content-wrap">

  <div class="container wide">

    <div class="col-lg-12 col-md-12">

      <div class="content-element4 ">

        <div class="align-center marginBottom">
          <h2 class="title-large style-2">@lang('tr.Make Your Day is Nice From Start To End')</h2>
          <a href="{{ route('frontend_services') }}" class="btn btn-success">@lang('tr.Get All')</a>
        </div>

      </div>

        <div class="row">
            @foreach ($catalogs as $catalog)
  

            <div class="col-lg-4">
                <div class="product">
                    
                    <!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->
                    <figure class="product-image">
                      <a href="#"><img src="{{ asset('catalogs/'.$catalog->catalog_img) }}" alt=""></a>
                    </figure>
                    <!-- - - - - - - - - - - - - - End of Product Image - - - - - - - - - - - - - - - - -->
                
                    <!-- - - - - - - - - - - - - - Product Description - - - - - - - - - - - - - - - - -->
                    <div class="product-description">
                
                      <h5 class="product-name"><a href="#">{{ $catalog->name }}</a></h5>
                
                      <div class="pricing-area">
                
                        <div class="product-price">
                          
                          @lang('tr.Price'): {{ $catalog->getTotal($catalog->id) }}
                        </div>
                
                      </div>
                
                    </div>
                    <!-- - - - - - - - - - - - - - End of Product Description - - - - - - - - - - - - - - - - -->
                
                  </div>
            </div>
                
                
            @endforeach
            <ul class="pagination justify-content-center">
                {{ $catalogs->links() }}
              </ul>
        </div>

  </div>

</div>

@endsection

@section('javascript')
    
@endsection