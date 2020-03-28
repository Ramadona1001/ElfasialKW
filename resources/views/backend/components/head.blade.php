<head>
	<base href="">
	<meta charset="utf-8" />
	<title>@yield('title') | @lang('tr.Dashboard')</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--begin::Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

	<!--end::Fonts -->

	<!--begin::Page Vendors Styles(used by this page) -->
	{{-- <link href="{{ asset('backend/css/fullcalender.css')}}" rel="stylesheet" type="text/css" /> --}}

	<!--end::Page Vendors Styles -->

	<!--begin::Global Theme Styles(used by all pages) -->
	<link href="{{ asset('backend/css/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />

@if(\Lang::locale() == 'ar')
	<style>
		@import url('https://fonts.googleapis.com/css?family=Almarai&display=swap');
		*{
			font-family: 'Almarai', sans-serif;
		}
	</style>
	<link href="{{ asset('backend/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
	@else
	<link href="{{ asset('backend/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	@endif
	<link href="{{ asset('backend/css/styles.css')}}" rel="stylesheet" type="text/css" />


	<!--end::Global Theme Styles -->

	<!--begin::Layout Skins(used by all pages) -->

	<!--end::Layout Skins -->
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/b-print-1.6.1/rr-1.2.6/datatables.min.css"/>
	<link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

	@yield('stylesheet')
</head>