@extends('frontend.layouts.master')

@section('title',__('tr.Our Services').' | '.__('tr.Packages'))

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
          
          <!--tabs navigation-->                  
          <ul class="tabs-nav clearfix">

            @foreach ($category as $cat)
              <li>
                <a href="#tab-{{ $cat->id }}">{{ $cat->name }}</a>
              </li>
            @endforeach

            
          </ul>

          
        <div class="row">

          <div class="col-lg-12">
            <div class="tabs-content">
  
              @foreach ($category as $cat)
  
              <div id="tab-{{ $cat->id }}">
  
                <div class="row row-size-2">
        
                  <main id="main" class="col-lg-12">
                    
                    <!-- Product sorting -->
                    
                    
                    <div class="products-holder item-col-3">
                        
                        @foreach ($packagesCategory as $package)
    
                        @if ($package->category_id == $cat->id)
    
                        <div class="product">
                                
                          <!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->
                          <figure class="product-image">
                            <a href="{{ route('frontend_services_packages_details',$package->id) }}"><img src="{{ asset('1.png') }}" style="width: 420px; height: 300px;" alt=""></a>
                          </figure>
                          <!-- - - - - - - - - - - - - - End of Product Image - - - - - - - - - - - - - - - - -->
                      
                          <!-- - - - - - - - - - - - - - Product Description - - - - - - - - - - - - - - - - -->
                          <div class="product-description">
                      
                            <h5 class="product-name"><a href="{{ route('frontend_services_packages_details',$package->id) }}">@lang('tr.Packages') | {{ $package->name }}</a>
                              
                            </h5>
                            <form action="{{ route('frontend_add_to_cart') }}" method="post">
                              @csrf
                              <input type="hidden" name="package_id" value="{{ $package->id }}"> 
                            <button type="submit" class="btn btn-primary btn-block col-12" style="border-radius: 0; width: 100%; margin-top: 15px; height: 50px;">
                              <i class="fa fa-cart-plus"></i>
                              @lang('tr.Order')</button>
                            </form>
                      
                          </div>

                          <hr>

                          
  
                          
                          <!-- - - - - - - - - - - - - - End of Product Description - - - - - - - - - - - - - - - - -->
                      
                        </div>

                        
                            
                        @endif
                            
                        @endforeach
  
                        
                        
                        <!-- Product -->
          
                      </div>
        
                    <ul class="pagination justify-content-center">
                      {{-- {{ $catalogs->links() }} --}}
                    </ul>
        
                  </main>
                  
        
                </div>
  
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