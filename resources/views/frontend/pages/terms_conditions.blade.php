@extends('frontend.layouts.master')

@section('title',__('tr.Terms & Conditions'))

@section('termsconditionsactive','current')

@section('stylesheet')

<link rel="stylesheet" href="{{ asset('frontend/font/linearicons/demo.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/font/fontello/fontello.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/plugins/fancybox/jquery.fancybox.css')}}">

<!-- CSS theme files
============================================ -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-grid.min.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}">
    
@endsection

@section('content')

@include('frontend.components.breadcrumb')


<div class="page-section">      
  <div class="container wide">

    <div class="col-lg-12 col-md-12">

        <div class="content-element4 ">

            <div class="align-center marginBottom">
            <h2 class="title-large style-2">@lang('tr.Make your day is nice from start to end')</h2>
        </div>

    </div>
      <div class="content-element">
        @if(\Lang::locale() == 'ar')
        {!! $system_ar_terms !!}
        @else
        {!! $system_en_terms !!}
        @endif

     </div>
    </div>
    </div>

@endsection

@section('javascript')
  <script src="{{asset('frontend/plugins/instafeed.min.js')}}"></script>
  <script src="{{asset('frontend/plugins/elevatezoom.min.js')}}"></script>
  <script src="{{asset('frontend/plugins/mad.customselect.js')}}"></script>
  <script src="{{asset('frontend/plugins/fancybox/jquery.fancybox.min.js')}}"></script>
  <script src="{{asset('frontend/plugins/jquery.queryloader2.min.js')}}"></script>

  <script>
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


              skillHtml += '<br><a href="#" class="delete btn btn-danger"><i class="fa fa-trash"></i></a></div>'; //add input box


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

@endsection