<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
<title> {{ $order->order_code }} | @lang('tr.Invoice')</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <link  href="{{ asset('frontend/print/TheSansArabic-Light.otf')}}"></link>

<style>
  /* *{
    font-family: TheSansArabic-Light;
  } */
#invoice{
  padding: 20px 25px 10px 25px;
    margin: 11px;
    /* background: rgba(213, 204, 204, 0.16); */
    background: #fff;
    box-shadow: 1px -1px 3px 4px rgba(178, 165, 165, 0.08), 0 1px 2px rgba(182, 172, 172, 0.14);
}
.btn-info {
    color: #fff;
    background-color: #dc3545 !important;
    border-color: #bd2130 !important;
    /* border: 0;
    padding: 13px 30px;
    border-radius: 5px; */
}
hr{
  border-top: 1px solid rgba(220, 53, 69, 0.35) !important
}
.toolbar{
  padding: 15px 25px 0 12px;
}
.invoice {
    position: relative;
    /* background-color: #FFF; */
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #dc3545 
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
  margin-top: 5px;
    margin-bottom: 5px;
    font-size: 22px;
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
      text-align: left;
    float: left;
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #dc3545
}
.signuture{
    font-size: 27px;
    font-family: unset;
    font-weight: 600;
    color: #0062cc;
}
.signuture-logo{
  width: 90px;
  margin-top: 20px;
  margin-right: 30px;
  margin-left: 30px;
}
.invoice main {
  padding-bottom: 8px;
}

.invoice footer .thanks {
    margin-top: 10px;
    font-size: 1em;
    margin-bottom: 10px;
    text-align: right;
}

.invoice footer .notices {
    padding-right: 16px;
    border-right: 6px solid #dc3545;
    direction: rtl;
    text-align: right;
}

.invoice footer .notices .notice {
  font-size: 11px;
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px ;
    direction: rtl;
    text-align: right;
}
.invoice table th {
    padding: 15px;
    background: #eeeeee75;
    color: #dc3545;
    border-bottom: 1px solid #f8f9fa;
    font-weight: 500 !important;
}
.invoice table td {
    padding: 25px 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #dc3545
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #dc3545;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #dc3545;
    font-size: 1.4em;
    border-top: 1px solid #dc3545
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}
.logo{
  width: 195px;
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden !important

    }
    .hidden-print{
      display: none;
    }

    /* .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    } */
}

.logo_div{
float: right;
text-align: right;
}
.header_dive{
  display: flow-root;
}
</style>

</head>
<body>
<!-- partial:index.partial.html -->

  <div id="invoice">

  
      <div class="toolbar hidden-print">
        <div class="text-left">
            <button id="printInvoice" class="btn btn-info">@lang('tr.Print') </button>
        </div>
      </div>


    <div id="content">
    <div class="invoice">

      {{-- <div class="toolbar hidden-print">
        <div class="text-left">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> طباعة </button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i>  ملف pdf </button>
        </div>
    </div> --}}
    
        <div style="min-width: 600px">
            <header class="header">
                <div class="row header_dive">
                    <div class="col-4 logo_div">
                        <a target="_blank" href="#">
                            <img class="logo" src="{{ asset('logo/'.$system_logo) }}" data-holder-rendered="true" />
                            </a>
                            <p>{{ $system_email }}</p>
                            <p>{{ $system_mobile }}</p>
                    </div>
                    <div class="col-8 invoice-details">
                      <h1 class="invoice-id"> ( {{ $order->order_code }} )  <small> @lang('tr.Order Code') </small>  </h1>
                      <div class="date">  @lang('tr.Order Date') : {{ $order->order_day }}</div>
                      
                  </div>

                </div>
            </header>
        </div>

            <main>
                <div class="row contacts">
                  <div class="col-6 invoice-to">
                    <div class="text-gray-light">  @lang('tr.Invoice') @lang('tr.To') </div>
                    <h2 class="name">
                      <a target="_blank" href="#"> {{ $order->customer->name }}
                        </a>
                      </h2>
                    <div class="address">@lang('tr.Address') {{ $order->address }}</div>
                    <div>@lang('tr.Mobile')  {{ $order->customer->mobile }}  </div>
                    <div class="email"><a href="{{ $order->customer->email }}"> {{ $order->customer->email }} </a></div>
                </div>
                  <div class="col-6 company-details">
                    <div class="text-gray-light">  @lang('tr.Invoice') @lang('tr.From') </div>
                    <h2 class="name">
                        <a target="_blank" href="#">
                       {{ $system_title }} | @lang('tr.Wedding Planner')
                        </a>
                    </h2>
                </div>
                
                </div>
                <table  cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-right"> @lang('tr.Item')  </th>
                            <th class="text-right">  @lang('tr.Quantity')  </th>
                            <th class="text-right">  @lang('tr.Price')  </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($total = 0)
                        @php($order_data = json_decode($order->order_data,true))
                        @php($count = count($order_data) / 4)

                        @for ($i = 0; $i < $count; $i++)
                        @php($title = 'title_'.$i)
                        @php($quantity = 'quantity_'.$i)
                        @php($price = 'total_'.$i)
                        <tr>
                            <td class="no">{{ $i+1 }}</td>
                            <td class="text-right">
                              <h3>
                                <a target="_blank" href="#">{{ $order_data[$title] }}</a>
                              </h3>
                            </td>
                            <td class="unit">{{ $order_data[$quantity] }}</td>
                            <td class="unit">{{ $order_data[$price] }}</td>
                            @php($total = $total + $order_data[$price])
                        </tr>
                        @endfor
                        
                      
                    </tbody>
                    <tfoot>
                        
                        <tr>
                            <td colspan="3"> @lang('tr.Total') </td>
                            <td>{{ $total }}</td>
                        </tr>
                    </tfoot>
                </table>

                <div class="row contacts">

                  <div class="col-6 invoice-to">
                    <div class="text-gray-light text-left signuture"> @lang('tr.Customer Signature') </div>
                    <h2 class="name">
                      
                    
                      </h2>
                  </div>

                  <div class="col-6 company-details">
                    <div class="text-gray-light text-right signuture"> @lang('tr.Company Signature')  </div>
                    <h2 class="name">
                      
               
                      </h2>
                  </div>

                </div>


             
            </main>

            <footer>
         
              <div class="thanks">  @lang('tr.Thank You') </div>
              <div class="notices">
               
           </div>
            </footer>

        </div>
     <div>



  </div>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js'></script>
<script  src="{{ asset('frontend/print/script.js')}}"></script>

</body>
</html>
