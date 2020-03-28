@extends('backend.layouts.master')

@section('title',__('tr.All Roles'))
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.All Roles')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <a href="{{ route('create_roles') }}" target="_blank" class="btn btn-primary">@lang('tr.Create New Role')</a>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    
                    <table id="example" class="display" style="width:100%;" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="border:1px solid #eee;padding:10px;">#</th>
                                <th style="border:1px solid #eee;padding:10px;">@lang('tr.Name')</th>
                                <th style="border:1px solid #eee;padding:10px;">@lang('tr.Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $index => $role)
                            <tr>
                                <td style="border:1px solid #eee;padding:10px;">{{ $index+1 }}</td>
                                <td style="border:1px solid #eee;padding:10px;">{{ $role->name }}</td>
                                <td style="border:1px solid #eee;padding:10px;">
                                    <a href="{{ route('show_roles',$role->id) }}"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a href="{{ route('edit_roles',$role->id) }}"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                    <a onclick="return confirm('Are You Sure ?')" href="{{ route('delete_roles',$role->id) }}"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="border:1px solid #eee;padding:10px;">#</th>
                                <th style="border:1px solid #eee;padding:10px;">@lang('tr.Name')</th>
                                <th style="border:1px solid #eee;padding:10px;">@lang('tr.Action')</th>
                            </tr>
                        </tfoot>
                    </table>
                    
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