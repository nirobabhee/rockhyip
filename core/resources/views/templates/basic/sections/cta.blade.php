@php
$content = getContent('cta.content', true);
@endphp
<div class="section--sm cta-section"
style="background-image: url({{ getImage('assets/images/frontend/cta/' . @$content->data_values->background_image,'1920x550') }})"
>
    <div class="container">
        <div class="row gy-4 align-items-center">
            <div class="col-md-7 col-xl-6">

                <h2 class="mt-0">{{ __(@$content->data_values->title) }}</h2>
                <p class="t-short-para">
                    {{ __(@$content->data_values->subtitle) }}
                </p>
                    <a href="{{ $content->data_values->url }}" class="btn btn--xxl btn--gamma mt-3">
                        {{__($content->data_values->button_name)}}
                    </a>

            </div>
            <div class="col-md-5 col-xl-6">
                <img src="{{ getImage('assets/images/frontend/cta/' . @$content->data_values->image, '1000x550') }}"
                    alt="{{ __($general->sitename) }}" class="img-fluid cta-section__img" />
            </div>
        </div>
    </div>
</div>
