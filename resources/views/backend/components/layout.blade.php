
<!-- begin:: Page -->
@include('backend.components.base-mobile')
<div class="kt-grid kt-grid--hor kt-grid--root">
	<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        
        @include('backend.components.aside_base')
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

            @include('backend.components.header_base')
            
			<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                
                @include('backend.components.subheader-v1')
                @include('backend.components._content_base')
			</div>
            @include('backend.components._footer_base')
		</div>
	</div>
</div>

@include('backend.components._scrolltop')
