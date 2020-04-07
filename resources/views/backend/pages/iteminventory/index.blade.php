@extends('backend.layouts.master')

@section('iteminventorysactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Items Inventory'))
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Items Inventory')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @can('create_inventory')
                    <a href="{{ route('create_iteminventory') }}" class="btn btn-primary">@lang('tr.Create New Items')</a>
                    @endcan
                    
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    
                    <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Image')</th>
                                <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Price')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory as $index => $item)
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign">
                                    
                                <img src="{{ asset('uploads/itemsinventories/'.$item->inventory_image) }}" alt="" srcset="" style="width:100px;height:50px;">    
                                </td>
                                <td class="tdesign">
                                    {{ $item->name }}
                                </td>
                                <td class="tdesign">{{ $item->price.' '.$system_currency }}</td>
                                
                                <td class="ttdesign">

                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle pinkbutton" style="color:white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @lang('tr.Action')  	
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                        <ul class="kt-nav">
                                            
                                            @can('show_inventory')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('show_iteminventory',$item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-eye"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.View')</span>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('edit_inventory')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('edit_iteminventory',$item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-edit"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.Edit')</span>
                                                </a>
                                            </li>
                                            @endcan
                                            
                                            @can('delete_inventory')
                                            <li class="kt-nav__item">
                                                <a onclick="return confirm('Are You Sure ?')" href="{{ route('delete_iteminventory',$item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-trash"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.Delete')</span>
                                                </a>
                                            </li>
                                            @endcan

                                        
                                            
                                        </ul>
                                    </div>
		                        </div>
                                    
                                    
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Price')</th>
                                <th class="tdesign">@lang('tr.User')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </tfoot>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add New Quantity -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">@lang('tr.Add Quantity')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      <div id="quantityFormId"></div>
      

      </div>
     
    </div>
  </div>
</div>

<!-- End Add New Quantity -->


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