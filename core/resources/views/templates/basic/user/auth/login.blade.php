@php
$content = getContent('sign_in.content', true);
@endphp
@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!-- Main  -->
    <div class="user-login section"
        style="background-image: url({{ getImage('assets/images/frontend/sign_in/' . @$content->data_values->image,'1920x1080') }})">
        <div class="container p-3">
            <div class="row g-3">
                <div class="col-md-8 col-xxl-6">
                    <form method="POST" action="{{ route('user.login') }}" onsubmit="return submitUserForm();"
                        class="row g-3 gy-lg-4 login-form">
                        @csrf
                        <div class="col-12 mt-0">
                            <h4 class="my-0">
                                {{__(@$content->data_values->heading)}}
                                </h4>
                        </div>
                        <div class="col-12">
                            <label for="user-name" class="mb-2 t-heading-font"> @lang('Username or Email') </label>
                            <input type="text" name="username" autocomplete="off" id="user-name"
                                class="form-control form--control" placeholder="@lang('Username or Email')"
                                value="{{ old('username') }}" required/>
                        </div>
                        <div class="col-md-12">
                            <label for="password" class="mb-2 t-heading-font"> @lang('Password') </label>
                            <div class="input-group form--control checkUser">
                                <input type="password" name="password" autocomplete="off" id="password_id"
                                    class="form-control form--control" placeholder="@lang('Password')" required/>
                                <div class="input-append">
                                    <span class="form--control form-control icon">
                                        <i class="fas fa-eye field_icon toggle-password"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 border-end">
                            <div class="form-check">
                                <input class="form-check-input custom-form-check-input" type="checkbox"
                                    id="flexCheckDefault" name="remember" {{ old('remember') ? 'checked' : '' }}/>
                                <label class="form-check-label t-heading-font" for="flexCheckDefault">
                                    @lang('Remember Me')
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0 t-heading-font">@lang("Haven't an account?")
                                <a href="{{ route('user.register') }}"
                                    class="t-link t-link--danger text--danger t-heading-font">
                                    @lang('Sign Up')
                                </a>
                            </p>
                        </div>

                        <div class="mb-0">
                            <div class="col-md-4"></div>
                            <div class="col-md-6">
                                @php echo loadReCaptcha() @endphp
                            </div>
                        </div>
                        @include($activeTemplate.'partials.custom_captcha')

                        <div class="col-md-6">
                            <button class="btn btn--xl btn--gamma" id="recaptcha">
                                @lang('Submit Now')
                            </button>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('user.password.request') }}"
                                class="t-link t-link--danger text--danger t-heading-font">@lang("Forgot Your Password?")
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Main End -->
@endsection
@push('script')
    <script>
        "use strict";

        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }

        //ShowHide-password//
        $(".icon").on('click', '.toggle-password', function() {
            $(this).toggleClass("las la-eye-slash text-danger");
            var input = $("#password_id");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endpush
