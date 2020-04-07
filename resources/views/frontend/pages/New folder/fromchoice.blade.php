@extends('frontend.layouts.master')

@section('title',__('tr.Our Services'.' | '.__('tr.From Your Choice')))

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
                        @php($catalogs = \App\Catalog::getCatalogs($cat->id))
                        
                        {{-- Buffet --}}
                        @foreach ($buffetsCategory as $buffetCategory)
    
                        @if ($buffetCategory->categories_id == $cat->id)
    
                        <div class="product">
                                
                          <!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->
                          <figure class="product-image">
                            <a href="{{ route('frontend_buffet_services',$buffetCategory->categories_id) }}"><img src="{{ asset('buffets/'.$buffetCategory->buffets_image) }}" style="width: 420px; height: 330px;" alt=""></a>
                          </figure>
                          <!-- - - - - - - - - - - - - - End of Product Image - - - - - - - - - - - - - - - - -->
                      
                          <!-- - - - - - - - - - - - - - Product Description - - - - - - - - - - - - - - - - -->
                          <div class="product-description">
                      
                            <h5 class="product-name"><a href="{{ route('frontend_buffet_services',$buffetCategory->categories_id) }}">@lang('tr.Buffets')</a></h5>
                      
                          </div>
                          <!-- - - - - - - - - - - - - - End of Product Description - - - - - - - - - - - - - - - - -->
                      
                        </div>
                            
                        @endif
                            
                        @endforeach
                        {{-- End Buffet --}}
                        
                        @foreach ($catalogs as $catalog)
    
                        @if ($catalog->categories_id == $cat->id)
    
                        <div class="product">
                                
                          <!-- - - - - - - - - - - - - - Product Image - - - - - - - - - - - - - - - - -->
                          <figure class="product-image">
                            <a href="{{ route('frontend_single_services_details',$catalog->id) }}"><img src="{{ asset('catalogs/'.$catalog->catalog_img) }}" style="width: 420px; height: 330px;" alt=""></a>
                          </figure>
                          <!-- - - - - - - - - - - - - - End of Product Image - - - - - - - - - - - - - - - - -->
                      
                          <!-- - - - - - - - - - - - - - Product Description - - - - - - - - - - - - - - - - -->
                          <div class="product-description">
                      
                            <h5 class="product-name"><a href="{{ route('frontend_single_services_details',$catalog->id) }}">{{ $catalog->name }}</a></h5>
                      
                          </div>
  
                          
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