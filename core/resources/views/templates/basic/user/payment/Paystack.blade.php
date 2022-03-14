@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="container section mt-2">
        <div class="card custom--card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ $deposit->gatewayCurrency()->methodImage() }}"
                        class="img-fluid rounded-start" />
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text">
                        <form action="{{ route('ipn.' . $deposit->gateway->alias) }}" method="POST"
                            class="text-center">
                            @csrf
                            <h3>@lang('Please Pay') {{ showAmount($deposit->final_amo) }}
                                {{ __($deposit->method_currency) }}</h3>
                            <h3 class="my-3">@lang('To Get') {{ showAmount($deposit->amount) }}
                                {{ __($general->cur_text) }}</h3>
                            <button type="button" class=" mt-4 btn--gamma btn-round custom-success text-center btn-lg"
                                id="btn-confirm">@lang('Pay Now')</button>
                            <script src="//js.paystack.co/v1/inline.js" data-key="{{ $data->key }}" data-email="{{ $data->email }}"
                                                        data-amount="{{ $data->amount }}" data-currency="{{ $data->currency }}"
                                                        data-ref="{{ $data->ref }}" data-custom-button="btn-confirm">
                            </script>
                        </form>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
