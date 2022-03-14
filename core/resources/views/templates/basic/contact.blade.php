@php
$content = getContent('contact_us.content', true);
$element = getContent('contact_us.element', false, null, true);
@endphp
@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!-- Contact Page  -->
    <div class="section">
        <div class="container">
            <div class="row gy-5 gx-lg-4 justify-content-center align-items-center">
                <div class="col-md-7 col-xl-10">
                    <div class="row">
                        @foreach ($element as $item)
                            <div class="col-md-4">
                                <div class="d-flex contact-card">
                                    <div class="icon icon--md icon--circle feature-card__icon me-3 flex-shrink-0">
                                        @php echo $item->data_values->icon @endphp
                                    </div>
                                    <div class="contact-card__content">
                                        <h5 class="mt-0 mb-2 contact-card__title">
                                            {{ __(@$item->data_values->title) }}
                                        </h5>
                                        <p class="mb-0 t-short-para sm-text">
                                            {{ @$item->data_values->content }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-md-7 col-xl-10">
                    <div class="login-form">
                        <form method="post" action="" class="row">
                            @csrf
                            <div class="col-12">
                                <h3 class="mt-0 fw-md">
                                   {{ __(@$content->data_values->title)}}
                                </h3>
                            </div>
                            <div class="col-md-6 mb-4 mt-0">
                                <label for="name" class="mb-2 t-heading-font">
                                    @lang('Name') <small class="text--danger">*</small>
                                </label>
                                <input name="name" type="text" id="name" class="form-control form--control"
                                    placeholder="Enter name" {{ old('name') }} required />
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="email-address" class="mb-2 t-heading-font">
                                    @lang('Email') <small class="text--danger">*</small>
                                </label>
                                <input name="email" type="email" id="email-address" class="form-control form--control"
                                    placeholder="Enter Email address" {{ old('email') }} required />
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="email-address" class="mb-2 t-heading-font">
                                    @lang('Subject') <small class="text--danger">*</small>
                                </label>
                                <input name="subject" type="text" id="subject" class="form-control form--control"
                                    placeholder="Enter subject" value="{{ old('subject') }}" required />
                            </div>
                            <div class="col-12 mb-4">
                                <label for="message" class="mb-2 t-heading-font">
                                    @lang(' Message') <small class="text--danger">*</small>
                                </label>
                                <textarea name="message" class="form-control form--control-textarea" wrap="off" rows="5"
                                    placeholder="Your Message" required>{{ old('message') }}</textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn--xl btn--gamma">@lang('Send Message')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($sections->secs != null)
                @foreach (json_decode($sections->secs) as $sec)
                    @include($activeTemplate.'sections.'.$sec)
                @endforeach
            @endif
        </div>
    </div>
    <!-- Contact Page End -->
@endsection
