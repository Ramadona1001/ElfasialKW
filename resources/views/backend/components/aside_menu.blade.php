
<!-- begin:: Aside Menu -->
<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
	<div id="kt_aside_menu" class="kt-aside-menu " style="overflow-y:hidden" data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
		<ul class="kt-menu__nav ">

			@can('show_menu_dashboard')
			<li class="kt-menu__item  @yield('homesactive')" aria-haspopup="true"><a href="{{ route('dashboard_index') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-architecture-and-city" style="color:#f5f6ff;"></i><span class="kt-menu__link-text">@lang('tr.Dashboard')</span></a></li>
			@endcan

			@can('show_menu_users')
			<li class="kt-menu__section ">
				<h4 class="kt-menu__section-text">@lang('tr.Users')</h4>
				<i class="kt-menu__section-icon flaticon-more-v2"></i>
			</li>

			<li class="kt-menu__item  @yield('usersactive')" aria-haspopup="true"><a href="{{ route('users') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-users" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Users')</span></a></li>
			@endcan

			@can('show_menu_customers')
			<li class="kt-menu__item  @yield('customersactive')" aria-haspopup="true"><a href="{{ route('customers') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-users" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Customers')</span></a></li>
			@endcan

			@can('show_menu_departments')
			<li class="kt-menu__item  @yield('departmentsactive')" aria-haspopup="true"><a href="{{ route('departments') }}" class="kt-menu__link "><i class="kt-menu__link-bullet flaticon-map" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Departments')</span></a></li>
			@endcan

			@can('show_menu_departments_tasks')
			<li class="kt-menu__item  @yield('departmenttasksactive')" aria-haspopup="true"><a href="{{ route('department_tasks') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-user-tag" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Departments Tasks')</span></a></li>
			@endcan
			
			

			@can('show_menu_inventory')
			<li class="kt-menu__section ">
				<h4 class="kt-menu__section-text">@lang('tr.Items')</h4>
				<i class="kt-menu__section-icon flaticon-more-v2"></i>
			</li>
			
			<li class="kt-menu__item   @yield('iteminventorysactive')" aria-haspopup="true"><a href="{{ route('iteminventory') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-database" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Items Inventory')</span></a></li>
			<li class="kt-menu__item   @yield('inventorysactive')" aria-haspopup="true"><a href="{{ route('inventory') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-database" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Inventory')</span></a></li>
			@endcan

			@can('show_menu_categories')
			<li class="kt-menu__item   @yield('categoriesactive')" aria-haspopup="true"><a href="{{ route('category') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa flaticon2-tag" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Categories')</span></a></li>
			@endcan
			
			@can('show_menu_catalogs')
			<li class="kt-menu__item   @yield('catalogssactive')" aria-haspopup="true"><a href="{{ route('catalogs') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa flaticon-layers" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Catalogs')</span></a></li>
			@endcan

			@can('show_menu_buffets')
			<li class="kt-menu__item   @yield('buffetssactive')" aria-haspopup="true"><a href="{{ route('buffets') }}" class="kt-menu__link "><i class="kt-menu__link-bullet flaticon-menu-button" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Buffets')</span></a></li>
			@endcan

			@can('show_menu_customer_choices')
			{{-- <li class="kt-menu__item   @yield('fromchoicesactive')" aria-haspopup="true"><a href="{{ route('fromchoices') }}" class="kt-menu__link "><i class="kt-menu__link-bullet flaticon2-checkmark" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Customer Choices')</span></a></li> --}}
			@endcan

			@can('show_menu_packages')
			<li class="kt-menu__item   @yield('packagesactive')" aria-haspopup="true"><a href="{{ route('packages') }}" class="kt-menu__link "><i class="kt-menu__link-bullet flaticon2-delivery-package" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Packages')</span></a></li>
			@endcan

			@can('show_menu_orders')
			<li class="kt-menu__item   @yield('ordersactive')" aria-haspopup="true"><a href="{{ route('orders') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-file-invoice" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Orders')</span></a></li>
			@endcan

			@can('show_menu_withdraw')
			<li class="kt-menu__item   @yield('withdrawsactive')" aria-haspopup="true"><a href="{{ route('withdraw_inventory_show') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa flaticon-folder-1" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Withdraw')</span></a></li>
			@endcan

			
			@can('show_menu_my_tasks')
			<li class="kt-menu__section ">
				<h4 class="kt-menu__section-text">@lang('tr.Tasks')</h4>
				<i class="kt-menu__section-icon flaticon-more-v2"></i>
			</li>

			<li class="kt-menu__item   @yield('mytasksactive')" aria-haspopup="true"><a href="{{ route('departments_mytasks') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-tasks" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.My Tasks')</span></a></li>
			@endcan

			@can('show_menu_tasks')
			<li class="kt-menu__item   @yield('tasksactive')" aria-haspopup="true"><a href="{{ route('tasks') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-tasks" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Tasks')</span></a></li>
			@endcan
			{{-- <li class="kt-menu__item   @yield('profitsactive')" aria-haspopup="true"><a href="{{ route('profits') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-money-check" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Profits')</span></a></li> --}}



			
			

			@can('show_menu_contactus')
			<li class="kt-menu__section ">
				<h4 class="kt-menu__section-text">@lang('tr.settings')</h4>
				<i class="kt-menu__section-icon flaticon-more-v2"></i>
			</li>

			<li class="kt-menu__item   @yield('contactssactive')" aria-haspopup="true"><a href="{{ route('contactus') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-phone" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.contact us')</span></a></li>
			@endcan

			@can('show_menu_contracts')
			<li class="kt-menu__item   @yield('contractsactive')" aria-haspopup="true"><a href="{{ route('contracts') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-file-invoice" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Contracts')</span></a></li>
			@endcan

			@can('show_menu_contracts')
			<li class="kt-menu__item   @yield('termsactive')" aria-haspopup="true"><a href="{{ route('terms_index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-file-invoice" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Terms')</span></a></li>
			@endcan

			@can('show_menu_feedbacks')
			<li class="kt-menu__item   @yield('feedbacksactive')" aria-haspopup="true"><a href="{{ route('feedbacks') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-star" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.Feedback')</span></a></li>
			@endcan

			@can('show_menu_settings')
			<li class="kt-menu__item   @yield('settingsactive')" aria-haspopup="true"><a href="{{ route('settings_index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-cogs" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.settings')</span></a></li>
			@endcan

			@can('show_menu_social_media')
			<li class="kt-menu__item   @yield('socialsactive')" aria-haspopup="true"><a href="{{ route('social_media_index') }}" class="kt-menu__link "><i class="kt-menu__link-bullet fa fa-link" style="color:#f5f6ff;"><span></span></i>&nbsp;&nbsp;&nbsp;<span class="kt-menu__link-text">@lang('tr.social_media')</span></a></li>
			@endcan

			

		</ul>
	</div>
</div>

<!-- end:: Aside Menu -->