@extends('frontend.layouts.master')

@section('title','Foods Details')

@section('servicesactive','current')

@section('stylesheet')

<link rel="stylesheet" href="{{ asset('frontend/font/linearicons/demo.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/font/fontello/fontello.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/plugins/fancybox/jquery.fancybox.css')}}">

<!-- CSS theme files
============================================ -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-grid.min.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/rtl.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}">
    
@endsection

@section('content')

@include('frontend.components.breadcrumb')


<div class="page-section">      
  <div class="container wide">

    <div class="col-lg-12 col-md-12">

        <div class="content-element4 ">

            <div class="align-center marginBottom">
            <h2 class="title-large style-2">@lang('tr.Make your day is nice from start to end')</h2>
            <p>@lang('tr.We offer you everything you need for occasions')</p>
        </div>

    </div>
      <div class="content-element">
            
            <!-- Info Boxes -->
            <div class="info-boxes style-2 item-col-3">
            
              <!-- - - - - - - - - - - - - - Info Box Item - - - - - - - - - - - - - - - - -->
              <div class="info-box-col">
                
                <div class="info-box-wrap">
                  
                  <div class="info-box">
                    
                    <div class="box-img">
                      <img src="{{ asset('frontend/images/food1.jpg') }}" alt="">
                    </div>

                    <div class="box-content">
                      
                      <h2 class="box-title">Dish 1</h2>
                      <p> dish 1 description </p>
                      <a href="#" class="btn btn-small">Details</a>

                    </div>

                  </div>

                </div>

              </div>

              <!-- - - - - - - - - - - - - - Info Box Item - - - - - - - - - - - - - - - - -->
              <div class="info-box-col">
                
                <div class="info-box-wrap">
                  
                  <div class="info-box">
                    
                    <div class="box-img">
                      <img src="{{ asset('frontend/images/food2.jpg') }}" alt="">
                    </div>

                    <div class="box-content">
                      
                      <h2 class="box-title">Dish 2</h2>
                      <p> dish 2 description </p>
                      <a href="#" class="btn btn-small">Details</a>

                    </div>

                  </div>

                </div>

              </div>

              <!-- - - - - - - - - - - - - - Info Box Item - - - - - - - - - - - - - - - - -->
              <div class="info-box-col">
                
                <div class="info-box-wrap">
                  
                  <div class="info-box">
                    
                    <div class="box-img">
                      <img src="{{ asset('frontend/images/food3.jpg') }}" alt="">
                    </div>

                    <div class="box-content">
                      
                      <h2 class="box-title">Dish 3</h2>
                      <p> dish 3 description </p>
                      <a href="#" class="btn btn-small">Details</a>

                    </div>

                  </div>

                </div>

              </div>

            </div>

          </div>

      </div>

     </div>
          

    @endsection

@section('javascript')
  <script src="{{asset('frontend/plugins/instafeed.min.js')}}"></script>
  <script src="{{asset('frontend/plugins/elevatezoom.min.js')}}"></script>
  <script src="{{asset('frontend/plugins/mad.customselect.js')}}"></script>
  <script src="{{asset('frontend/plugins/fancybox/jquery.fancybox.min.js')}}"></script>
  <script src="{{asset('frontend/plugins/jquery.queryloader2.min.js')}}"></script>


@endsection



