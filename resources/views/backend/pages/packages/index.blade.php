@extends('backend.layouts.master')

@section('title',__('tr.Packages'))

@section('packagesactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    <style>
    .nav-pills .nav-item .nav-link:active, .nav-pills .nav-item .nav-link.active, .nav-pills .nav-item .nav-link.active:hover{
        background-color: #f05f78;
    }
    </style>
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.Packages')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @can('create_packages')
                    <a href="{{ route('create_packages') }}" class="btn btn-primary">@lang('tr.Create New Packages')</a>
                    @endcan
                </div>
            </div>

            <div style="padding:10px;">
                <div class="row">
                    @foreach ($categories as $cat)
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body" style="color: #f05f78; text-align: center; border: 1px dashed; font-size: 20px; font-weight: bold;">
                                @php($category = \App\Package::category($cat))
                                {{ $category->name }}
                                <hr>
                                @can('show_packages')
                                    <a href="{{ route('show_packages',$cat) }}" class="bluebutton" style="font-size:12px;font-weight:normal;">@lang('tr.View')</a>
                                @endcan
                                
                                @can('delete_packages')
                                <a href="{{ route('delete_packages',$cat) }}" class="bluebutton" onclick="return confirm('@lang('tr.Are you sure?')')" style="font-size:12px;font-weight:normal;">@lang('tr.Delete')</a>
                                @endcan
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
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
    $(document).ready(function() {
        $('#example').DataTable({responsive:true});
    } );
</script>
@endsection