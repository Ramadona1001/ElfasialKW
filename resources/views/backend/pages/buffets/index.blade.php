@extends('backend.layouts.master')

@section('title',__('tr.Buffets'))

@section('buffetssactive','kt-menu__item  kt-menu__item--active')
    
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
                        @lang('tr.Buffets')
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    @can('create_buffets')
                    <a href="{{ route('create_buffets') }}" class="btn btn-primary">@lang('tr.Create New Buffets')</a>
                    @endcan
                </div>
            </div>

            <div style="padding:10px;">
                <div class="row">
                    @foreach ($categories as $cat)

                    <div class="col-lg-3">
                        <div class="card">
                            <img class="card-img-top" src="{{ URL::to('/buffet.jpg') }}">
                            @php($category = \App\Package::category($cat))
                            <div class="card-body">
                              <h5 class="card-title">{{ $category->name }}</h5>
                              
                              <hr>
                               

                                @can('show_buffets')
                                <a href="{{ route('show_buffets',$cat) }}" class="pinkbutton">@lang('tr.View')</a>&nbsp;
                                @endcan

                                

                                @can('delete_buffets')
                                <a onclick="return confirm('Are You Sure ?')" class="pinkbutton" href="{{ route('delete_buffets',$cat) }}">@lang('tr.Delete')</a>
                                @endcan

                            </div>
                          </div>
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