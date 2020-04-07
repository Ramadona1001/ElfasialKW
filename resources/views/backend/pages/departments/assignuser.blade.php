@extends('backend.layouts.master')

@section('title',__('tr.Assign User'))

@section('departmentsactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Users')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('store_users_departments',$department->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="padding:10px;">
                            @foreach ($users as $user)
                                <div class="col-lg-2" style="padding: 10px; text-align: center; border: 1px dashed;margin-right:5px;margin-left:5px;margin-bottom:5px;">
                                    @if (in_array($user->id,$usersArray))
                                    <input type="checkbox" name="users[]" id="user_{{$user->id}}" value="{{ $user->id }}" checked>
                                    @else
                                    <input type="checkbox" name="users[]" id="user_{{$user->id}}" value="{{ $user->id }}">
                                    @endif
                                    <label for="user_{{$user->id}}">{{$user->name}}</label>
                                </div>
                                @endforeach
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

@endsection