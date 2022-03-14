@php
$content = getContent('choose_reason.content', true);
$element = getContent('choose_reason.element', false, null, true);
@endphp
<div class="section choice-section"
    style="background-image: url({{ getImage('assets/images/frontend/choose_reason/' . $content->data_values->background_image, '1920x1080') }})">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __($content->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para">{{ __($content->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row g-3">
            @foreach ($element as $strength)
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card bg--alpha text-center">
                        <div class="feature-card__icon-float">
                            @php
                                echo $strength->data_values->icon;
                            @endphp
                        </div>
                        <div class="icon icon--md icon--sqr feature-card__icon">
                            @php
                                echo $strength->data_values->icon;
                            @endphp
                        </div>
                        <h4>{{ __($strength->data_values->title) }}</h4>
                        <p class="mb-0">{{ __($strength->data_values->description) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
