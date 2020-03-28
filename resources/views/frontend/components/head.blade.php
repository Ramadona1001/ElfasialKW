<head>
<!-- Google Web Fonts
================================================== -->

<link href="https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700%7CCormorant:300,300i,400,400i,500,500i,600,600i,700,700i%7CGreat+Vibes" rel="stylesheet">
<link href="{{ asset('frontend/font/fontawesome-free-5.12.0-web/css/all.css') }}" rel="stylesheet">
<!-- Basic Page Needs
================================================== -->

<title>{{ $system_title }} | @yield('title')</title>

<!--meta info-->
<meta charset="utf-8">
<meta name="author" content="">
<meta name="keywords" content="">
<meta name="description" content="">

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Vendor CSS
============================================ -->
<link rel="stylesheet" href="{{ asset('frontend/font/linearicons/demo.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/font/fontello/fontello.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/plugins/revolution/css/settings.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/plugins/revolution/css/layers.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/plugins/revolution/css/navigation.css') }}">

<!-- CSS theme files
============================================ -->
<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-grid.min.css') }}">
@if(\Lang::getLocale() == 'en')
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
@else
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/rtl.css') }}">
@endif
<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">

<!-- font -->
<link rel="stylesheet" type="text/css" href="https://www.fontstatic.com/f=aures,diwanltr" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

@yield('stylesheet')

</head>