@extends('backend.layouts.master')

@section('permissionsactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.Create New Permissions'))
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Add New Permissions')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('update_permissions',$permission->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">@lang('tr.Name')</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}" placeholder="@lang('tr.Enter Permissions Name')" required>
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