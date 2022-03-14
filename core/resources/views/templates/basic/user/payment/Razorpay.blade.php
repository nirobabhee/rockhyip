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
                            @lang('Home - Razorpay')
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->
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
                        <h3 class="text-center">@lang('Please Pay') {{showAmount($deposit->final_amo)}} {{$deposit->method_currency}}</h3>
                        <h3 class="my-3 text-center">@lang('To Get') {{showAmount($deposit->amount)}}  {{__($general->cur_text)}}</h3>
                    <form action="{{$data->url}}" method="{{$data->method}}">
                        <input type="hidden" custom="{{$data->custom}}" name="hidden">
                        <script src="{{$data->checkout_js}}"
                                @foreach($data->val as $key=>$value)
                                data-{{$key}}="{{$value}}"
                            @endforeach >
                        </script>
                    </form>
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@push('script')
    <script>
        (function ($) {
            $('input[type="submit"]').addClass("ml-4 mt-4 btn-custom2 btn--gamma text-center mx-auto btn-lg");
        })(jQuery);
    </script>
@endpush
