<!-- Footer  -->
@php
$contentFooter = getContent('footer.content', true);
$contentAbout = getContent('about.content', true);
$elementIcon = getContent('social_icon.element', false, null, true);
$elementPolicy = getContent('policy_pages.element', false, null, true);
$contentSubscribe = getContent('subscribe.content', true);
@endphp

<footer class="footer"
    style="background-image: url({{ getImage('assets/images/frontend/footer/' . @$contentFooter->data_values->image, '1920x1080') }})">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <h4 class="mt-0">{{ __(@$contentAbout->data_values->heading) }}</h4>
                    <p class="t-short-para">{{ __(@$contentAbout->data_values->description) }} </p>
                    <ul class="list list--row">
                        @foreach ($elementIcon as $icon)
                            <li class="list--row__item" title="{{ @$icon->data_values->title }}"> <a target="_blank"
                                    class=" t-link
                            icon icon--circle icon--xs
                            header-top__social-icon"
                                    href="{{ @$icon->data_values->url }}">@php
                                        echo @$icon->data_values->social_icon;
                                    @endphp</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h4 class="mt-0">@lang('Quick Menu')</h4>
                    <ul class="list list--column">
                        <li class="list--column__item">
                            <a href="{{ route('home') }}" class="t-link t-link--danger text--white">
                                @lang('Home')
                            </a>
                        </li>
                        <li class="list--column__item">
                            <a href="{{ route('all.plan') }}" class="t-link t-link--danger text--white">
                                @lang('Plan')
                            </a>
                        </li>
                        <li class="list--column__item">
                            <a href="{{ route('blog') }}" class="t-link t-link--danger text--white">
                                @lang('Blog')
                            </a>
                        </li>
                        <li class="list--column__item">
                            <a href="{{ route('all.plan') }}" class="t-link t-link--danger text--white">
                                @lang('Contact')
                            </a>
                        </li>

                    </ul>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h4 class="mt-0">@lang('Important Link')</h4>
                    <ul class="list list--column">
                        @foreach ($elementPolicy as $policy)
                            <li class="list--column__item">
                                <a class="t-link t-link--danger text--white"
                                    href="{{ route('policy.page', [slug($policy->data_values->title), $policy->id]) }}">
                                    {{ @$policy->data_values->title }}
                                </a>
                            </li>
                            @if (!$loop->last)  @endif
                        @endforeach

                    </ul>
                </div>
                <div class="col-md-6 col-lg-3">
                    <h4 class="mt-0">{{ __(@$contentSubscribe->data_values->heading) }}</h4>
                    <p class="t-short-para">
                        {{ __(@$contentSubscribe->data_values->subheading) }}
                    </p>
                    <form class="form">
                        <div class="newsletter rounded-pill">
                            <div class="newsletter__container rounded-pill">
                                <input type="email" name="subscribe"
                                    class="form-control form--control newsletter__input flex-grow-1 rounded-pill"
                                    placeholder="Subscribe now.." required />
                                <button type="submit" class="btn btn--xl btn--gamma rounded-pill" id="subsSave">
                                    @lang('Subscribe')
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p class="mb-0 sm-text text-center">
            @lang('Copyright ©') {{ \Carbon\Carbon::now()->format('Y') }}
            @lang('All Right Reserved By') <a class="text-decoration-none"
                href="{{ route('home') }}">{{ @$general->sitename }}</a>
        </p>
    </div>
</footer>
<!-- Footer End -->
{{-- Subscribe --}}
<script>
    $(document).ready(function() {

        $('.form').on('submit', function(e) {
            e.preventDefault();

            var email = $("[name='subscribe']").val();
            if (email) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('subscribe') }}",
                    type: "POST",
                    data: {
                        email: email,
                    },
                    success: function(data) {
                        if (data.success) {
                            notify('success', data.success);
                        } else {
                            notify('error', data.error);
                        }
                        $('input[name="subscribe"]').val('');
                    }
                });
            } else {
                notify('error', 'Please fill the E-mail field');
            }
        });
    });
</script>
