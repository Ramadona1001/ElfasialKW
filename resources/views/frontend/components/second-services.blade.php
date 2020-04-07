<div class="page-section">
        
    <div class="container wide">
      
      <div class="content-element4">
        
        <h2 class="title-large style-2 align-center">@lang('tr.Our Services')</h2>

      </div>

      <div class="carousel-type-2">

        <div class="entry-box owl-carousel owl-nav-outside" data-max-items="3" data-item-margin="30">

          @foreach ($catalogs as $catalog)

          <div class="entry-col">
            
            <!-- Entry post -->
            <div class="entry">
              
              <div class="thumbnail-attachment">
                <a href="{{ route('frontend_services_fromchoice',$catalog->id) }}" class="overlink"></a>
                <img src="{{ asset('uploads/catalogs/'.$catalog->catalog_img)}}" alt="">
              </div>
        
              <div class="entry-body">
                  
                <div class="entry-meta">
                
                  <a href="/services#tab-{{ $catalog->categories_id }}" class="entry-cat">{{ $catalog->categoryName( $catalog->categories_id)->name }}</a>
                    
                </div>
        
              <h4 class="entry-title"><a href="{{ route('frontend_services_fromchoice',$catalog->id) }}"> {{ $catalog->name }} </a></h4>
        
                <a href="{{ route('frontend_services_fromchoice',$catalog->id) }}" class="btn btn-small">@lang('tr.Details')</a>
        
              </div>
        
            </div>
        
          </div>
              
          @endforeach
      
        
        </div>

      </div>

    </div>

  </div>