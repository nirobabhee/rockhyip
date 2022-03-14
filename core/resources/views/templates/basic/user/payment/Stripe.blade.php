@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner__content">
            <div class="container">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h1 class="mt-0">{{ __($pageTitle) }}</h1>
                        <ul class="list list--row breadcrumbs justify-content-center">
                            <li class="list--row__item breadcrumbs__item">
                               @lang('Home - Stype Payment')
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->
    <div class="container section mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card custom--card card-deposit">
                    <div class="card-header">
                        <h5 class="card-title">@lang('Stripe Payment')</h5>
                    </div>
                    <div class="card-body">
                        <div class="card-wrapper"></div>
                        <br><br>

                        <form role="form" id="payment-form" method="{{ $data->method }}" action="{{ $data->url }}">
                            @csrf
                            <input type="hidden" value="{{ $data->track }}" name="track">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">@lang('Name on Card')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form--control" name="name"
                                            placeholder="@lang('Name on Card')" autocomplete="off" autofocus />
                                        <span class="input-group-text input-group-append"><i
                                                class="fa fa-font"></i></span>

                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <label for="cardNumber">@lang('Card Number')</label>
                                    <div class="input-group">
                                        <input type="tel" class="form-control form--control" name="cardNumber"
                                            placeholder="@lang('Valid Card Number')" autocomplete="off" required
                                            autofocus />
                                        <span class="input-group-append input-group-text"><i
                                                class="fa fa-credit-card"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="cardExpiry">@lang('Expiration Date')</label>
                                    <input type="tel" class="form-control form--control input-sz" name="cardExpiry"
                                        placeholder="@lang('MM / YYYY')" autocomplete="off" required />
                                </div>
                                <div class="col-md-6 ">
                                    <label for="cardCVC">@lang('CVC Code')</label>
                                    <input type="tel" class="form-control form--control input-sz" name="cardCVC"
                                        placeholder="@lang('CVC')" autocomplete="off" required />
                                </div>
                            </div>
                            <br>
                            <button class="btn btn--gamma btn-lg btn-block text-center" type="submit"> @lang('PAY NOW')
                            </button>

                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
    <script src="{{ asset('assets/global/js/card.js') }}"></script>

    <script>
        (function($) {
            var card = new Card({
                form: '#payment-form',
                container: '.card-wrapper',
                formSelectors: {
                    numberInput: 'input[name="cardNumber"]',
                    expiryInput: 'input[name="cardExpiry"]',
                    cvcInput: 'input[name="cardCVC"]',
                    nameInput: 'input[name="name"]'
                }
            });
        })(jQuery);
    </script>
@endpush
