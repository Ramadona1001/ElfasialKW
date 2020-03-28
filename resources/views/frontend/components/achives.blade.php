<div class="page-section" style="padding: 30px 0 0 0 !important;">

    <div class="content-element8">

      <div class="content-element2">
        
        <div class="container wide ">
        
          <h2 class="textCenter title-large">@lang('tr.Our Achives')</h2>
          <p class="p_description" >
            @lang('tr.We have had many weddings, birthdays and special occasions')
          </p>


        </div>

      </div>

      <div class="content-element8" style="padding: 30px 0 0 0 !important;">
        
        <div class="counter-holder">
          
          <div class="container wide">
            
            <div class="counter-wrap style-2 item-col-4">

              <div class="counter" >
                <div class="count-item " >
                  <span class="flaticon-008-wedding-dress"></span>
                  <div class="count-title" >
                    <h5 class="timer count-number" data-to="{{ $catalogs_count }}" data-speed="500">{{ $catalogs_count }}</h5>
                    <p >@lang('tr.Catalogs')</p>
                  </div>
                </div>
              </div>

              <div class="counter">
                <div class="count-item">
                  <span class="flaticon-008-wedding-dress"></span>
                  <div class="count-title">
                    <h5 class="timer count-number" data-to="{{ $reviews_count }}" data-speed="500">{{ $reviews_count }}</h5>
                    <p>@lang('tr.Our Customers Reviews')</p>
                  </div>
                </div>
              </div>

              <div class="counter">
                <div class="count-item">
                  <span class="flaticon-033-bouquet"></span>
                  <div class="count-title">
                    <h5 class="timer count-number" data-to="{{ $orders_count }}" data-speed="500">{{ $orders_count }}</h5>
                    <p>@lang('tr.Organize Occasions')</p>
                  </div>
                </div>
              </div>

              <div class="counter">
                <div class="count-item">
                  <span class="flaticon-034-rings"></span>
                  <div class="count-title">
                    <h5 class="timer count-number" data-to="{{ $customers_count }}" data-speed="500">{{ $customers_count }}</h5>
                    <p>@lang('tr.Our Customers')</p>
                  </div>
                </div>
              </div>

            </div>

          </div>

        </div>

      </div>
    </div>

    </div>



    <div class="call-out with-bg-img" data-bg="{{ asset('frontend/images/home/subscribe2.jpg') }}">

 
        <div class="container">
          <div class="overlayout"></div>
          <div class="align-center">
            
            <h2 class="title subscribe_font"> @lang('tr.All Weddings and Special Occasions') </h2>
            <br>
            <a href="{{ route('frontend_services') }}" class="btn btn-big">@lang('tr.Reserve Your Occasions')</a>
    
          </div>
    
        </div>
      </div>