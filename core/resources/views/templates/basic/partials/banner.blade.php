@php
$content = getContent('banner.content', true);
@endphp
<div class="hero">
    <div id="particles-js"></div>
    <div class="hero__content">
        <div class="container">
            <div class="row g-3 justify-content-center align-items-center">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <div class="text-center text-lg-start">
                        <h1 class="hero__content-title text--white mb-4">
                            {{ __(@$content->data_values->heading) }}
                        </h1>
                        <p class="text--white t-short-para mx-auto ms-lg-0">
                            {{ __(@$content->data_values->subheading) }}
                        </p>
                        @guest
                            <a href="{{ @$content->data_values->url }}" class="btn btn--xxl btn--gamma mt-3">

                                {{ __(@$content->data_values->button_name) }}
                            </a>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-5 col-xl-6 d-none d-lg-block">
                    <div class="hero__img">
                        <img src="{{ getImage('assets/images/frontend/banner/' . @$content->data_values->image, '1435x995') }}"
                            alt="rockhyip" class="img-fluid hero__img-is" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
