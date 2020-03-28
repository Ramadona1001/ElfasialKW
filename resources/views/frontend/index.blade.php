@extends('frontend.layouts.master')

@section('title',__('tr.Home'))

@section('homeactive','current')

@section('stylesheet')
<link href="{{ asset('frontend/rate/jquery.rateyo.css') }}" rel="stylesheet">

@endsection

@section('content')


    @include('frontend.components.slider')
        
    @include('frontend.components.second-menu')

    @include('frontend.components.first-services')

    @include('frontend.components.second-services')

    @include('frontend.components.achives')

    
@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="{{ asset('frontend/rate/jquery.rateyo.js') }}"></script>
@if(isset(Auth::user()->id) != null)
@if(\App\Order::reviewOrder(Auth::user()->id) != null)

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

(async () => {

const { value: formValues } = await Swal.fire({
  title: "{{__('tr.Rate Order')}}",
  html:
    '<div style="display:inline-block;" id="rateYo"></div>'+
    '<input type="hidden" name="rating" class="swal-input2" id="rating_input"/>'+
    '<input type="hidden" name="order_id" id="order_id" value="{{ \App\Order::reviewOrder(Auth::user()->id) }}"/>'+
    '<input id="swal-input1" class="swal2-input" placeholder="@lang("tr.Comment")">',
  focusConfirm: false,
  preConfirm: () => {
    return [
      document.getElementById('swal-input1').value,
      document.getElementById('rating_input').value
    ]
  }
})

if (formValues) {
    var orderdata = $('#order_id').val();
    $.ajax({
        type:'GET',
        url:'{{ route("frontend_order_rate")}}',
        data:{rates:formValues,order:orderdata},
        success:function(data){
            //alert(data.success);
        }
    });
  Swal.fire('{{ __("tr.Thanks For Rating") }}')
}

})()
</script>
@endif
@endif

<script>
$(function () {
     
     $("#rateYo").rateYo({
    
       onSet: function (rating, rateYoInstance) {
          rating = Math.ceil(rating);
          $('#rating_input').val(rating);//setting up rating value to hidden field
          
       }
     });
   });
</script>

@endsection