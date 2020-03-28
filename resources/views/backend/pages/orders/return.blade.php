@extends('backend.layouts.master')

@section('ordersactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Return Items'))
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Return Items')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                    @csrf

                    @php($order_data = json_decode($order->order_data,true))
                    @php($count = count($order_data) / 4)

                    <table style="width:100%" class="table table-bordered">
                        <thead>
                            <th>@lang('tr.Name')</th>
                            <th>@lang('tr.Quantity')</th>
                            <th>@lang('tr.Price')</th>
                            <th>@lang('tr.Action')</th>
                        </thead>
                        <tbody>
                        
                        @for ($i = 0; $i < $count; $i++)
                        
                        @php($title = 'title_'.$i)
                        @php($id = 'id_'.$i)
                        @php($quantity = 'quantity_'.$i)
                        @php($total = 'total_'.$i)
                        
                        <tr>
                            <form action="{{ route('return_items_orders_post') }}" method="post">
                                @csrf
                                <td>{{ $order_data[$title] }}</td>
                                <td>
                                <input type="number" name="quantity" value="{{ $order_data[$quantity] }}" max="{{ $order_data[$quantity] }}" min="0" step="1" class="form-control" id="order_data_{{ $order_data[$id] }}" required></td>
                                <input type="hidden" name="order_item_quantity" value="{{ $order_data[$quantity] }}">
                                <input type="hidden" name="order_item_id" value="{{ $order_data[$id] }}">
                                <input type="hidden" name="order_item_name" value="{{ $order_data[$title] }}">
                                <input type="hidden" name="order_item_total" value="{{ $order_data[$total] }}">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <td>{{ $order_data[$total] }}&nbsp;{{ $system_currency }}</td>
                                <td><button type="submit" class="bluebutton">@lang('tr.Return')</button></td>
                            </form>
                        </tr>

                       
                        @endfor
                        </tbody>
                    </table>
                  
                    
                    <hr>
                    <div class="form-group">
                        <!-- <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i>&nbsp;@lang('tr.Save')
                        </button> -->
                    </div>
                    
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

<script type="text/javascript">
    $('#example').DataTable({ responsive: true });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   


    $("#customer_id").change(function(e){
       if($(this).val() != ''){
            var customer_id = $(this).val();
            var customerUrl = '{{ route("customers_orders",["id"=>"#id"]) }}';
            var url = customerUrl.replace('#id',customer_id);
            $.ajax({
            type:'GET',
            url:url,
            data:{},
                success:function(data){
                    $('#customerIdTxt').text(data.customers.mobile);
                }
            });
       }else{
        $('#customerIdTxt').text('');
       }

	});

    $('#order_from').on("input",function(){
        if($(this).val() != ''){
           var times = $(this).val().split(':');
            
            $('#order_to').removeAttr('readonly');
            $('#order_to').attr('min',times[0]+":"+times[1]+":00");
            $('#order_to').val(times[0]+":"+times[1]+":00");
        }else{
            $('#order_to').attr('readonly');
        }
    });
    

    $('#order_to').on("input",function(){
        if($(this).val() != ''){
            var timesTo = $(this).val().split(':');
            var timesFrom = $('#order_from').val().split(':');
           if(timesTo[0] < timesFrom[0] || timesTo[1] < timesFrom[1]){
                    $(this).val($('#order_from').val());
           }
        }else{
            $(this).val($('#order_from').val());
        }
    });

    $("#catalog_id").change(function(e){
       if($(this).val() != ''){
            var catalog_id = $(this).val();
            var catalogUrl = '{{ route("catalogs_orders",["id"=>"#id"]) }}';
            var url = catalogUrl.replace('#id',catalog_id);
            $.ajax({
            type:'GET',
            url:url,
            data:{},
                success:function(data){
                    $('#catalogIdTxt').text(data.catalog_total);
                }
            });
       }else{
        $('#catalogIdTxt').text('');
       }

	});
    
    $('#order_day').on("input",function(){
        if($(this).val() != ''){
            var d = '{{ date("Y-m-d") }}';
           if($(this).val() < d){
                $(this).val(d);
           }
        }
    });

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