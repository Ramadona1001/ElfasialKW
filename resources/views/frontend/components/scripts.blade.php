<!-- JS Libs & Plugins
============================================ -->
<script src="{{ asset('frontend/font/fontawesome-free-5.12.0-web/js/all.js') }}"></script>
<script src="{{ asset('frontend/js/libs/jquery.modernizr.js') }}"></script>
<script src="{{ asset('frontend/js/libs/jquery-2.2.4.min.js') }}"></script>
<script src="{{ asset('frontend/js/libs/jquery-ui.min.js') }}"></script>
<script src="{{ asset('frontend/js/libs/retina.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/owl.carousel.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/instafeed.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/vivus.js') }}"></script>
<script src="{{ asset('frontend/plugins/pathformer.js') }}"></script>
<script src="{{ asset('frontend/plugins/revolution/js/jquery.themepunch.tools.min.js?ver=5.0') }}"></script>
<script src="{{ asset('frontend/plugins/revolution/js/jquery.themepunch.revolution.min.js?ver=5.0') }}"></script>
<script src="{{ asset('frontend/plugins/jquery.queryloader2.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/isotope.pkgd.min.js') }}"></script>



<!-- JS theme files
============================================ -->
<script src="{{ asset('frontend/js/plugins.js') }}"></script>
<script src="{{ asset('frontend/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
<script src="{{ asset('frontend/plugins/mad.customselect.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script> function toggle_visibility() {
    var e = document.getElementById('feedback-main');
    if(e.style.display == 'block')
       e.style.display = 'none';
    else
       e.style.display = 'block';
 }</script>

@if (Session::has('success'))
    <script>
       Command: toastr["success"]("@lang('tr.Thank You ♥')", "@lang('tr.Done')")

        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
    </script>
@endif

@yield('javascript')

