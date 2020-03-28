@extends('backend.layouts.master')

@section('title',__('tr.Terms'))

@section('termsactive','kt-menu__item  kt-menu__item--active')
    
@section('stylesheet')
    
@endsection

@section('content')
    

<div class="row">
    <div class="col-xl-12 order-lg-2 order-xl-1">
        <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
            <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        @lang('tr.All Terms')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @can('create_contracts')
                    <a href="{{ route('terms_create') }}" class="btn btn-primary">@lang('tr.Create New Terms')</a>
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
                                <th class="tdesign">@lang('tr.Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($terms as $index => $term)
                            <tr>
                                <td class="tdesign">{{ $index+1 }}</td>
                                <td class="tdesign">{{ $term->name }}</td>
                                <td class="ttdesign">
                                    
                                    @can('show_contracts')
                                    <a href="{{ route('terms_show',$term->id) }}" class="pinkbutton">@lang('tr.View')</a>&nbsp;
                                    @endcan

                                    @can('edit_contracts')
                                    <a href="{{ route('terms_edit',$term->id) }}" class="bluebutton">@lang('tr.Edit')</a>&nbsp;
                                    @endcan

                                    @can('delete_contracts')
                                    <a onclick="return confirm('Are You Sure ?')" class="redbutton" href="{{ route('terms_destroy',$term->id) }}">@lang('tr.Delete')</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="tdesign">#</th>
                                <th class="tdesign">@lang('tr.Name')</th>
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
    $(document).ready(function() {
        $('#example').DataTable({responsive:true});
    } );
</script>
@endsection