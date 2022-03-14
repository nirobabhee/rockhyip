@php
$content = getContent('profit.content', true);
$element = getContent('profit.element', false, null, true);
@endphp
<div class="section featured-section">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __($content->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para">
                        {{ __($content->data_values->subheading) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row gy-4 justify-content-center">
            @foreach ($element as $item)
                <div class="col-md-6 col-lg-4 col-xl-3">

                    <div class="feature-card">
                        <div class="stat-card__icon flex-shrink-0 bg--gamma p-2 rounded">
                            @php
                                echo $item->data_values->icon;
                            @endphp
                        </div>
                        <h4>{{ __($item->data_values->title) }}</h4>
                        <p class="mb-0">
                            {{ __($item->data_values->description) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
