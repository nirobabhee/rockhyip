@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-7 col-lg-7">
                    <div class="card custom--card ">
                        <h4 class="text-center">@lang('Reset Password')</h4>
                        <div class="card-body ">
                            <form method="POST" action="{{ route('user.password.email') }}">
                                @csrf
                                <div class="col-md-12">
                                    <label for="first-name" class="mb-2 t-heading-font col-form-label"> @lang('Select One')
                                    </label>
                                    <select class="form-control form--control" name="type">
                                        <option value="email">@lang('E-Mail Address')</option>
                                        <option value="username">@lang('Username')</option>
                                    </select>
                                </div>
                                <div class="col-md-12 justify-content-center">
                                    <label for="first-name" class="my-3 t-heading-font col-form-label my_value"></label>
                                    <input type="text"
                                        class="form-control form--control @error('value') is-invalid @enderror" name="value"
                                        value="{{ old('value') }}" autocomplete="off" />
                                    @error('value')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="plan-card__footer mt-3">
                                    <button type="submit" class=" btn btn--gamma btn--lg">
                                        @lang('Send Password Code')
                                    </button>
                                </div>
                            </form>
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

            myVal();
            $('select[name=type]').on('change', function() {
                myVal();
            });

            function myVal() {
                $('.my_value').text($('select[name=type] :selected').text());
            }
        })(jQuery)
    </script>
@endpush
