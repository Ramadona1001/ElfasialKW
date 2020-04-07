<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('backend/signature/jquery.signaturepad.css') }}">
    <title>@lang('tr.Print')</title>
  </head>
  <body>
    @php($langName = \Lang::getLocale().'_name')
    @php($langDesc = \Lang::getLocale().'_content')
    <br>
    <div class="container" style="padding: 10px; border: 1px dotted gainsboro;">
        <img src="{{ URL::to('/') }}/logo/{{ $system_logo }}" alt="" srcset="" style="width: 10%; display: block; margin-left: auto">
        <h3 style="text-align: center; margin-top: 20px;">{{ $orders->code }}</h3>
        <hr>
        <div class="row" style="padding: 10px; border: 1px dashed; width: 100%; margin-left: auto; margin-right: auto;">
            <div class="col-lg-6">
                <h5>@lang('tr.Code'): {{ $orders->code }}</h5>
            </div>
            <div class="col-lg-6">
                <h5 style="float:right;">@lang('tr.User'): {{ $orders->user_phone }}</h5>
            </div>
            <div class="col-lg-6">
                <h5>@lang('tr.Quantity'): {{ $orders->quantity }}</h5>
            </div>
            <div class="col-lg-6">
                <h5 style="float:right;">@lang('tr.Price'): {{ $orders->price.' '.$system_currency }}</h5>
            </div>
            <div class="col-lg-6">
                <h5>@lang('tr.Address'): {{ $orders->address }}</h5>
            </div>
            <div class="col-lg-6">
                <h5 style="float:right;">@lang('tr.Day / Time'): {{ $orders->order_day }}</h5>
            </div>
        </div>
        <hr>
        <div style="box-shadow: 1px 1px 1px 1px #0000001a; padding: 5px;">
            {!! $contracts->$langDesc !!}
            @if ($terms != null)
                <ul>
                    @foreach ($terms as $term)
                        <li>{!! $term->terms($term->terms_id)->desc !!}</li>
                    @endforeach
                </ul>
            @endif
        </div>
        <hr>
        <table class="table table-bordered" style="width:100%;" class="table table-bordered dt-responsive">
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
                @if ($data->mainorder_id == $orders->id)
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
            
        </table>
        <hr>
        <h4>@lang('tr.Total'): {{ $orders->price.' '.$system_currency }}</h4>
        <hr>
               <div class="row">
                <div class="col-lg-6">
                    <h6 style="font-weight: bold;margin:bottom:10px;">@lang('tr.Company Signature')</h6>
                    <form class="sigPad" method="post" >
                        
                        <div class="sig sigWrapper">
                          <div class="typed"></div>
                          <canvas class="pad" width="198" height="55"></canvas>
                          <input type="hidden" name="output" class="output">
                        </div>
                  </form>
                  
                   </div>
                    <div class="col-lg-6">
                        <h6 style="font-weight:bold;margin:bottom:10px;text-align:right">@lang('tr.Client Signature')</h6>
                    <form class="sigPad" method="post" style="margin-left:auto;">
                        
                          <div class="sig sigWrapper">
                            <div class="typed"></div>
                            <canvas class="pad" width="198" height="55"></canvas>
                            <input type="hidden" name="output" class="output">
                          </div>
                    </form>
                    </div>
               </div>
                
                
            
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/signature/jquery.signaturepad.js') }}"></script>
    <script src="{{ asset('backend/signature/json2.min.js') }}"></script>
    <script>
        $(document).ready(function() {
          $('.sigPad').signaturePad({drawOnly:true});
        });
      </script>
    <script>
        // window.print();
    </script>
  </body>
</html>