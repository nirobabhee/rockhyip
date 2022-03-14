@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner__content">
            <div class="container">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h1 class="mt-0">@lang('Two Factor Security')</h1>
                        <ul class="list list--row breadcrumbs justify-content-center">
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('home') }}"
                                    class="t-link breadcrumbs__link text--white t-link--gamma">@lang('Home')</a>
                            </li>
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('user.twofactor') }}"
                                    class="t-link breadcrumbs__link text--danger t-link--gamma">@lang('Two Factor
                                    Security')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <div class="section bg--alpha">
        <div class="row justify-content-center">
            <div class="card custom--card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <h4 class="card-title my-3 d-flex justify-content-center">@lang('Two Factor Authenticator')</h4>
                    @if (Auth::user()->ts)
                        <div class="card-header mx-auto text-center">
                            <a href="#0" class="btn btn-block btn-lg btn-danger" data-toggle="modal"
                                data-target="#disableModal">
                                @lang('Disable Two Factor Authenticator')</a>
                        </div>
                    @else
                        <div class="col-md-4">
                            <div class="card-body">
                                <img src="{{ $qrCodeUrl }}" class="img-fluid rounded-start" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="input-group mb-2">
                                    <input type="text" name="key" value="{{ $secret }}"
                                        class="form-control form--control text-white" id="secrectURL" readonly>
                                    <span class="input-group-text copytext" id="copyBoard"><i
                                            class="fa fa-copy"></i></span>
                                </div>
                                <h6>@lang('If you have any problem with scanning the QR code enter this code manually
                                    into the APP.')</h6>
                                <div class="col-12 mx-auto text-center">
                                    <button class="btn btn--xl btn--gamma mt-3" data-toggle="modal"
                                        data-target="#enableModal">
                                        @lang('Enable Two Factor Authenticator')
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <p>@lang('Google Authenticator is a multifactor app for mobile devices. It generates timed codes
                            used during the 2-step verification process..Use Google Authentication App to scan the QR
                            code.')
                            <a
                                href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en">
                                <button class="btn btn--sm btn-primary rounded-pill mt-2">
                                    @lang('App Download')</button>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Enable Modal -->
    <div id="enableModal" class="modal custom--modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content ">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Your Otp')</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.twofactor.enable') }}" method="POST">
                    @csrf
                    <div class="modal-body ">
                        <div class="form-group">
                            <input type="hidden" name="key" value="{{ $secret }}">
                            <input type="text" class="form-control form--control" name="code"
                                placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('close')</button>
                        <button type="submit" class="btn btn-success">@lang('verify')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--Disable Modal -->
    <div id="disableModal" class="modal custom--modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Verify Your Otp Disable')</h4>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('user.twofactor.disable') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control form--control" name="code"
                                placeholder="@lang('Enter Google Authenticator Code')">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn-success">@lang('Verify')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            $('.copytext').on('click', function() {
                var copyText = document.getElementById("secrectURL");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                iziToast.success({
                    message: "Copied: " + copyText.value,
                    position: "topRight"
                });
            });
        })(jQuery);
    </script>
@endpush
