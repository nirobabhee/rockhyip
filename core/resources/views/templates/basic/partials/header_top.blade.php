@php
$content = getContent('contact_us.content', true);
$element = getContent('social_icon.element');
@endphp

<div class="header-top">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="list list--row align-items-center justify-content-center">
                    <li class="list--row__item">
                        <a href="tel:{{ $content->data_values->phone }}"
                            class="t-link d-flex align-items-center">
                            <span class="me-2 d-inline-block xxl-text lh-1 text--danger">
                                <i class="las la-mobile-alt"></i>
                            </span>
                            <span class="sm-text text--white d-none d-md-inline-block">
                                {{ $content->data_values->phone }}
                            </span>
                        </a>
                    </li>
                    <li class="list--row__item">
                        <a href="mailto:{{ $content->data_values->email }}"
                            class="t-link d-flex align-items-center">
                            <span class="me-2 d-inline-block xxl-text lh-1 text--danger">
                                <i class="las la-envelope"></i>
                            </span>
                            <span class="sm-text text--white d-none d-md-inline-block">
                                {{ $content->data_values->email }}
                            </span>
                        </a>
                    </li>
                    <li class="list--row__item ms-md-auto">
                        <select class="langSel form-select form--select-sm">
                            <option value="">@lang('Select One')</option>
                            @foreach ($language as $item)
                                <option value="{{ $item->code }}" @if (session('lang') == $item->code) selected  @endif>{{ __($item->name) }}
                                </option>
                            @endforeach
                        </select>
                    </li>

                    @foreach ($element as $icon)
                        <li class="list--row__item" title="{{ $icon->data_values->title }}"> <a target="_blank" class=" t-link
                            icon icon--circle icon--xs
                            header-top__social-icon"
                                href="{{ $icon->data_values->url }}">@php
                                    echo $icon->data_values->social_icon;
                                @endphp</a></li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
