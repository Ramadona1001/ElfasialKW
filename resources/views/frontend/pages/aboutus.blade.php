@extends('frontend.layouts.master')

@section('title',__('tr.About Us'))

@section('aboutactive','current')

@section('stylesheet')
    
@endsection

@section('content')

@include('frontend.components.breadcrumb')

<div class="page-section">

    <div class="container wide">
      
      <div class="content-element4">
        
        <div class="align-center">
          
          <a href="{{ route('frontend_index') }}" class="logo "><img src="{{ asset('logo/'.$system_logo) }}" alt=""></a>
          
          <p class="phargrah_center">
            {{ $system_title."'s" }}&nbsp;
            @lang("tr.décor is distinguished by its distinctive design and elegant décor, and we present to you through the following distinct and modern collection")
          </p>

        </div>

      </div>

    
    <div class="container wide">
      
      <div class="content-element">
        
        <div class="icons-box style-4 color-style-2">

          @foreach ($categories as $cat)

          <div class="icons-wrap">


            <div class="icons-item">
              <div class="item-box">
                <h2 style="color: #f05f79;" class="icons-box-title">{{ $cat->name }}</h2>
                <p>{{ $cat->desc }}</p>
              </div>
            </div>
            <div class="icons-img-col" data-bg="{{ asset('categories/'.$cat->cat_image) }}"></div>


          </div>
              
          @endforeach

        </div>

      </div>

    
    </div>

  </div>
  </div>


@endsection

@section('javascript')
    
@endsection