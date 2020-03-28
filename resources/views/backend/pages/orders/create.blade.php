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
                        @lang('tr.Make Order')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('store_orders') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="customer_id">@lang('tr.Customer')</label>
                                <select name="customer_id" id="customer_id" class="form-control" required>
                                    <option value="">@lang('tr.Select Customer')</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="mobile">@lang('tr.Mobile')</label>
                                <p id="customerIdTxt" style="display: block; width: 100%; height: calc(1.5em + 1.3rem + 2px); padding: 0.65rem 1rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #e2e5ec; border-radius: 0; -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out; transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;">
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="company">@lang('tr.Company')</label>
                                <input type="text" name="company" id="company" class="form-control" placeholder="@lang('tr.Company')">
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="address">@lang('tr.Address')</label>
                                <input type="text" name="address" id="address" class="form-control" placeholder="@lang('tr.Address')" required>
                            </div>
                        </div>
                    </div>                    

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="order_day">@lang('tr.Day')</label>
                                <input type="date" name="order_day" id="order_day" class="form-control price" placeholder="@lang('tr.Date')" min="{{ date("Y-m-d") }}"  value="{{ date("Y-m-d") }}" required>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="order_from">@lang('tr.From')</label>
                                <input type="time" name="order_from" id="order_from" class="form-control price" placeholder="@lang('tr.From')" required>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="order_to">@lang('tr.To')</label>
                                <input type="time" name="order_to" id="order_to" class="form-control price" placeholder="@lang('tr.To')" readonly required>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="catalog_id">@lang('tr.Catalog')</label>
                                <select name="catalog_id" id="catalog_id" class="form-control" required>
                                    <option value="">@lang('tr.Select Catalog')</option>
                                    @foreach ($catalogs as $catalog)
                                        <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price">@lang('tr.Price')</label>
                                <p id="catalogIdTxt" style="display: block; width: 100%; height: calc(1.5em + 1.3rem + 2px); padding: 0.65rem 1rem; font-size: 1rem; font-weight: 400; line-height: 1.5; color: #495057; background-color: #fff; background-clip: padding-box; border: 1px solid #e2e5ec; border-radius: 0; -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out; transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;">
                                </p>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="no_attendance">@lang('tr.No. Attendance')</label>
                                <input type="number" value="0" min="0" step="1" name="no_attendance" id="no_attendance" class="form-control price" placeholder="@lang('tr.No. Attendance')">
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="row">
                        
                        <div class="col-lg-10">
                            <h5>@lang('tr.Followers')</h5>
                        </div>

                        <div class="col-lg-2">
                            @php($lang = \App::getLocale())
                            <button class="add_form_field @if($lang == 'ar') pull-left @else pull-right @endif" style="background: transparent; border: 0;"><p style="font-size:13px;background: #db1430;color:white;padding:7px;border-radius:20px;">@lang('tr.Add')</p></button><br>
                        </div>
                        <div class="container1" style="width: 100%; padding: 10px;">
                            
                        </div>

                    </div>

                    
                   
                  
                    
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-save"></i>&nbsp;@lang('tr.Save')
                        </button>
                    </div>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>


    
@endsection

@section('javascript')
<script type="text/javascript">

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