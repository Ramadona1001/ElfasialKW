<!DOCTYPE html>
<html direction="rtl" dir="rtl" style="direction: rtl">

<!-- begin::Head -->

<head>
	<meta charset="utf-8" />
	<title>Dashboard</title>
	<meta name="description" content="Latest updates and statistic charts">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

	<!--begin::Web font -->
	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
			},
			active: function () {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!--end::Web font -->

	<!--begin::Global Theme Styles -->

	<link href="{{ asset('frontend/login/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('frontend/login/assets/demo/base/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('frontend/login/loginCSS/loginStyle.css') }}" rel="stylesheet" type="text/css" />


	<!--end::Global Theme Styles -->
	<link rel="shortcut icon" href="{{ asset('frontend/login/assets/demo/media/img/logo/favicon.ico')}}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->

<body
	class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

	<!-- begin:: Page -->
	<div class="m-grid m-grid--hor m-grid--root m-page page_design"
		style="background-image: url({{ asset('frontend/login/images/loginbg.jpg') }});background-color: #6247474f;">
		<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-1"
			id="m_login">
			<div class="m-grid__item m-grid__item--fluid m-login__wrapper">
				<div class="m-login__container overlay_div">
					<div class="m-login__logo">
						<a href="#">
							<img src="{{ asset('frontend/login/assets/demo/media/img/logo/logoo.png')}}">
						</a>

					</div>

					<!--  ***************************  START THE LOGIN TAP   ********************   -->
					<div class="m-login__signin">
						<div class="m-login__head">
							<div class="m-login__desc">مرحبا بك بموقعنا قم بتسجيل الدخول لحجز موعد المناسبة </div>
                        </div>
                        <form method="POST" class="m-login__form m-form" action="{{ route('login') }}">
                            @csrf
							<div class="form-group m-form__group">

								<input class="form-control m-input" type="email" placeholder="@lang('tr.Email')"
									name="email">
							</div>
							<div class="form-group m-form__group">
								<input class="form-control m-input m-login__form-input--last" type="password"
									placeholder="•••••••••" name="password">
							</div>
							<div class="row m-login__form-sub">
								<div class="col m--align-right">
									<label class="m-checkbox m-checkbox--focus">
										<input type="checkbox" name="remember"> تذكرنى
										<span></span>
									</label>
								</div>
								<div class="col m--align-left">
									<a href="javascript:;" id="m_login_forget_password"
										class="m-link m-link--focus m-login__account-link">نسيت كلمة المرور ؟ </a>
								</div>
							</div>
							<div class="m-login__form-action">
								<button type="submit"
									class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">دخول</button>
							</div>
						</form>
					</div>
					<!--  ***************************  END THE LOGIN TAP   ********************   -->


					<!--  ***************************  START THE SIGN UP TAP   ********************   -->
					<div class="m-login__signup">
						<div class="m-login__head">
							<div class="m-login__desc">أدخل بياناتك لإنشاء حسابك الخاص </div>
						</div>
						<form class="m-login__form m-form" action="">
							<div class="form-group m-form__group">
								<input class="form-control m-input" type="text" placeholder="الاسم" name="fullname">
							</div>
							<div class="form-group m-form__group">
								<input class="form-control m-input" type="text" placeholder="اسم المستخدم"
									name="fullname">
							</div>
							<div class="form-group m-form__group">
								<input class="form-control m-input" type="email" placeholder="البريد الالكتروتى"
									name="email">
							</div>
							<div class="form-group m-form__group">
								<input class="form-control m-input" type="tel" placeholder="رقم الهاتف" name="phone">
							</div>
							<div class="form-group m-form__group">
								<input class="form-control m-input" type="password" placeholder="كلمة المرور"
									name="password">
							</div>
							<div class="form-group m-form__group">
								<input class="form-control m-input m-login__form-input--last" type="password"
									placeholder="تاكيد كلمة المرور" name="rpassword">
							</div>
							<div class="row form-group m-form__group m-login__form-sub">
								<div class="col m--align-right">
									<label class="m-checkbox m-checkbox--focus">
										<input type="checkbox" name="agree"> انا اوافق على جميع <a href="#"
											class="m-link m-link--focus">الاحكام والشروط</a>.
										<span></span>
									</label>
									<span class="m-form__help"></span>
								</div>
							</div>
							<div class="m-login__form-action">
								<button id="m_login_signup_submit"
									class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">تسجيل
									الحساب</button>
								<button id="m_login_signup_cancel"
									class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">الغاء</button>
							</div>
						</form>
					</div>
					<!--  ***************************  END THE SIGN UP TAP   ********************   -->


					<!--  ***************************  START THE FORGET TAP   ********************   -->
					<div class="m-login__forget-password">
						<div class="m-login__head">
							<div class="m-login__desc">أدخل بريدك الإلكتروني لإعادة تعيين كلمة المرور الخاصة بك </div>
						</div>
						<form class="m-login__form m-form" action="">
							<div class="form-group m-form__group">
								<input class="form-control m-input" type="text" placeholder="البريد الالكترونى "
									name="email" id="m_email">
							</div>
							<div class="m-login__form-action">
								<button id="m_login_forget_password_submit"
									class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">طلب</button>
								<button id="m_login_forget_password_cancel"
									class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">الغاء</button>
							</div>
						</form>
					</div>
					<!--  ***************************  END THE FORGET TAP   ********************   -->
					<div class="m-stack__item m-stack__item--center">
						<div class="m-login__account">
							<span class="m-login__account-msg">
								لا تملك حسابا حتى الآن ؟
							</span>&nbsp;&nbsp;
							<a href="javascript:;" id="m_login_signup"
								class="m-link m-link--focus m-login__account-link">انشاء حسابا جديدا</a>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<!-- end:: Page -->

	<!--begin::Global Theme Bundle -->
	<script src="{{ asset('frontend/login/assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
	<script src="{{ asset('frontend/login/assets/demo/base/scripts.bundle.js')}}" type="text/javascript"></script>
	<!--end::Global Theme Bundle -->

	<!--begin::Page Scripts -->
	<script src="{{ asset('frontend/login/assets/snippets/custom/pages/user/login.js')}}" type="text/javascript"></script>

	<!--end::Page Scripts -->
</body>

<!-- end::Body -->

</html>