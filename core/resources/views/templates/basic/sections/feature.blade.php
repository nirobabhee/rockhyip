@php
$content = getContent('feature.content', true);
$element = getContent('feature.element', false, null, true);
@endphp
<div class="section featured-section">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$feature->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para">
                        {{ __(@$feature->data_values->subheading) }}
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row g-3 align-items-lg-center">
            <div class="col-md-6 col-lg-4">
                <div class="row gy-4 gx-3">
                    @foreach ($element as $feature)
                        @if ($loop->odd)
                            <div class="col-12">
                                <div class="feature-card">
                                    <div class="feature-card__icon-float">
                                        @php echo @$feature->data_values->icon @endphp
                                    </div>
                                    <div class="icon icon--md icon--sqr feature-card__icon">
                                        @php echo @$feature->data_values->icon @endphp
                                    </div>
                                    <h4>{{ __(@$feature->data_values->title) }}</h4>
                                    <p class="mb-0">{{ __(@$feature->data_values->description) }} </p>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
            <div class="col-md-6 col-lg-4 d-none d-lg-block">
                <img src="{{ getImage('assets/images/frontend/feature/' . @$content->data_values->image, '1435x995') }}"
                    alt="rockhyip" class="img-fluid" />
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="row gy-4 gx-3">
                    @foreach ($element as $feature)
                        @if ($loop->even)
                            <div class="col-12">
                                <div class="feature-card">
                                    <div class="feature-card__icon-float">
                                        @php echo @$feature->data_values->icon @endphp
                                    </div>
                                    <div class="icon icon--md icon--sqr feature-card__icon">
                                        @php echo @$feature->data_values->icon @endphp
                                    </div>
                                    <h4>{{ __(@$feature->data_values->title) }}</h4>
                                    <p class="mb-0">{{ __($feature->data_values->description) }} </p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
