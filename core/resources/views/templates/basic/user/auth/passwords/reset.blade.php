@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 mt-2">
                    <div class="card custom--card ">
                        <h4 class="text-center">@lang('Reset Your Password')</h4>
                        <div class="card-body">
                            <form method="POST" action="{{ route('user.password.update') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="col-md-12  hover-input-popup">
                                    <label for="password" class="my-2 t-heading-font"> @lang('Password')
                                    </label>
                                    <input id="password" type="password"
                                        class="form-control form--control @error('password') is-invalid @enderror"
                                        name="password" placeholder="@lang('Password')" required>
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

                                <div class="col-md-12 justify-content-center">
                                    <label for="password-confirm" class="my-2 t-heading-font"> @lang('Confirm Password')
                                    </label>
                                    <input id="password-confirm" type="password"
                                        class="form-control form--control @error('password') is-invalid @enderror"
                                        name="password_confirmation" placeholder="@lang('Confirm Password')" required>
                                </div>

                                <div class="plan-card__footer mt-2">
                                    <button type="submit" class=" btn btn--gamma btn--lg">
                                        @lang('Verify Code')
                                    </button>
                                </div>

                            </form>
                            <h6 class="mt-2">
                                <div class="form-group">
                                    <h5>
                                        <p class="d-inline">@lang('Have an account? ')</p>
                                        <a href="{{ route('user.login') }}">
                                            <button class="btn btn--sm btn-primary rounded-pill d-inline">
                                                @lang('Login')</button>
                                        </a>
                                    </h5>
                                </div>
                            </h6>
                        </div>
                    </div>
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

    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/global/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            @if ($general->secure_password)
                $('input[name=password]').on('input',function(){
                secure_password($(this));
                });
            @endif
        })(jQuery);
    </script>
@endpush
