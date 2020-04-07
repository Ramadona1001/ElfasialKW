@extends('backend.layouts.master')

@section('itemsactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.All Items'))
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.All Items')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @can('create_items')
                    <a href="{{ route('create_items') }}" class="btn btn-primary">@lang('tr.Create New Items')</a>
                    @endcan
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    
                    <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Price')</th>
                                <th class="tdesign">@lang('tr.Quantity')</th>
                                <th class="tdesign">@lang('tr.Total')</th>
                                <th class="tdesign">@lang('tr.Catalog')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign">{{ $item->name }}</td>
                                <td class="tdesign">{{ $item->price }}</td>
                                <td class="tdesign">{{ $item->quantity }}</td>
                                <td class="tdesign">{{ $item->total_price }}</td>
                                <td class="tdesign">{{ $item->catalog($item->cataglog_id)->name }}</td>
                                <td class="ttdesign">
                                    
                                    @can('show_items')
                                    <a href="{{ route('show_items',$item->id) }}" style="background: orange; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.View')</a>&nbsp;
                                    @endcan

                                    @can('edit_items')
                                    <a href="{{ route('edit_items',$item->id) }}" style="background: purple; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.Edit')</a>&nbsp;
                                    @endcan

                                    @can('delete_items')
                                    <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_items',$item->id) }}">@lang('tr.Delete')</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Descriptions')</th>
                                <th class="tdesign">@lang('tr.Image')</th>
                                <th class="tdesign">@lang('tr.Price')</th>
                                <th class="tdesign">@lang('tr.Catalog')</th>
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
        $('#example').DataTable({ responsive:true});
    } );
</script>
@endsection