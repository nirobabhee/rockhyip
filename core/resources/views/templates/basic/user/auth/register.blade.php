@php
$content = getContent('sign_up.content', true);
$element = getContent('policy_pages.element');
@endphp
@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!-- Main  -->
    <div class="user-login section"
        style="background-image: url({{ getImage('assets/images/frontend/sign_up/' . @$content->data_values->image,'1920x1080') }})">
        <div class="container p-3">
            <div class="row g-3">
                <div class="col-md-8 col-xxl-6">
                    <form action="{{ route('user.register') }}" method="POST" onsubmit="return submitUserForm();"
                        class="row g-3 gy-lg-4 login-form">
                        @csrf

                        <div class="col-12 mt-0">
                            <h4 class="my-0">{{ __(@$content->data_values->heading) }}</h4>
                        </div>
                        @if (session()->get('reference') != null)

                            <div class="col-md-6">
                                <label for="referenceBy" class="mb-2 t-heading-font"> @lang('Reference
                                    By')</label>

                            </div>
                            <div class="col-md-6">
                                <label id="referenceBy" class="mb-2 t-heading-font">
                                    {{ __(session()->get('reference')) }}</label>

                            </div>
                        @endif

                        <div class="col-md-6">
                            <label for="first-name" class="mb-2 t-heading-font"> @lang('First Name') </label>
                            <input type="text" name="firstname" id="first-name" class="form-control form--control"
                                placeholder="first name" value="{{ old('firstname') }}" autocomplete="off" />
                        </div>
                        <div class="col-md-6">
                            <label for="last-name" class="mb-2 t-heading-font"> @lang('Last Name') </label>
                            <input type="text" name="lastname" id="last-name" class="form-control form--control"
                                placeholder="last name" value="{{ old('lastname') }}" autocomplete="off" />
                        </div>
                        <div class="col-md-6">
                            <label for="user-name" class="mb-2 t-heading-font"> @lang('User Name') <span
                                    class="text-danger">*</span>
                            </label>
                            <input type="text" name="username" id="user-name" class="form-control form--control checkUser"
                                placeholder="user name" value="{{ old('username') }}" autocomplete="off" required />
                        </div>
                        <div class="col-md-6">
                            <label for="email-address" class="mb-2 t-heading-font"> @lang('Email') <span
                                    class="text-danger">*</span></label>
                            <input type="email" name="email" id="email-address" class="form-control form--control checkUser"
                                placeholder="email address" value="{{ old('email') }}" autocomplete="off" required />
                        </div>
                        <div class="col-md-6">
                            <label for="country" class="mb-2 t-heading-font"> @lang('Country') <span
                                    class="text-danger">*</span></label>
                            <select name="country" id="country" class="form-control form--control">
                                @foreach ($countries as $key => $country)
                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}"
                                        data-code="{{ $key }}">
                                        {{ __($country->country) }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label for="telephone-num" class="mb-2 t-heading-font">
                                @lang('Mobile Number') <span class="text-danger">*</span>
                            </label>
                            <div class="input-group form--control checkUser">
                                <div class="input-prepend">
                                    <span class="form--control form-control mobile-code code--control">
                                    </span>

                                    <input type="hidden" name="mobile_code">
                                    <input type="hidden" name="country_code">
                                </div>
                                <input type="number" name="mobile" id="mobile" value="{{ old('mobile') }}"
                                    class="form-control form--control" placeholder="@lang('Your Phone Number')"
                                    min="0" required>
                            </div>
                            <small class="text-danger mobileExist"></small>
                        </div>
                        <div class="col-md-6 hover-input-popup">
                            <label for="password" class="mb-2 t-heading-font"> @lang('Password') <span
                                    class="text-danger">*</span></label>
                            <input type="password" name="password" autocomplete="off" id="password"
                                class="form-control form--control" placeholder="passwrod" required />
                            @if ($general->secure_password)
                                <div class="input-popup">
                                    <p class="error lower">@lang('1 small letter minimum')</p>
                                    <p class="error capital">@lang('1 capital letter minimum')</p>
                                    <p class="error number">@lang('1 number minimum')</p>
                                    <p class="error special">@lang('1 special character minimum')</p>
                                    <p class="error minimum">@lang('6 character password')</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label for="confirm-passwrod" class="mb-2 t-heading-font">
                                @lang('Confirm Password')<span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password_confirmation" id="confirm-passwrod"
                                autocomplete="password" class="form-control form--control" placeholder="confirm passwrod"
                                required />
                        </div>



                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 ">
                            @php echo loadReCaptcha() @endphp
                        </div>

                        @include($activeTemplate.'partials.custom_captcha')
                        @if ($general->agree)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input custom-form-check-input" type="checkbox" name="agree"
                                        {{ old('agree') ? 'checked' : '' }} id="flexCheckDefault" />
                                    <label class="form-check-label t-heading-font" for="flexCheckDefault">
                                        @lang('I agree with')
                                        @foreach ($element as $page)
                                            <a class="t-link t-link--danger text--white"
                                                href="{{ route('policy.page', [slug($page->data_values->title), $page->id]) }}">{{ @$page->data_values->title }}</a>
                                            @if (!$loop->last) , @endif
                                        @endforeach
                                        <span class="text-danger">*</span>
                                    </label>
                                </div>
                            </div>
                        @endif


                        <div class="col-md-6 border-start">
                            <p class="mb-0 t-heading-font">@lang('Have an account?') <a href="{{ route('user.login') }}"
                                    class="t-link t-link--danger text--danger t-heading-font">@lang('Login')</a></p>
                        </div>
                        <div class="col-12">
                            <button class="btn btn--xl btn--gamma">
                                @lang('Submit Now')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main End -->
    <div class="modal fade " id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content custom border">
                <div class="modal-header ">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us.')</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class="text-center">@lang('You already have an account please Sign in. ')</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('Close')</button>
                    <a href="{{ route('user.login') }}" class="btn btn-primary">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('style')
    <style>
        .hover-input-popup {
            position: relative;
        }

        .hover-input-popup:hover .input-popup {
            opacity: 1;
            visibility: visible;
        }

        .input-popup {
            position: absolute;
            bottom: 130%;
            left: 50%;
            width: 280px;
            background-color: #1a1a1a;
            color: #fff;
            padding: 20px;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            -ms-border-radius: 5px;
            -o-border-radius: 5px;
            -webkit-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
            opacity: 0;
            visibility: hidden;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

        .input-popup::after {
            position: absolute;
            content: '';
            bottom: -19px;
            left: 50%;
            margin-left: -5px;
            border-width: 10px 10px 10px 10px;
            border-style: solid;
            border-color: transparent transparent #1a1a1a transparent;
            -webkit-transform: rotate(180deg);
            -ms-transform: rotate(180deg);
            transform: rotate(180deg);
        }

        .input-popup p {
            padding-left: 20px;
            position: relative;
        }

        .input-popup p::before {
            position: absolute;
            content: '';
            font-family: 'Line Awesome Free';
            font-weight: 900;
            left: 0;
            top: 4px;
            line-height: 1;
            font-size: 18px;
        }

        .input-popup p.error {
            text-decoration: line-through;
        }

        .input-popup p.error::before {
            content: "\f057";
            color: #ea5455;
        }

        .input-popup p.success::before {
            content: "\f058";
            color: #28c76f;
        }

        .code--control {
            border-top: 0;
            border-left: 0;

        }

    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML =
                    '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
        (function($) {
            @if ($mobile_code)
                $(`option[data-code={{ $mobile_code }}]`).attr('selected','');
            @endif

            $('select[name=country]').change(function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            @if ($general->secure_password)
                $('input[name=password]').on('input',function(){
                secure_password($(this));
                });
            @endif

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response['data'] && response['type'] == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response['data'] != null) {
                        $(`.${response['type']}Exist`).text(`${response['type']} already exist`);
                    } else {
                        $(`.${response['type']}Exist`).text('');
                    }
                });
            });

        })(jQuery);
    </script>
@endpush
