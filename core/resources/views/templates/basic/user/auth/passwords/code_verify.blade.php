@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 mt-2">
                    <div class="card custom--card ">

                            <h4 class="text-center">@lang('Verify Your Code')</h4>

                        <div class="card-body">
                            <form method="POST" action="{{ route('user.password.verify.code') }}">
                                @csrf

                                <input type="hidden" name="email" value="{{ $email }}">

                                <div class="col-md-12">
                                    <label for="code" class="my-2 t-heading-font"> @lang('Verification Code')
                                    </label>
                                    <input type="text" name="code" id="code" class="form-control form--control"  placeholder="@lang('Enter Code')">
                                </div>


                                <div class="my-3 plan-card__footer">
                                    <button type="submit" class=" btn btn--gamma btn--lg">
                                        @lang('Verify Code')
                                    </button>
                                </div>

                            </form>
                            <h6 class="mt-3">
                                <div class="form-group">
                                    <h5>@lang('Please check including your Junk/Spam Folder. if not found, you can')
                                        <a href="{{ route('user.password.request') }}">
                                            <button class="btn btn--sm btn-primary rounded-pill mt-2">
                                                @lang('Try to send again')</button>
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
@push('script')
    <script>
        (function($) {
            "use strict";
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
