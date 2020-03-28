<!DOCTYPE html>

<html @if(\Lang::locale() == 'ar') direction="rtl" dir="rtl" style="direction: rtl" @else lang="en" @endif >

@include('backend.components.head')

<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
    
    @include('backend.components.layout')

    @include('backend.components.scripts')
</body>
</html>