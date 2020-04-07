@extends('frontend.layouts.master')

@section('title',__('tr.Packages').' | '.$package->name)

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
          <h2 class="title-large style-2">@lang('tr.Make your day is nice from start to end')</h2>
          <p>@lang('tr.We offer you everything you need for occasions')</p>
        </div>

      </div>

        <div class="tabs style-2 tabs-section">
          
         
          
        <div class="row">

          <div class="col-lg-12">
            

            <div class="products-holder item-col-3">

              @php($langName = \Lang::getLocale().'_name')

                @foreach ($packagesItems as $item)

                <div class="product">
                                
                    <!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->
                    <figure class="product-image">
                      <img src="{{ asset('packages/items/'.$item->package_imgs) }}" style="width: 420px; height: 280px;" alt="">
                    </figure>
                    <!-- - - - - - - - - - - - - - End of Product Image - - - - - - - - - - - - - - - - -->
                
                    <!-- - - - - - - - - - - - - - Product Description - - - - - - - - - - - - - - - - -->
                    <div class="product-description">
                
                      <h5 class="product-name">
                        @lang('tr.Name') : {{ $item->$langName }}
                      </h5>
                
                    </div>

                    
                    <!-- - - - - - - - - - - - - - End of Product Description - - - - - - - - - - - - - - - - -->
                
                  </div>
                    
                @endforeach
                        
                
  
            </div>
            

           </div>
  
           

        </div>

    </div>

  </div>

</div>

@endsection

@section('javascript')
    
@endsection