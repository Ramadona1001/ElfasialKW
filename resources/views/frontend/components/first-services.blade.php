
<div class="page-section">
        
    <div class="container wide">
      
      <div class="content-element4">
        
        <div class="align-center">
          
          <h2 class="title-large style-2">@lang('tr.Make your day is nice from start to end')</h2>
          <p class="p_description" >
            @lang('tr.We offer you everything you need for occasions')
          </p>

        </div>

      </div>

      <div class="icons-box type-2 style-2 color-style-2 item-col-3">

        <!-- - - - - - - - - - - - - - Icon Box Item - - - - - - - - - - - - - - - - -->        
        
        @foreach ($categories as $category)

        <div class="icons-wrap">

          <div class="icons-item">
            
            <div class="item-box bg_card"  data-bg="{{ asset('uploads/categories/'.$category->cat_image)}}">
              <a href="/services#tab-{{ $category->id }}" class="overlink"></a>
              <div class="box-wrap">
                
                <div id="svg-ring-1" class="svg-icon"></div>
                <h2 class="icons-box-title">{{$category->name}}</h2>
            

              </div>

            </div>

            <div class="item-box with-bg">

            
              
              <div class="box-wrap">
                
                <div id="svg-ring-2" class="svg-icon"></div>
                <h2 class="icons-box-title pink_color">{{$category->name}}</h2>
                <p>{{ substr($category->desc,0,200) }}</p>
                <a href="/services#tab-{{ $category->id }}" class="btn btn-small">@lang('tr.More')</a>
              </div>

            </div>

          </div>

        </div>
        
        @endforeach
        
   
      </div>

    </div>

  </div>