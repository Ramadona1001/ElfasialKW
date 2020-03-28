@extends('backend.layouts.master')

@section('ordersactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Update Order'))
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Update Order')
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
                            <form action="{{ route('delete_items_orders') }}" method="post">
                                @csrf
                                <td>{{ $order_data[$title] }}</td>
                                <td>{{ $order_data[$quantity] }}
                                <input type="hidden" name="quantity" value="{{ $order_data[$quantity] }}" min="0" step="1" class="form-control" id="order_data_{{ $order_data[$id] }}" required></td>
                                <input type="hidden" name="order_item_id" value="{{ $order_data[$id] }}">
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <td>{{ $order_data[$total] }}&nbsp;{{ $system_currency }}</td>
                                <td><button type="submit" class="pinkbutton">@lang('tr.Delete')</button></td>
                            </form>
                        </tr>

                       
                        @endfor
                        </tbody>
                    </table>
                    <hr>

                    <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Image')</th>
                                <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Quantity')</th>
                                <th class="tdesign">@lang('tr.Price')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory as $index => $item)
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign"><img src="{{ asset('inventories/'.$item->inventory_image) }}" style="width:100px;" alt="" srcset=""></td>
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
                                    <form action="{{ route('update_items_orders') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="inventory_id" value="{{ $item->id }}">
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <input type="hidden" name="item_title" value="{{ $item->name }}">
                                        <input type="hidden" name="item_price" value="{{ $item->price }}">
                                        <input type="hidden" name="order_data" value="{{ $order->order_data }}">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="number" required name="inventory_new_qty" value="0" min="0" max="{{ $item->quantity }}" class="form-control" id="">
                                            </div>
                                            <div class="col-lg-6">
                                                <button type="submit" class="bluebutton">@lang('tr.Add')</button>
                                            </div>
                                        </div>
                                    </form>
                                    @endif
                                </td>
                                <td class="tdesign">{{ $item->price.' '.$system_currency }}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Image')</th>
                                <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Quantity')</th>
                                <th class="tdesign">@lang('tr.Price')</th>
                            </tr>
                        </tfoot>
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
    $(document).ready(function() {
        var max_fields      = 100;
        var wrapper         = $(".container1"); 
        var add_button      = $(".add_form_field"); 
        var skillHtml       = '';
        var x = 1; 
        $(add_button).click(function(e){ 
            e.preventDefault();
            if(x < max_fields){ 
                x++;
                skillHtml += '<div style="border: 1px solid #e4e4e4; padding: 15px;margin-top:10px;">';
                skillHtml += '<div class="row">';
                skillHtml += '<div class="col-lg-4"><div class="form-group"><label for="follow_name">@lang("tr.Follower Name")</label><input type="text" name="follow_name[]" id="follow_name" class="form-control" placeholder="@lang("tr.Follower Name")" required></div></div>';
                skillHtml += '<div class="col-lg-4"><div class="form-group"><label for="follow_mobile">@lang("tr.Follower Mobile")</label><input type="text" name="follow_mobile[]" id="follow_mobile" class="form-control" placeholder="@lang("tr.Follower Mobile")" required></div></div>';
                skillHtml += '<div class="col-lg-4"><div class="form-group"><label for="follow_email">@lang("tr.Follower Email")</label><input type="email" name="follow_email[]" id="follow_email" class="form-control" placeholder="@lang("tr.Follower Email")" required></div></div>';
                skillHtml += '</div>';


                skillHtml += '<a href="#" class="delete btn btn-danger">@lang("tr.Delete")</a></div>'; //add input box


                $(wrapper).append(skillHtml);

                skillHtml = '';
                $('.save_btn').html('<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i>&nbsp; @lang("tr.Save")</button>');
            }
            else
            {
            alert('You Reached the limits')
            }
        });
        
        $(wrapper).on("click",".delete", function(e){ 
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
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