@extends('backend.layouts.master')

@section('title',__('tr.Orders'))

@section('ordersactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Invoice')
                    </h3>
                    
                    
                </div>
                
                
            </div>
            
            <div class="row" style="padding:20px;">
                <div class="col-lg-12">
                    @lang('tr.Contracts'):&nbsp;
                    @php($langName = \Lang::getLocale().'_name')
                    <select name="contract" class="form-control selectContract" id="">
                        <option value="">@lang('tr.Select Contract')</option>
                        @foreach ($contracts as $contract)
                            <option value="{{ $contract->id }}">{{ $contract->$langName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="kt-portlet__body kt-portlet__body--fit" style="padding:20px;" id="printJS-form">
                <div id="printInvoice">
                <div class="col-xl-12 order-lg-2 order-xl-1" style="padding:20px;border: 2px solid #eee;">
                   
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 style="font-weight:bold;text-transform: uppercase;margin-bottom:15px;">@lang('tr.Invoice')</h2>
                            <h4>{{ $orders->order_code }}</h4>
                            <h4>@lang('tr.Customer'): {{ $customer->mobile }}</h4>
                        </div>
                        <div class="col-lg-3">
                            <h3>
                                @php($lang = \App::getLocale())
                                <img alt="Logo" style="width: 200px;" class="@if($lang == 'ar') pull-left @else pull-right @endif" src="{{ asset('logo/'.$system_logo) }}">
                            </h3>
                        </div>
                    </div>

                    <br>
                    <hr>

                    <div class="row">
                        <div class="col-lg-12" id="contractData">

                        </div>
                    </div>

                    <hr>
                    
                    <div class="row" style="padding:25px;">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="text-transform: uppercase;color:#74788d;">@lang('tr.Name')</th>
                                        <th style="text-transform: uppercase;color:#74788d;">@lang('tr.Quantity')</th>
                                        <th style="text-transform: uppercase;color:#74788d;">@lang('tr.Price')</th>
                                        <th style="text-transform: uppercase;color:#74788d;">@lang('tr.Total')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($order_data = json_decode($orders->order_data,true))
                                    @php($count = count($order_data) / 4)

                                    @for ($i = 0; $i < $count; $i++)
                                        @php($title = 'title_'.$i)
                                        @php($quantity = 'quantity_'.$i)
                                        @php($total = 'total_'.$i)

                                        <tr>
                                            <td style="color:#595d6e;font-weight:bold;">{{ $order_data[$title] }}</td>
                                            <td style="color:#595d6e;font-weight:bold;">{{ $order_data[$quantity] }}</td>
                                            <td style="color:#595d6e;font-weight:bold;">{{ $order_data[$total] / $order_data[$quantity].' '.$system_currency }}</td>
                                            <td style="color:#595d6e;font-weight:bold;">{{ $order_data[$total].' '.$system_currency }}</td>
                                        </tr>
                                    @endfor
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="row" style="padding:25px;background:#efefef47;">
                        <div class="col-lg-4" style="text-align:center;">
                            <h5 style="text-transform: uppercase;color:#74788d;">@lang('tr.Day')</h5><hr>
                            <h4 style="font-weight:bold;">{{ $orders->order_day }}</h4>
                        </div>
                        <div class="col-lg-4" style="text-align:center;">
                            <h5 style="text-transform: uppercase;color:#74788d;">@lang('tr.From')</h5><hr>
                            <h4 style="font-weight:bold;">{{ $orders->order_from }}</h4>
                        </div>
                        <div class="col-lg-4" style="text-align:center;">
                            <h5 style="text-transform: uppercase;color:#74788d;">@lang('tr.To')</h5><hr>
                            <h4 style="font-weight:bold;">{{ $orders->order_to }}</h4>
                        </div>
                        
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-6">
                            <h4 style="border-bottom: 1px dashed; display: block; padding: 11px; width: 32%; margin-bottom: 45px;">@lang('tr.Customer Signature')</h4>                    
                        </div>
                        <div class="col-lg-6">
                            @if (\Lang::getLocale() == 'ar')
                            <h4 style="float:left;border-bottom: 1px dashed; display: block; padding: 11px; width: 32%; margin-bottom: 45px;">@lang('tr.Company Signature')</h4>
                            @else
                            <h4 style="float:right;border-bottom: 1px dashed; display: block; padding: 11px; width: 32%; margin-bottom: 45px;">@lang('tr.Company Signature')</h4>
                            @endif
                        </div>
                    </div>

                </div>
                    
                    
                </div>
            </div>

            <br>
                    <div class="row" style="padding:25px;">
                        <a  style ="color: white;" onclick="printJS({ printable: 'printJS-form', type: 'html', header: '@lang('tr.Invoice')' })" class="btn btn-primary"><i class="fa fa-print"></i>&nbsp; Print</a>
                    </div>
                   
                    <hr>
                    <br>
                    <h6 style="text-align:center;">
                        

                        @can('delete_orders')
                        <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_orders',$orders->id) }}">@lang('tr.Delete')</a>
                        @endcan
                    </h6>

                    <br>
        </div>
    </div>
</div>


    
@endsection

@section('javascript')



<script>
    jQuery(document).ready(function(){
        $('.selectContract').on('change',function(){
            if($(this).val() != ''){
                var contractURL = '{{ route("contractsTerms",["id"=>"#id"]) }}';
                contractURL = contractURL.replace('#id',$(this).val());
                var contractData = '';
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: contractURL,
                  method: 'get',
                  
                  success: function(result){
                      var checkLang = '{{ \Lang::getLocale() }}';
                      contractData += '<h3>@lang("tr.Contracts")</h3>';
                      if (checkLang == 'en') {
                        contractData += '<p style="font-size:15px;">'+result.items.en_content+'</p>';
                      }else{
                        contractData += '<p style="font-size:15px;">'+result.items.ar_content+'</p>';
                      }
                      
                      contractData += '<br>';
                      if(result.terms.length > 0){
                        contractData += '<br>';
                        contractData += '<h3>@lang("tr.All Terms")</h3>';
                        contractData += '<ul>';
                        $.each(result.terms , function(index,value){
                            if (checkLang == 'en') {
                                contractData += '<li style="font-size:12px;">'+result.terms[index].en_desc+'</li>';
                            }else{
                                contractData += '<li style="font-size:12px;">'+result.terms[index].ar_desc+'</li>';
                            }
                        });
                        contractData += '</ul>';
                    }
                    $('#contractData').html(contractData);
                  }});
            }
        });
            });
</script>

<script>
function PrintElem(elem)
{
    window.print();

    return true;
}
</script>

@endsection