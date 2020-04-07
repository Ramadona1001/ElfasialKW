<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

<footer id="footer" class="footer style-5">

    <!-- main footer -->
    <div class="main-footer">

      <div class="container">

        <div class="row">

          <div class="col-lg-3 col-sm-6">

            <div class="widget">

              <h6 class="widget-title"> @lang('tr.Contact Us') </h6>

              <div class="our-info content-element4">

                <p class="info-item">
                  <span class="info-title"> @lang('tr.Mobile') : </span>
                  <span content="telephone=no"> <a href="tel:{{ $system_mobile }}" style="color: #ccc5c5;"> {{ $system_mobile }}</a></span>
                </p>
                <br>
                <p class="info-item">
                  <span class="info-title">  @lang('tr.Email') :  </span>
                  <a href="mailto:{{ $system_email }}" class="link-text">{{ $system_email }}</a>
                </p>

              </div>

              <ul class="social-icons size-2 color-style-2">

                <li><a href="{{ $system_facebook }}"><i class="icon-facebook"></i></a></li>
                <li><a href="{{ $system_twitter }}"><i class="icon-twitter"></i></a></li>
                <li><a href="{{ $system_instagram }}"><i class="icon-instagram-5"></i></a></li>

              </ul>

                        </div>

          </div>

          <div class="col-lg-2 col-sm-6">

            <div class="widget">

              <h6 class="widget-title"> @lang('tr.Menu') </h6>

              <ul class="menu-list vr-type">



                <li class="@yield('homeactive')"><a href="{{ route('frontend_index') }}">@lang('tr.Home Page')</a></li>
                <li class="@yield('aboutactive')"><a href="{{ route('frontend_aboutus') }}" >@lang('tr.About Us')</a></li>
                <li class="@yield('servicesactive')"><a href="{{ route('frontend_services') }}">@lang('tr.Our Services')</a></li>
                <li class="@yield('contactusactive')"><a href="{{ route('frontend_contactus') }}">@lang('tr.Contact Us')</a></li>
                @if(isset($system_en_terms) != null)
                <li class="@yield('termsconditionsactive')"><a href="{{ route('frontend_terms_conditions') }}">@lang('tr.Terms & Conditions')</a></li>
                @endif
              </ul>

            </div>

          </div>

          <div class="col-lg-4 col-sm-6">

            <div class="widget">

              <h6 class="widget-title"> @lang('tr.Categories')  </h6>

              <div class="entry-box entry-small">

                @foreach ($system_all_categories as $cat)

                <div class="entry-col">

                  <!-- Entry post -->
                  <div class="entry">

                    <div class="thumbnail-attachment">
                      <a href="/services#tab-{{ $cat->id }}" class="overlink"></a>
                      <a href="/services#tab-{{ $cat->id }}"><img src="{{ asset('uploads/categories/'.$cat->cat_image) }}" class="footer_image" alt=""></a>
                    </div>

                    <div class="entry-body">

                      <div class="entry-meta">

                        <time class="entry-date" datetime="2019-11-08">{{ explode(' ',$cat->created_at)[0] }} </time>/
                        <span>@lang('tr.in')</span>
                        <span  class="entry-cat"> {{ substr($cat->desc,0,10) }}</span>

                      </div>
                      <h5 class="entry-title"><strong><a href="/services#tab-{{ $cat->id }}">{{ $cat->name }}</a></strong></h5>

                    </div>

                  </div>

                </div>
                    
                @endforeach

                


              </div>

            </div>

          </div>

          <div class="col-lg-3 col-sm-6">

            <div class="widget">

              <h6 class="widget-title">@lang('tr.subscribe') </h6>
               <p class="text-size-small"> @lang('tr.subscribePhragrph') </p>
              <form id="newsletter" class="newsletter">
                <input type="email" name="newsletter-email" placeholder="@lang('tr.Email')">
                <button type="submit" data-type="submit" class="btn"> @lang('tr.subscribenow') </button>
              </form>

            </div>


          </div>

        </div>

      </div>

    </div>

    <div class="bottom-footer">

      <p class="copyright">@lang('tr.Copyright') © {{ date('Y') }} {{ $system_title }}. @lang('tr.All Rights Reserved').</p>

    </div>

  </footer>

  <!-- - - - - - - - - - - - - end Footer - - - - - - - - - - - - - - - -->