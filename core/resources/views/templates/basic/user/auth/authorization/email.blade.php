@extends($activeTemplate .'layouts.frontend')
@section('content')

    <div class=" section">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="quickview-card">
                    <div class="quickview-card__head">
                        <h6>@lang('Please Verify Your Email to Get Access')</h6>
                    </div>
                    <div class="quickview-card__body mt-3">
                        <p class="mb-0 quickview-card__body-text sm-text">
                        <form action="{{ route('user.verify.email') }}" method="POST" class="login-form">
                            @csrf
                            <div class="col-12 mt-0">
                                <h5 class="text-center">@lang('Your Email'):
                                    <strong>{{ auth()->user()->email }}</strong>
                                </h5>
                            </div>
                            <div>
                                <label class="mb-2 t-heading-font">@lang('Verification Code')</label>
                                <input type="text" name="email_verified_code" class="form-control form--control"
                                    maxlength="7" id="code">
                            </div>
                            <div class="col-12 mt-3 text-center">
                                <button type="submit" class="btn btn--xl btn--gamma">
                                    @lang('Submit Now')
                                </button>
                            </div>
                        </form>
                        </p>
                        <h6 class="mt-3 mb-0 ">
                            <div class="form-group">
                                <h5>@lang('Please check including your Junk/Spam Folder. if not found, you can') <a
                                        href="{{ route('user.send.verify.code') }}?type=email" class="forget-pass">
                                        <button class="btn btn--sm btn-primary rounded-pill"> @lang('Resend code')</button>
                                    </a></h5>
                                @if ($errors->has('resend'))
                                    <br />
                                    <small class="text--dark">{{ $errors->first('resend') }}</small>

                                @endif
                            </div>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        (function($) {
            $('#code').on('input change', function() {
                var xx = document.getElementById('code').value;

                $(this).val(function(index, value) {
                    value = value.substr(0, 7);
                    return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
                });

            });
        })(jQuery)
    </script>
@endpush
