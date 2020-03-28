@extends('backend.layouts.master')

@section('title',__('tr.Show Customer'))

@section('customersactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Show Customer')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            <p>@lang('tr.Customer Name')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $customer->name }}</p>
                        </div>
                        <div class="col-lg-6">
                            <p>@lang('tr.Customer Email')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $customer->email }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <p>@lang('tr.Customer Mobile')</p>
                            <p style="background: #eee; padding: 10px; color: black;">{{ $customer->mobile }}</p>
                        </div>
                        
                    </div>

                  
                    <hr>

                    @if($userfiles != null)
                    <div class="row">
                        <div class="col-lg-12">
                            <p style="text-align: center; margin-bottom: 20px; font-size: 24px; color: #201f2b; font-weight: bold;">@lang('tr.Customer Files')</p>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($userfiles as $userfile)
                            <div class="col-lg-6">
                                <p>@lang('tr.File Name')</p>
                                <p style="background: #eee; padding: 10px; color: black;">{{ $userfile->file_name }}</p>
                            </div>

                            <div class="col-lg-6">
                                <p>@lang('tr.File')</p>
                                <p style="background: #eee; padding: 10px; color: black;"><a href="{{ asset('users/files/'.$userfile->file_path) }}" target="_blank"><i class="fa fa-file-download"></i>&nbsp; @lang('tr.View')</a></p>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    
                    <hr>
                    <br>
                    <h6 style="text-align:center;">
                        <a href="{{ route('show_customers',$customer->id) }}" style="background: orange; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.View')</a>&nbsp;
                        <a href="{{ route('edit_customers',$customer->id) }}" style="background: purple; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;">@lang('tr.Edit')</a>&nbsp;
                        <a onclick="return confirm('Are You Sure ?')" style="background: red; padding: 5px 10px 5px 10px; border-radius: 20px; color: white;" href="{{ route('delete_customers',$customer->id) }}">@lang('tr.Delete')</a>
                    </h6>

                    <br>
                    
                </div>
            </div>
        </div>
    </div>
</div>


    
@endsection

@section('javascript')
    

@endsection