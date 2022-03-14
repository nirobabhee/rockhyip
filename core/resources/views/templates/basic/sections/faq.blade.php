@php
$content = getContent('faq.content', true);
$elements = getContent('faq.element', false, null, true);

@endphp
<div class="section faq-section"
    style="background-image: url({{ getImage('assets/images/frontend/faq/' . @$content->data_values->background_image,'2000X1350') }})">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para">
                        {{ __(@$content->data_values->sub_heading) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="accordion custom--accordion" id="accordionExample">
                    @foreach ($elements as $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button {{ !$loop->first ? 'collapsed' : null }}"
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq_{{ $loop->index }}"
                                    aria-expanded="{{ !$loop->first ? 'false' : 'true' }}">
                                    {{ __(@$item->data_values->question) }}
                                </button>
                            </h2>
                            <div id="faq_{{ $loop->index }}"
                                class="accordion-collapse collapse {{ $loop->first ? 'show' : null }}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body"> {{ __(@$item->data_values->answer) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
