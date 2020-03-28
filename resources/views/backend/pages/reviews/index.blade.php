@extends('backend.layouts.master')

@section('reviewsactive','kt-menu__item  kt-menu__item--active')

@section('title',__('tr.reviews'))


@section('stylesheet')

@endsection

@section('content')


    <div class="row">
        <div class="col-xl-12 order-lg-2 order-xl-1">
            <div class="kt-portlet kt-portlet--height-fluid kt-portlet--mobile ">
                <div class="kt-portlet__head kt-portlet__head--lg kt-portlet__head--noborder kt-portlet__head--break-sm">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            @lang('tr.reviews')
                        </h3>
                    </div>

                </div>
                <div class="kt-portlet__body kt-portlet__body--fit">
                    <div class="col-xl-12 order-lg-2 order-xl-1">

                        <table id="example" class="display" style="width:100%;" class="table table-bordered">
                            <thead>
                            <tr>


                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($reviews as $review)
                                <th style="border:1px solid #eee;padding:10px;">id</th>
                                {{--                                <th style="border:1px solid #eee;padding:10px;">order_id</th>--}}
                                <th style="border:1px solid #eee;padding:10px;">rate</th>
                                <th style="border:1px solid #eee;padding:10px;">comment</th>


                                <tr>
                                    <td style="border:1px solid #eee;padding:10px;">{{ $review->id }}</td>
                                    {{--                                <td style="border:1px solid #eee;padding:10px;">{{ $review->order_id }}</td>--}}
                                    <td style="border:1px solid #eee;padding:10px;">{{ $review->rate }}</td>
                                    <td style="border:1px solid #eee;padding:10px;">{{ $review->comment }}</td>

                                </tr>
                            @endforeach

                            </tbody>
                            <tfoot>
                            <tr>

                                <th style="border:1px solid #eee;padding:10px;">id</th>
                                {{--                                <th style="border:1px solid #eee;padding:10px;">order_id</th>--}}
                                <th style="border:1px solid #eee;padding:10px;">rate</th>
                                <th style="border:1px solid #eee;padding:10px;">comment</th>
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