@extends('backend.layouts.master')

@section('usersactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.All Permissions'))
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.All Permissions')
                    </h3>
                </div>
                <form action="{{ route('assign_permissions_users') }}" method="post">
                <div class="kt-portlet__head-toolbar">
                    <button type="submit" class="btn btn-primary" style="margin-top:10px;">@lang('tr.Save')</button>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        @foreach ($permissions_array as $permission)
                        <div style="padding: 10px; border: 2px solid #eee;margin-bottom:10px;">
                        <h4>{{ ucfirst($permission) }}&nbsp;@lang('tr.Permissions')</h4><br>
                            <div class="row">
                            @foreach ($permissions as $p)
                                @if(explode('_',$p->name)[1] == $permission)
                                    <div class="col-lg-2">
                                        <div class="form-group" style="background: #eeeeee54; padding: 10px; text-align: center; color: black; font-weight: bold; border: 2px solid #eee;">
                                            @if(in_array($p->id,$permissions_users))
                                            <input type="checkbox" name="permissions[]" checked value="{{ $p->id }}" id="{{ $p->id }}">
                                            @else
                                            <input type="checkbox" name="permissions[]" value="{{ $p->id }}" id="{{ $p->id }}">
                                            @endif
                                            <label for="{{ $p->id }}">{{ ucwords(str_replace('_',' ',$p->name)) }}</label>
                                        </div>
                                    </div>
                                    @endif
                            @endforeach
                            </div>
                        </div>
                        <hr>
                        @endforeach

                    </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>
@endsection