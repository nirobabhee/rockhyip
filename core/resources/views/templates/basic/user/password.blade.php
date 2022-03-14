@extends($activeTemplate.'layouts.frontend')

@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner__content">
            <div class="container">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h1 class="mt-0">@lang('Change Password')</h1>
                        <ul class="list list--row breadcrumbs justify-content-center">
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('home') }}"
                                    class="t-link breadcrumbs__link text--white t-link--gamma">@lang('Home')</a>
                            </li>
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('user.change.password') }}"
                                    class="t-link breadcrumbs__link text--danger t-link--gamma">@lang('Change Password')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <div class="section bg--alpha">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card custom--card">
                        <div class="justify-content-center">
                            <h4 class="text-center text--danger">@lang('Change Your Password')</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" class="register">
                                @csrf
                                <div class="form-group">
                                    <label for="password" class="my-2  t-heading-font">@lang('Current Password')</label>
                                    <input id="password" type="password" class="form-control form--control"
                                        name="current_password" required autocomplete="current-password"
                                        placeholder="@lang('Current Password')">
                                </div>
                                <div class="col-md-12 hover-input-popup">
                                    <label for="password" class="my-2 t-heading-font">@lang('Password')</label>
                                    <input id="password" type="password" class="form-control form--control" name="password"
                                        required autocomplete="current-password" placeholder="@lang('New Password')">
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
                                <div class="col-md-12">
                                    <label for="confirm_password" class="my-2 t-heading-font">@lang('Confirm
                                        Password')</label>
                                    <input id="password_confirmation" type="password" class="form-control form--control"
                                        name="password_confirmation" required autocomplete="current-password"
                                        placeholder="@lang('Confirm Password')">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="mt-4 btn btn--gamma" value="@lang('Change Password')">
                                </div>
                            </form>
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
