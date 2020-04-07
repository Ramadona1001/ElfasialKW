@extends('backend.layouts.master')

@section('ordersactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Orders'))
    
@section('stylesheet')
   
@endsection

@section('content')
@php($langName = \Lang::getLocale().'_name')

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Orders')
                    </h3>
                </div>
            </div>
            
                @foreach ($orders as $order)
            
                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample{{$order->id}}" style="padding:10px 20px;">
                    <div class="card">
                        <div class="card-header" id="heading{{$order->id}}">
                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapse{{$order->id}}" aria-expanded="false" aria-controls="collapse{{$order->id}}">
                                <i class="flaticon2-delivery-package"></i> {{$order->code}}  
                                &nbsp;&nbsp;&nbsp;<a href="{{ route('tasksorders_inventory',$order->id) }}" class="pinkbutton">@lang('tr.Create Tasks')</a>
                            </div>
                        </div>
                        <div id="collapse{{$order->id}}" class="collapse" aria-labelledby="heading{{$order->id}}" data-parent="#accordionExample{{$order->id}}" style="">
                            
                            <div class="row" style="padding: 10px; border: 1px dashed; width: 100%; margin-left: auto; margin-right: auto;">
                                <div class="col-lg-6">
                                    <h5>@lang('tr.Code'): {{ $order->code }}</h5>
                                </div>
                                <div class="col-lg-6">
                                    <h5>@lang('tr.User'): {{ $order->user_phone }}</h5>
                                </div>
                                <div class="col-lg-6">
                                    <h5>@lang('tr.Quantity'): {{ $order->quantity }}</h5>
                                </div>
                                <div class="col-lg-6">
                                    <h5>@lang('tr.Price'): {{ $order->price.' '.$system_currency }}</h5>
                                </div>
                                <div class="col-lg-6">
                                    <h5>@lang('tr.Address'): {{ $order->address }}</h5>
                                </div>
                                <div class="col-lg-6">
                                    <h5>@lang('tr.Day / Time'): {{ $order->order_day }}</h5>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <form action="{{ route('printOrder') }}" style="width:100%;display: inherit;" method="post">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <select name="contract" id="" class="form-control" style="width: 96%; margin-right: 20px;">
                                    @foreach ($contracts as $contract)
                                        <option value="{{ $contract->id }}">{{ $contract->$langName }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i></button>
                                </form>
                                
                            </div>
                            <hr>
                            <div class="card-body">
                                <table class="display example" style="width:100%;" class="table table-bordered dt-responsive">
                                    <thead>
                                        <tr>
                                            <th class="tdesign">#</th>
                                            <th class="tdesign">@lang('tr.Item')</th>
                                            <th class="tdesign">@lang('tr.Quantity')</th>
                                            <th class="tdesign">@lang('tr.Price')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php($index = 1)
                                    @foreach ($ordersData as $data)
                                        @if ($data->mainorder_id == $order->id)
                                            <tr>

                                                <td class="tdesign">{{ $index }}</td>
                                                <td class="tdesign">{{ $data->name }}</td>
                                                <td class="tdesign">{{ $data->quantity }}</td>
                                                <td class="tdesign">{{ $data->price.' '.$system_currency }}</td>
                                                
                                                
                                            </tr>
                                            @php($index++)
                                        @endif
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="tdesign">#</th>
                                            <th class="tdesign">@lang('tr.Item')</th>
                                            <th class="tdesign">@lang('tr.Quantity')</th>
                                            <th class="tdesign">@lang('tr.Price')</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                        
                </div>
                    @endforeach
            
        </div>
    </div>
</div>



@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $('.example').DataTable({ responsive: true });
</script>
@endsection