@php
$content = getContent('testimonial.content', true);
$elements = getContent('testimonial.element', false, null, true);
@endphp
<div class="section bg--alpha">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para">
                        {{ __(@$content->data_values->subheading) }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container custom--container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="testimonial-slider">
                    @foreach ($elements as $testimonial)
                        <div class="testimonial-slider__item">
                            <div class="testimonial-card">
                                <div class="testimonial-card__img mx-auto">
                                    <img src="{{ getImage('assets/images/frontend/testimonial/' . @$testimonial->data_values->image,'1000x950') }}"
                                        alt="rockhyip" class="testimonial-card__img-is" />
                                </div>
                                <div class="testimonial-card__header mb-3">
                                    <h5 class="mt-0 mb-1 testimonial-card__title text-center">
                                        {{ __(@$testimonial->data_values->name) }}
                                    </h5>
                                    <h6 class="my-0 testimonial-card__sub-title text-center">
                                        {{ __(@$testimonial->data_values->organization) }}
                                    </h6>
                                </div>
                                <div class="testimonial-card__body mb-3">
                                    <p class="mb-0 t-short-para text-center mx-auto">
                                        {{ __(@$testimonial->data_values->quote) }}
                                        </h6>
                                    </p>
                                </div>
                                <div class="testimonial-card__footer">
                                    <ul class="list list--row justify-content-center">
                                        @php
                                            $r = (int) $testimonial->data_values->rating;
                                        @endphp
                                        @for ($i = 1; $i <= $r; $i++)
                                            <li class="list--row__item text--danger">
                                                <i class="las la-star"></i>
                                            </li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
