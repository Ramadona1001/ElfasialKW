<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- end::Messages Sidebar -->


<!--begin::Global Theme Bundle(used by all pages) -->
<script src="{{ asset('backend/js/plugins.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/js/scripts.bundle.js')}}" type="text/javascript"></script>

<!--end::Global Theme Bundle -->

<!--begin::Page Vendors(used by this page) -->
<script src="{{ asset('backend/js/fullcalender.bundle.js')}}" type="text/javascript"></script>
<script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
<script src="{{ asset('backend/js/gmaps.js')}}" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="{{ asset('backend/js/dashboard.js')}}" type="text/javascript"></script>

<!--end::Page Scripts -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/b-print-1.6.1/rr-1.2.6/datatables.min.js"></script>
<script>
	var KTAppOptions = {
		"colors": {
			"state": {
				"brand": "#2c77f4",
				"light": "#ffffff",
				"dark": "#282a3c",
				"primary": "#5867dd",
				"success": "#34bfa3",
				"info": "#36a3f7",
				"warning": "#ffb822",
				"danger": "#fd3995"
			},
			"base": {
				"label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
				"shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
			}
		}
	};
</script>
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
@if (Session::has('success'))
    <script>
        Swal.fire(
            '@lang("tr.Process is Done Successfully")',
            '@lang("tr.SUCCESS ♥")',
            'success'
        );
    </script>
@endif

@yield('javascript')