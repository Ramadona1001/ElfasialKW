@extends('backend.layouts.master')

@section('inventorysactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Inventory'))
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Inventory')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @can('create_inventory')
                    <a href="{{ route('create_inventory') }}" class="btn btn-primary">@lang('tr.Create New Items')</a>
                    @endcan
                    @can('withdraw_inventory')
                    &nbsp;<a href="{{ route('withdraw_inventory') }}" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary">@lang('tr.Withdraw Items')</a>
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
                                <th class="tdesign">@lang('tr.Quantity')</th>
                                <th class="tdesign">@lang('tr.Price')</th>
                                <th class="tdesign">@lang('tr.User')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory as $index => $item)
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign">
                                    @if($item->quantity <= 0)
                                    <span style="color:red;font-weight:bold">{{ $item->name }}</span>
                                    @else
                                    {{ $item->name }}
                                    @endif
                                </td>
                                <td class="tdesign">
                                    @if($item->quantity <= 0)
                                    <span style="color:red;font-weight:bold">{{ $item->quantity }}</span>
                                    @else
                                    {{ $item->quantity }}
                                    @endif
                                </td>
                                <td class="tdesign">{{ $item->price.' '.$system_currency }}</td>
                                <td class="tdesign">{{ $item->user->name }}</td>
                                
                                <td class="ttdesign">

                                <div class="dropdown dropdown-inline">
                                    <button type="button" class="btn btn-default btn-icon-sm dropdown-toggle pinkbutton" style="color:white;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @lang('tr.Action')  	
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" style="">
                                        <ul class="kt-nav">
                                            
                                            @can('show_inventory')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('show_inventory',$item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-eye"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.View')</span>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('edit_inventory')
                                            <li class="kt-nav__item">
                                                <a href="{{ route('edit_inventory',$item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-edit"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.Edit')</span>
                                                </a>
                                            </li>
                                            @endcan
                                            
                                            @can('delete_inventory')
                                            <li class="kt-nav__item">
                                                <a onclick="return confirm('Are You Sure ?')" href="{{ route('delete_inventory',$item->id) }}" class="kt-nav__link">
                                                    <i class="kt-nav__link-icon la la-trash"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.Delete')</span>
                                                </a>
                                            </li>
                                            @endcan

                                            @can('edit_inventory')
                                            <li class="kt-nav__item">
                                                <a data-toggle="modal" data-quantity="{{ $item->quantity }}" data-item_id="{{ $item->id }}" data-target="#exampleModalCenter" href="{{ route('edit_inventory',$item->id) }}" class="kt-nav__link quantityBtn">
                                                    <i class="kt-nav__link-icon la la-plus"></i>
                                                    <span class="kt-nav__link-text">@lang('tr.Add Quantity')</span>
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
                                <th class="tdesign">@lang('tr.Quantity')</th>
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


{{-- Withdraw --}}
<!-- Button trigger modal -->
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">@lang('tr.Withdraw')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{ route('withdraw_inventory') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="item_inv">@lang('tr.Item')</label>
                    <select name="item_inv" id="item_inv" class="form-control" required>
                        <option value="">@lang('tr.Select Items')</option>
                        @foreach ($inventory as $inv)
                            <option value="{{ $inv->id }}">{{ $inv->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" id="invID"></div>

                <hr>

                <div class="form-group">
                    <label for="customer_inv">@lang('tr.Customer')</label>
                    <select name="customer_inv" id="customer_inv" class="form-control" required>
                        <option value="">@lang('tr.Select Customer')</option>
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->mobile }}</option>
                        @endforeach
                    </select>
                </div>
            

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;@lang('tr.Save')</button>
        </form>
        </div>
      </div>
    </div>
  </div>
{{-- Withdraw --}}



@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

<script>
$(document).ready(function(){
    $('.quantityBtn').click(function(){
        var quantity = $(this).data('quantity');
        var item_id = $(this).data('item_id');
        var qtyUrl = '{{ route("updatequantity_inventory",["id"=>"#id"]) }}';
        qtyUrl = qtyUrl.replace('#id',item_id);
        var formHtml = '';
        formHtml += '<form action="'+qtyUrl+'" method="post">';
        formHtml += '@csrf';
        formHtml += '<div class="form-group">';
        formHtml += '<label for="item_inv">@lang('tr.Quantity')</label>';
        formHtml += '<input type="hidden" value="'+item_id+'" name="item_id">';
        formHtml += '<input type="number" value="1" min="1" step="1" name="newQty" class="form-control">';
        formHtml += '</div>';
        formHtml += '<div class="form-group" id="invID"></div>';
        formHtml += '</div>';
        formHtml += '<div class="modal-footer">';
        formHtml += '<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;@lang('tr.Save')</button>';
        formHtml += '</form>';
        $('#quantityFormId').html(formHtml);
    });
});
</script>

<script>
    
    $(document).ready(function() {

        var invUrl = '{{ route("withdraw_items",["id"=>"#id"]) }}';
        $('#item_inv').change(function(){
            var itemID = $(this).val();
            if (itemID != '') {
                invUrl = invUrl.replace('#id',itemID);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'GET',
                    url:invUrl,
                    data:{},
                        success:function(data){
                            $('#invID').html('<input type="number" onkeypress="validate(event)" placeholder="@lang("tr.Maximum Value is") '+data.inv.quantity+'" value="1" step="1" min="1" max="'+data.inv.quantity+'" class="form-control" required name="inv_quantity">');
                    }
                });
            }else{
                $('#invID').html('');
            }
        });

        $('#example').DataTable({ responsive: true });
    } );

    
</script>

<script>
    function validate(evt) {
      var theEvent = evt || window.event;
    
      // Handle paste
      if (theEvent.type === 'paste') {
          key = event.clipboardData.getData('text/plain');
      } else {
      // Handle key press
          var key = theEvent.keyCode || theEvent.which;
          key = String.fromCharCode(key);
      }
      var regex = /[0-9]|\./;
      if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
      }
    }
    </script>
@endsection