@extends('frontend.layouts.master')

@section('title',__('tr.portfolio'))

@section('portfoliosactive','current')

@section('stylesheet')

@endsection

@section('content')

    @include('frontend.components.breadcrumb')


    <!-- - - - - - - - - - - - - - Content - - - - - - - - - - - - - - - - -->

    <div id="content" class="page-content-wrap">

        <div class="container wide">

            <div id="options">

                <div id="filters" class="isotope-nav">
                    <button class="is-checked" data-filter="*">All</button>
                    <button data-filter=".category_2">Weddings</button>
                    <button data-filter=".category_3">birthday</button>
                    <button data-filter=".category_4">Parties</button>
{{--                    <button data-filter=".category_5">Florals</button>--}}
{{--                    <button data-filter=".category_6">Stationery</button>--}}
                </div>

            </div>

            <div class="isotope grid event-box three-collumn" data-isotope-options='{"itemSelector" : ".item","layoutMode" : "fitRows","transitionDuration":"0.7s","fitRows" : {"columnWidth":".item"}}'>

                <!-- isotope item -->
                <div class="item category_4">

                    <div class="event">

                        <img src="{{asset('frontend/images/party2.jpg')}}" alt="">





                        <div class="event-body-wrap">

                            <a href="#" class="overlink"></a>

                            <div class="event-body">

                                <h3 class="event-title"><a href="#">Sara &amp; Patrick</a></h3>
                                <a href="#" class="event-cat">weddings</a>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- isotope item -->
                <div class="item category_2">

                    <div class="event">

                        <img src="{{asset('frontend/images/wedding1.jpg')}}" alt="">

                        <div class="event-body-wrap">

                            <a href="#" class="overlink"></a>

                            <div class="event-body">

                                <h3 class="event-title"><a href="#">Donec In Velit Vel</a></h3>
                                <a href="#" class="event-cat">Parties</a>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- isotope item -->
                <div class="item category_3">

                    <div class="event">

                        <img src="{{asset('frontend/images/birthday3.jpg')}}" alt="">

                        <div class="event-body-wrap">

                            <a href="#" class="overlink"></a>

                            <div class="event-body">

                                <h3 class="event-title"><a href="#">Ipsum Auctor Pulvinar</a></h3>
                                <a href="#" class="event-cat">Corporate</a>

                            </div>

                        </div>

                    </div>

                </div>

{{--                <!-- isotope item -->--}}
{{--                <div class="item category_5">--}}

{{--                    <div class="event">--}}

{{--                        <img src="{{asset('frontend/images/430x336_img8.jpg')}}" alt="">--}}

{{--                        <div class="event-body-wrap">--}}

{{--                            <a href="#" class="overlink"></a>--}}

{{--                            <div class="event-body">--}}

{{--                                <h3 class="event-title"><a href="#">Vestibulum Iaculis</a></h3>--}}
{{--                                <a href="#" class="event-cat">Florals</a>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

{{--                <!-- isotope item -->--}}
{{--                <div class="item category_6">--}}

{{--                    <div class="event">--}}

{{--                        <img src="{{asset('frontend/images/430x336_img11.jpg')}}" alt="">--}}

{{--                        <div class="event-body-wrap">--}}

{{--                            <a href="#" class="overlink"></a>--}}

{{--                            <div class="event-body">--}}

{{--                                <h3 class="event-title"><a href="#">Ut Pharetra Augue</a></h3>--}}
{{--                                <a href="#" class="event-cat">Stationery</a>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

                <!-- isotope item -->
                <div class="item category_4">

                    <div class="event">

                        <img src="{{asset('frontend/images/party1.jpg')}}" alt="">

                        <div class="event-body-wrap">

                            <a href="#" class="overlink"></a>

                            <div class="event-body">

                                <h3 class="event-title"><a href="#">Sed Laoreet Aliquam</a></h3>
                                <a href="#" class="event-cat">weddings</a>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- isotope item -->
                <div class="item category_3">

                    <div class="event">

                        <img src="{{asset('frontend/images/birthday4.jpg')}}" alt="">

                        <div class="event-body-wrap">

                            <a href="#" class="overlink"></a>

                            <div class="event-body">

                                <h3 class="event-title"><a href="#">Sed Laoreet Aliquam</a></h3>
                                <a href="#" class="event-cat">Corporate</a>

                            </div>

                        </div>

                    </div>

                </div>

{{--                <!-- isotope item -->--}}
{{--                <div class="item category_5">--}}

{{--                    <div class="event">--}}

{{--                        <img src="{{asset('frontend/images/430x336_img14.jpg')}}" alt="">--}}

{{--                        <div class="event-body-wrap">--}}

{{--                            <a href="#" class="overlink"></a>--}}

{{--                            <div class="event-body">--}}

{{--                                <h3 class="event-title"><a href="#">Sed Laoreet Aliquam</a></h3>--}}
{{--                                <a href="#" class="event-cat">Florals</a>--}}

{{--                            </div>--}}

{{--                        </div>--}}

{{--                    </div>--}}

{{--                </div>--}}

                <!-- isotope item -->
                <div class="item category_2">

                    <div class="event">

                        <img src="{{asset('frontend/images/wedding3.jpg')}}" alt="">

                        <div class="event-body-wrap">

                            <a href="#" class="overlink"></a>

                            <div class="event-body">

                                <h3 class="event-title"><a href="#">Sed Laoreet Aliquam</a></h3>
                                <a href="#" class="event-cat">Parties</a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- - - - - - - - - - - - - end Content - - - - - - - - - - - - - - - -->




@endsection

@section('javascript')

@endsection















