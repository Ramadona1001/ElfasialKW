@extends('frontend.layouts.master')

@section('title',__('tr.Orders History'))

@section('cartsactive','current')

@section('stylesheet')

@endsection

@section('content')

@include('frontend.components.breadcrumb')

<!-- - - - - - - - - - - - - - Content - - - - - - - - - - - - - - - - -->

<div id="content" class="page-content-wrap">

    <div class="container wide">
      
      <div class="content-element8">
        
        <div class="icons-box type-2 style-2 color-style-2 item-col-3">
            @foreach ($orders as $order)
            <div class="icons-wrap" style="margin-bottom:30px;">

                <div class="icons-item">
                  
                  <div class="item-box bg_card"  data-bg="{{ asset('frontend/images/orders_bg.jpg') }}">
                    <a href="#" class="overlink"></a>
                    <div class="box-wrap">
                      
                      <div id="svg-ring-1" class="svg-icon"></div>
                      <h2 class="icons-box-title" style="font-size:2.5rem;">{{$order->order_code}}</h2><hr>
                      <p style="color:white;font-size:16px;margin-top: 36px;">
                        <i class="fa fa-calendar"></i>  {{$order->order_day}}
                      </p>
                      <p style="color:white;font-size:16px;margin-top: 36px;">
                        <i class="fa fa-clock"></i>  @lang('tr.From'): {{$order->order_from}} - @lang('tr.To'): {{ $order->order_to }}
                      </p>
                      <p style="color:white;font-size:16px;margin-top: 36px;">
                        <i class="fa fa-user-tag"></i>  @lang('tr.Status'): {{ __('tr.'.$order->status) }}
                      </p>

      
                    </div>
      
                  </div>
      
                  <div class="item-box with-bg">
      
                  
                    
                    <div class="box-wrap">
                      
                      <div id="svg-ring-2" class="svg-icon"></div>
                      <h2 class="icons-box-title pink_color" style="font-size:2.5rem;">
                        @lang('tr.Order Data')  
                        </h2>
                        @php($order_data = json_decode($order->order_data,true))
                        @php($count = count($order_data) / 4)
                        @for ($i = 0; $i < $count; $i++)
                        @php($title = 'title_'.$i)
                        @php($quantity = 'quantity_'.$i)
                        @php($total = 'total_'.$i)

                        <span style="color:#f05f78;font-style:italic;font-weight: bold;">{{ $order_data[$title].', Quantity: '.$order_data[$quantity].', Total: '.$order_data[$total].' '.$system_currency }}</span><br>
                        @endfor
                      <a href="{{ route('frontend_order_view',$order->id) }}" class="btn btn-small">قراءة المزيد</a>
                    </div>
      
                  </div>
      
                </div>
      
              </div>
              
            @endforeach
        </div>

      </div>

      

    </div>
    
  </div>

  <!-- - - - - - - - - - - - - end Content - - - - - - - - - - - - - - - -->

@endsection

@section('javascript')

@endsection