@extends('backend.layouts.master')

@section('title',__('tr.All Users'))

@section('usersactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.All Users')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @can('create_users')
                    <a href="{{ route('create_users') }}" class="btn btn-primary">@lang('tr.Create New Users')</a>
                    @endcan
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="col-xl-12 order-lg-2 order-xl-1">
                    
                    <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                        <thead>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Email')</th>
                                <th class="tdesign">@lang('tr.Mobile')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                            {{-- @if(!$user->hasRole('Admin')) --}}
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign">{{ $user->name }}</td>
                                <td class="tdesign">{{ $user->email }}</td>
                                <td class="tdesign">{{ $user->mobile }}</td>
                               
                                <td class="tdesign">
                                    
                                    @can('show_users')
                                    <a href="{{ route('show_users',$user->id) }}" class="pinkbutton">@lang('tr.View')</a>&nbsp;
                                    @endcan

                                    @can('edit_users')
                                    <a href="{{ route('edit_users',$user->id) }}" class="bluebutton" >@lang('tr.Edit')</a>&nbsp;
                                    @endcan

                                    @can('delete_users')
                                    <a onclick="return confirm('Are You Sure ?')"  class="redbutton" href="{{ route('delete_users',$user->id) }}">@lang('tr.Delete')</a>&nbsp;
                                    @endcan

                                    
                                    @can('permission_users')
                                    <a class="purplebutton" href="{{ route('permissions_users',$user->id) }}">@lang('tr.Permissions')</a>&nbsp;
                                    @endcan

                                    @can('department_users')
                                    
                                    @endcan
                                </td>
                            </tr>
                            {{-- @endif --}}
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Email')</th>
                                <th class="tdesign">@lang('tr.Mobile')</th>
                                <th class="tdesign">@lang('tr.Action')</th>
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
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        $('.btnDep').click(function() {
            var $this = $(this);
            var user_id = $(this).data('user_id');
            $('.user_id').val(user_id);
            $this.parents('tr').prev().css("background-color", "yellow");

        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({ responsive: true });
    } );
</script>
@endsection