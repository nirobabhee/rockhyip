@php
$content = getContent('payment.content', true);
$element = getContent('payment.element', false, null, true);
@endphp
<div class="section accepted-payment-section bg--alpha">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para">
                        {{ __(@$content->data_values->subheading) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="payment-slider">
                    @foreach ($element as $payment)
                    <div class="payment-slider__item">
                        <div class="payment-slider__img">
                            <img src="{{ getImage('assets/images/frontend/payment/' . @$payment->data_values->image,'400X400') }}" alt="rockhyip"
                                class="payment-slider__img-is" />
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
