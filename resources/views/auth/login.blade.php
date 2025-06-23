@extends('layout_inner_page')

@section('title')
    <title>{{ __('translate.Sign In') }}</title>
@endsection

@section('front-content')

@include('breadcrumb')

<!-- Start Signin Section -->
<section>
    <div class="td_height_100 td_height_lg_50"></div>
    <div class="container">
        <div class="row td_gap_y_40">
        <div class="col-lg-6">
            <div class="td_sign_thumb">
                <img src="{{ asset($general_setting->login_page_bg) }}" alt="" class="w-100 td_radius_10">
            </div>

        </div>
        <div class="col-lg-6">
            <div class="td_form_card td_style_1 td_radius_10 td_gray_bg_5">
                <form class="td_form_card_in" method="POST" action="{{ route('student.store-login') }}">
                    @csrf
                    <h2 class="td_fs_36 td_mb_20">{{ __('translate.Sign In') }}</h2>
                    <hr>
                    <div class="td_height_30 td_height_lg_30"></div>

                    <input type="email" class="td_form_field td_mb_30 td_medium td_white_bg" placeholder="{{ __('translate.Email') }} *" name="email" value="{{ old('email') }}">
                    <input type="password" class="td_form_field td_mb_10 td_medium td_white_bg" placeholder="{{ __('translate.Password') }} *" name="password">
                    <div class="td_form_card_text_2 td_mb_30">
                        <div><a href="{{ route('student.forget-password') }}" class="td_semibold td_accent_color">{{ __('translate.Forgot Password?') }}</a></div>
                        <div class="td_accent_color">
                            <div class="td_custom_checkbox">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">{{ __('translate.Remember me') }}</label>
                            </div>
                        </div>
                    </div>

                    @if($general_setting->recaptcha_status==1)
                        <div class="td_mb_10">
                            <div class="g-recaptcha" data-sitekey="{{ $general_setting->recaptcha_site_key }}"></div>
                        </div>
                    @endif

                    <div class="td_form_card_bottom td_mb_25">
                        <div class="w-100">

                            <button type="submit" class="td_btn td_style_1 td_radius_30 td_medium edc-auth-btn" >
                  <span class="td_btn_in td_white_color td_accent_bg">
                    <span>{{ __('translate.Sign In') }}</span>
                    <svg width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15.1575 4.34302L3.84375 15.6567" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M15.157 11.4142C15.157 11.4142 16.0887 5.2748 15.157 4.34311C14.2253 3.41142 8.08594 4.34314 8.08594 4.34314" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </span>
                            </button>
                            <div>
                                <p class="td_form_card_text td_fs_20 td_fs_sm_16 td_medium td_heading_color mb-0 text-center mt-3">{{ __('translate.Don’t Have an Account?') }} <a
                                        href="{{ route('student.register') }}">{{ __('translate.Sign Up') }}</a></p>
                            </div>
                        </div>
                        <div class="d-flex gap-3 justify-content-center align-items-center mt-4">
                            <div class="edc-line-sperator"></div>
                            <p class="td_fs_20 mb-0 td_medium ">{{ __('translate.or sign up with') }}</p>
                            <div class="edc-line-sperator"></div>
                        </div>

                        <div class="td_form_social td_fs_20">

                            @if ($general_setting->is_gmail == 1)
                                <a href="{{ route('student.login-google') }}" class="td_center">
                                    <i class="fa-brands fa-google"></i>
                                </a>
                            @endif

                            @if ($general_setting->is_facebook == 1)
                                <a href="{{ route('student.login-facebook') }}" class="td_center">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                            @endif

                        </div>
                    </div>

                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="td_height_100 td_height_lg_50"></div>
</section>
<!-- End Signin Section -->

@endsection

  @push('js_section')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    @endpush
