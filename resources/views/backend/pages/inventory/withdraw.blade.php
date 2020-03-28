@extends('backend.layouts.master')

@section('withdrawsactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Withdraw'))
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Withdraw')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    
                    <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Inventory')</th>
                                <th class="tdesign">@lang('tr.Customer')</th>
                                <th class="tdesign">@lang('tr.Quantity')</th>
                                <th class="tdesign">@lang('tr.Total')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdraw as $index => $item)
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign">{{ $item->inventoryName($item->inventory_id)->name }}</td>
                                <td class="tdesign">{{ $item->customer->mobile }}</td>
                                <td class="tdesign">{{ $item->quantity }}</td>
                                <td class="tdesign">{{ $item->total_price }}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Inventory')</th>
                                <th class="tdesign">@lang('tr.Customer')</th>
                                <th class="tdesign">@lang('tr.Quantity')</th>
                                <th class="tdesign">@lang('tr.Total')</th>
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
  $('#example').DataTable({ responsive: true });
</script>

@endsection