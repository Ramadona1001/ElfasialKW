@extends('backend.layouts.master')

@section('ordersactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Orders'))
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Orders')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">

                    <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Code')</th>
                                <th class="tdesign">@lang('tr.Customer')</th>
                                <th class="tdesign">@lang('tr.Order Data')</th>
                                <th class="tdesign">@lang('tr.Day')</th>
                                <th class="tdesign">@lang('tr.From') - @lang('tr.To')</th>
                                <th class="tdesign">@lang('tr.Status')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                            @php($order_data = json_decode($order->order_data,true))
                            @php($count = count($order_data) / 4)
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign">{{ $order->order_code }}</td>
                                <td class="tdesign">{{ $order->customer->mobile }}</td>
                                <td class="tdesign">
                                    @for ($i = 0; $i < $count; $i++)
                                        @php($title = 'title_'.$i)
                                        @php($quantity = 'quantity_'.$i)
                                        @php($total = 'total_'.$i)

                                        <span style="color:#f05f78;font-style:italic;font-weight: bold;">{{ $order_data[$title].', Quantity: '.$order_data[$quantity].', Total: '.$order_data[$total].' '.$system_currency }}</span><br>
                                    @endfor
                                </td>
                                <td class="tdesign">{{ $order->order_day }}</td>
                                <td class="tdesign">{{ $order->order_from.' - '.$order->order_to }}</td>
                                <td class="tdesign">
                                    @if ($order->status == 'finished')
                                        <span style="font-weight:bold;color:green">{{ __('tr.'.$order->status) }}</span>
                                    @else
                                        {{ __('tr.'.$order->status) }}
                                    @endif
                                </td>
                                <td class="tdesign">

                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle pinkbutton" style="color:white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @lang('tr.Action')  	
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                        <ul class="kt-nav">
                                            
                                            @can('show_orders')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('show_orders',$order->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-eye"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.View')</span>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('create_tasks')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('tasksorders_inventory',$order->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-tasks"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.Tasks')</span>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('edit_orders')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('edit_orders',$order->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-edit"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.Edit')</span>
                                                </a>
                                            </li>
                                            
                                            {{-- <li class="kt-nav__item">
                                                <a href="{{ route('return_items_orders',$order->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-send"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.Return Items')</span>
                                                </a>
                                            </li> --}}
                                            @endcan

                                            @can('delete_orders')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('delete_orders',$order->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-trash"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.Delete')</span>
                                                </a>
                                            </li>
                                            @endcan
                                            
                                        </ul>
                                    </div>
		                        </div>

                                    
                                    @can('edit_orders')
                                    @if($order->editOrdeleteOrder($order->id) == 0)
                                        @if($order->expiredOrder($order->id) != 'finished')
                                            
                                        @endif
                                    @endif
                                    @endcan

                                    @can('delete_orders')
                                    @if($order->editOrdeleteOrder($order->id) == 0)
                                        @if($order->expiredOrder($order->id) != 'finished')
                                            
                                        @endif
                                    @endif
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Code')</th>
                                <th class="tdesign">@lang('tr.Customer')</th>
                                <th class="tdesign">@lang('tr.Order Data')</th>
                                <th class="tdesign">@lang('tr.Day')</th>
                                <th class="tdesign">@lang('tr.From')&nbsp;@lang('tr.To')</th>
                                <th class="tdesign">@lang('tr.Status')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>
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
    $(document).ready(function() {
        $('#example').DataTable({responsive:true});
    } );
</script>
@endsection