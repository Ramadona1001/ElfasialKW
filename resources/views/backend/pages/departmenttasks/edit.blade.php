@extends('backend.layouts.master')

@section('title',__('tr.Update Task'))

@section('departmenttasksactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')


<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Update Task')
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                  
                    @include('backend.components.errors')
                   
                <form action="{{ route('update_department_tasks',$departmentTask->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="en_name">@lang('tr.English Name')</label>
                                <input type="text" name="en_name" id="name" class="form-control" placeholder="@lang('tr.Enter English Name')" value="{{ $departmentTask->en_name }}" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ar_name">@lang('tr.Arabic Name')</label>
                                <input type="text" name="ar_name" id="ar_name" class="form-control" placeholder="@lang('tr.Enter Arabic Name')" value="{{ $departmentTask->ar_name }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="en_desc">@lang('tr.English Descriptions')</label>
                                <textarea name="en_desc" id="en_desc" cols="30" rows="10" class="form-control" placeholder="@lang('tr.Enter English Descriptions')" required>{{ $departmentTask->en_desc }}</textarea>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ar_desc">@lang('tr.Arabic Descriptions')</label>
                                <textarea name="ar_desc" id="ar_desc" cols="30" rows="10" class="form-control" placeholder="@lang('tr.Enter Arabic Descriptions')" required>{{ $departmentTask->ar_desc }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="department_id">@lang('tr.Department')</label>
                                <select name="department_id" id="department_id" class="form-control" required>
                                    <option value="">@lang('tr.Select Department')</option>
                                    @foreach ($departments as $department)
                                    @if($departmentTask->department_id == $department->id)
                                    <option value="{{ $department->id }}" selected>{{ $department->name }}</option>
                                    @else
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
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



@endsection