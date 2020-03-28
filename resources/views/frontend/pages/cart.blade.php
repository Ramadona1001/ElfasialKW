@extends('frontend.layouts.master')

@section('title',__('tr.Cart'))

@section('cartsactive','current')

@section('stylesheet')

@endsection

@section('content')

@include('frontend.components.breadcrumb')

<!-- - - - - - - - - - - - - - Content - - - - - - - - - - - - - - - - -->

<div id="content" class="page-content-wrap">

    <div class="container wide">
      
      <div class="content-element8">
        
        <div class="shop-cart-form table-type-1 responsive-table">
          <table>
            <thead>
              <tr>
                <th class="product-col">@lang('tr.Order') #</th>
                <th class="price-col">@lang('tr.Total')</th>
                <th class="price-col">@lang('tr.Action')</th>
              </tr>
            </thead>
            @php($total = 0)
            @foreach ($cart as $c)
            @php($total = $total + $c->total_price)
            <tr>
                <td class="close-product shopping-cart-full" data-title="Product">
                  
                  <div class="product">
  
                    <a href="#" class="product-image">
                      
                      <img src="{{ asset('catalogs/'.$c->catalog->catalog_img) }}" alt="" srcset="">
  
                    </a>
  
                    <div class="product-description">
  
                      <h6 class="product-name"><a href="#">{{ $c->order_code }}</a></h6>
  
                    </div><!--/ .product-info -->
  
                  </div>
  
                </td>
                <td data-title="Price">{{ $c->total_price }}</td>
                <td data-title="Price">
                  <a href="{{ route('frontend_order_view',$c->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    @if($c->editOrdeleteOrder($c->id) == 0)
                    <a href="{{ route('frontend_order_edit',$c->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                    <a href="{{ route('frontend_order_delete',$c->id) }}" class="btn btn-primary"><i class="fa fa-trash"></i></a>
                    @endif
                </td>
              </tr>
            @endforeach

            <tr>
                <td colspan="1">

                </td>
                <td colspan="2">
                  <div class="align-right">
                    <h4>@lang('tr.Total'): {{ $total }}</h4>
                  </div>
                </td>
              </tr>
           
          </table>
        </div>

      </div>

      

    </div>
    
  </div>

  <!-- - - - - - - - - - - - - end Content - - - - - - - - - - - - - - - -->

@endsection

@section('javascript')

@endsection