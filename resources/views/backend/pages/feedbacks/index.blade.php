@extends('backend.layouts.master')

@section('title',__('tr.Feedback'))

@section('feedbacksactive','kt-menu__item  kt-menu__item--active')


@section('stylesheet')

@endsection

@section('content')


    <div class="row">
        <div class="col-xl-12 order-lg-2 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
                <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                          @lang('tr.Feedback')
                        </h3>
                    </div>

                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="col-xl-12 order-lg-2 order-xl-1">

                        <table id="example" class="display" style="width:100%;" class="table table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Email')</th>
                                <th class="tdesign">@lang('tr.Comment')</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($feedback as $data)
                            

                            <tr>
                                    <td class="tdesign">{{ $data->name }}</td>
                                    <td class="tdesign">{{ $data->email }}</td>
                                    <td class="tdesign">{{ $data->comment }}</td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>

                            <th class="tdesign">@lang('tr.Name')</th>
                                <th class="tdesign">@lang('tr.Email')</th>
                                <th class="tdesign">@lang('tr.Comment')</th>

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