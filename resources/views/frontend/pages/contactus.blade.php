@extends('frontend.layouts.master')

@section('title',__('tr.Contact Us'))

@section('contactsactive','current')

@section('stylesheet')

@endsection

@section('content')

    @include('frontend.components.breadcrumb')


    <div id="content">

        <div class="page-section">

            <div class="container wide">

                <div class="our-info style-2 item-col-3">

                    <div class="info-item">
                        <span class="licon-phone-wave"></span>
                        <span class="info-title">{{ $system_mobile }}</span>
                        <span>@lang('tr.Mobile')</span>
                    </div>

                    <div class="info-item">
                           <span class="licon-map-marker-check"></span>
                        <span class="info-title"> 5 Rah street , Nasr City</span>
                        <span>@lang('tr.Address')</span>
                    </div>

                    <div class="info-item">
                        <span class="licon-at-sign"></span>
                        <span class="info-title">{{ $system_email }}</span>
                        <span>@lang('tr.Email')</span>
                    </div>

                </div>

            </div>

        </div>


        <div class="page-section send_section">
<div class="overlay"></div>
            <div class="container wide ">

                <div class="row justify-content-center col-no-space">
                    <div class="col-xl-6 col-lg-8">

                        <div class="rsvp-form no-bg">

                            <div class="form-header">

                                <h2 class="title">@lang("tr.We'd Love To Hear From You")</h2>
                                <p>@lang('tr.Feel free to send us any questions you may have. We are happy to answer them')</p>

                            </div>

                            <form  class="contact-form" action="{{ route('frontend_store_contactus') }}" method="post">
                                @csrf
                                <div class="input-box">

                                    <input type="text" name="name" required>
                                    <label>@lang('tr.Name')</label>

                                </div>

                                <div class="input-box">

                                    <input type="email" name="email" required>
                                    <label>@lang('tr.Email')</label>

                                </div>

                                <div class="input-box">

                                    <input type="text" name="subject" required>
                                    <label>@lang('tr.Subject')</label>

                                </div>

                                <div class="input-box">

                                    <input type="text" name="message" required>
                                    <label>@lang('tr.Message')</label>

                                </div>

                                <div class="input-box align-center">

                                    <button type="submit"  class="btn btn-primary">@lang('tr.Send')</button>

{{--                                    <button type="submit" class="btn" data-type="submit">Submit</button>--}}

                                </div>

                            </form>

                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>



@endsection

@section('javascript')

@endsection