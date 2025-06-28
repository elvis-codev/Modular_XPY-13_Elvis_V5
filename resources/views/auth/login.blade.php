<!DOCTYPE html>
<html class="no-js" lang="zxx">
	<head>
		<!-- Meta Tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Site Title -->
		<title>{{ __('Sign In') }}</title>

		<!-- Fav Icon -->
		<link rel="icon" href="{{ asset($general_setting->favicon) }}">

        <!--  Stylesheet -->
		<link rel="stylesheet" href="{{ asset('/backend/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('backend/css/slick.min.css') }}">
		<link rel="stylesheet" href="{{ asset('backend/css/font-awesome-all.min.css') }}">
		<link rel="stylesheet" href="{{ asset('backend/css/nice-select.min.css') }}">
		<link rel="stylesheet" href="{{ asset('backend/css/reset.css') }}">
		<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
		<link rel="stylesheet" href="{{ asset('backend/css/dev.css') }}">
        <link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">

	</head>
	<body id="crancy-dark-light">

		<div class="body-bg">

			<section class="crancy-wc crancy-wc__full crancy-bg-cover">
				<div class="crancy-wc__form">
					<!-- Welcome Banner -->
					<div class="crancy-wc__form--middle">
                        <div class="crancy-wc__banner crancy-bg-cover">
                            <div class="crancy-wc__banner--img w-100 h-100">
                                <img src="{{ asset($general_setting->login_page_bg) }}" alt="#" class="w-100 h-100">
                            </div>
                        </div>
						<div class="crancy-wc__form-inner-flex">
						<div class="crancy-wc__form-inner">
							<div class="crancy-wc__logo">
								<a href="{{ route('home') }}"><img src="{{ asset($general_setting->logo) }}" alt="#"></a>
							</div>

							<div class="crancy-wc__form-inside-df">
							<div class="crancy-wc__form-inside">
								<div class="crancy-wc__form-middle">
									<div class="crancy-wc__form-top">

										<div class="crancy-wc__heading pd-btm-20">
											<h3 class="crancy-wc__form-title crancy-wc__form-title__one m-0">{{ __('Login Here') }}</h3>
											<p>{{ __('Welcome to Educve Student Panel') }}</p>
										</div>
										<!-- Sign in Form -->
										<form class="crancy-wc__form-main" action="{{ route('student.store-login') }}" method="post">
											@csrf
											<div class="row">
												<div class="col-12">
													<!-- Form Group -->
													<div class="form-group">
														<div class="form-group__input">
															<input class="crancy-wc__form-input" type="email" name="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}">
														</div>
													</div>
												</div>
												<div class="col-12">
													<!-- Form Group -->
													<div class="form-group">
														<div class="form-group__input">
															<input class="crancy-wc__form-input" placeholder="{{ __('Password') }}" id="password-field" type="password" name="password">
															<span class="crancy-wc__toggle"><i class="fas fa-eye-slash" id="toggle-icon"></i></span>
														</div>
													</div>
												</div>
											</div>

											@if($general_setting->recaptcha_status==1)
												<div class="form-group">
													<div class="g-recaptcha" data-sitekey="{{ $general_setting->recaptcha_site_key }}"></div>
												</div>
											@endif

											<!-- Form Group -->
											<div class="form-group mg-top-30">
												<div class="crancy-wc__button">
													<button class="ntfmax-wc__btn" type="submit">{{ __('Login Now') }}</button>
												</div>
											</div>

											<div class="crancy-wc__form-bottom">
												<p>¿No tienes una cuenta? <a href="{{ route('student.register') }}">Registrarse</a></p>
											</div>

										</form>
										<!-- End Sign in Form -->
										
									</div>

								</div>
							</div>
							</div>

						</div>
						</div>

					</div>
					<!-- End Welcome Banner -->
				</div>
			</section>

		</div>

		<!--  Scripts -->
		<script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
		<script src="{{ asset('backend/js/jquery-migrate.js') }}"></script>
		<script src="{{ asset('backend/js/popper.min.js') }}"></script>
		<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('backend/js/nice-select.min.js') }}"></script>
		<script src="{{ asset('backend/js/main.js') }}"></script>
        <script src="{{ asset('global/toastr/toastr.min.js') }}"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>

        <script>
            (function($) {
                "use strict"
                $(document).ready(function () {

					const togglePassword = document.querySelector('#toggle-icon');
					const password = document.querySelector('#password-field');
					
					if (togglePassword && password) {
						togglePassword.addEventListener('click', function (e) {
							const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
							password.setAttribute('type', type);
							this.classList.toggle('fa-eye');
							this.classList.toggle('fa-eye-slash');
						});
					}

					const session_notify_message = @json(Session::get('message'));
					
					if(session_notify_message != null){
						const session_notify_type = @json(Session::get('alert-type', 'info'));
						switch (session_notify_type) {
							case 'info':
								toastr.info(session_notify_message);
								break;
							case 'success':
								toastr.success(session_notify_message);
								break;
							case 'warning':
								toastr.warning(session_notify_message);
								break;
							case 'error':
								toastr.error(session_notify_message);
								break;
						}
					}

					const validation_errors = @json($errors->all());
					
					if (validation_errors.length > 0) {
						validation_errors.forEach(error => toastr.error(error));
					}

                });
            })(jQuery);

        </script>

	</body>
</html>