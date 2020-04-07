@extends('frontend.layouts.master')

@section('title',__('tr.Update Order'))

@section('cartsactive','current')

@section('stylesheet')

@endsection

@section('content')

@include('frontend.components.breadcrumb')

<!-- - - - - - - - - - - - - - Content - - - - - - - - - - - - - - - - -->

<div id="content" class="page-content-wrap">

    <div class="container wide">
      
      <div class="content-element8">
        
        @include('backend.components.errors')

            <h3 style="text-align:center;">@lang('tr.Update Order')</h3>
            
         <div style="border: 5px solid #f05f792e;padding: 20px;">
            
            <form action="{{ route('frontend_order_update',$order->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        @php($customer = \App\Customer::where('user_id',Auth::user()->id))
                        @if($customer->count() > 0)
                          <input type="hidden" name="customer_id" value="{{ $customer->get()->first()->id }}">
                          @else
                          <div class="row">
                            
                            <div class="col-lg-12">
                              <div class="form-group">
                                  <label for="customer_id" style="font-weight: bold; color: #f05f79;">@lang('tr.Customer')</label>
                                  <select name="customer_id" id="customer_id" class="form-control" required style="width: 100%; color: #999; font-size: 1em; height: 42px; border-bottom: 1px solid #262626; background-color: transparent; text-align: left; -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; -webkit-transition: box-shadow .35s ease, border-color .35s ease; transition: box-shadow .35s ease, border-color .35s ease;">
                                      <option value="">@lang('tr.Select Customer')</option>
                                      @foreach ($customers as $customer)
                                          <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                          </div>
                          <br>
                          @endif
                    </div>
                </div>

                    <br>

                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="company" style="font-weight: bold; color: #f05f79;">@lang('tr.Company')</label>
                                <input type="text" name="company" id="company" class="form-control" value="{{ $order->company }}" placeholder="@lang('tr.Company')">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="address" style="font-weight: bold; color: #f05f79;">@lang('tr.Address')</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $order->address }}" placeholder="@lang('tr.Address')" required>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="no_attendance" style="font-weight: bold; color: #f05f79;">@lang('tr.No. Attendance')</label>
                                <input type="number" min="0" step="1" name="no_attendance" id="no_attendance" class="form-control price" value="{{ $order->no_attendance }}" placeholder="@lang('tr.No. Attendance')">
                            </div>
                        </div>
                    </div>

                    <br>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="order_day" style="font-weight: bold; color: #f05f79;">@lang('tr.Day')</label>
                            <input type="date" name="order_day" id="order_day" class="form-control price" placeholder="@lang('tr.Date')" min="{{ $order->order_day }}"  value="{{ $order->order_day }}" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="order_from" style="font-weight: bold; color: #f05f79;">@lang('tr.From')</label>
                            <input type="time" name="order_from" id="order_from" class="form-control price" placeholder="@lang('tr.From')" value="{{ $order->order_from }}" required>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="order_to" style="font-weight: bold; color: #f05f79;">@lang('tr.To')</label>
                            <input type="time" name="order_to" id="order_to" class="form-control price" placeholder="@lang('tr.To')" value="{{ $order->order_to }}" readonly required>
                        </div>
                    </div>

                </div>

                

                @php($followers = json_decode($order->followers,true))
                @php($count = count($followers) / 3)
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="catalog">@lang('tr.Followers')</label>
                            <div class="row">
                            @for ($i = 0; $i < $count; $i++)
                                <div class="col-lg-4"><div class="form-group"><label for="follow_name">@lang("tr.Follower Name")</label><input type="text" name="follow_name[]" value="{{$followers['follow_name_'.$i.'']}}" id="follow_name" class="form-control" placeholder="@lang("tr.Follower Name")" required></div></div>
                                <div class="col-lg-4"><div class="form-group"><label for="follow_mobile">@lang("tr.Follower Mobile")</label><input type="text" name="follow_mobile[]" value="{{$followers['follow_mobile_'.$i.'']}}" id="follow_mobile" class="form-control" placeholder="@lang("tr.Follower Mobile")" required></div></div>
                                <div class="col-lg-4"><div class="form-group"><label for="follow_email">@lang("tr.Follower Email")</label><input type="email" name="follow_email[]" value="{{$followers['follow_email_'.$i.'']}}" id="follow_email" class="form-control" placeholder="@lang("tr.Follower Email")" required></div></div>
                            @endfor
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <br>
                <div class="row">
                    
                    <div class="col-lg-10">
                        <label style="font-weight: bold; color: #f05f79;">@lang('tr.Followers')</label>
                      </div>

                      <div class="col-lg-2">
                          @php($lang = \App::getLocale())
                          <button class="add_form_field " style="background: transparent; border: 0;"><i class="fa fa-plus-circle" title="@lang('tr.Add Followers')" style="font-size: 20px; color: #f05f79;"></i></button><br>
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

  <!-- - - - - - - - - - - - - end Content - - - - - - - - - - - - - - - -->

@endsection

@section('javascript')

@endsection