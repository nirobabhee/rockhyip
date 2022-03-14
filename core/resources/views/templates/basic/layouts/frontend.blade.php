<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> {{ $general->sitename(__($pageTitle)) }}</title>
    @include('partials.seo')

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/bootstrap.min.css') }}" />
    <!-- Font Awesome  -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/font-awesome.css') }}" />
    <!-- Line Awesome  -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/line-awesome.css') }}" />
    <!-- Slick  -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/slick.css') }}" />
    <!-- Odometer  -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/odometer-theme-default.css') }}" />
    <!-- Stylesheet Link -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/style.css') }}" />

    @stack('style-lib')

    @stack('style')
    <style>
        .cookie-modal {
            position: fixed;
            top: auto;
            right: auto;
            left: auto;
            bottom: 0;
        }

    </style>
</head>


<body>
    @stack('fbComment')
    <!-- Preloader  -->
    <div class="preloader">
        <div class="preloader__loader">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="body-overlay" id="body-overlay"></div>
    <div class="search-popup" id="search-popup">
        <form action="#" class="search-form">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search....." />
            </div>
            <button type="submit" class="submit-btn xl-text">
                <i class="las la-search"></i>
            </button>
        </form>
    </div>
    <!-- Preloader End -->
    @include($activeTemplate."partials.header_top")
    @include($activeTemplate."partials.header")
    @if (!request()->routeIs('home'))
        @include($activeTemplate."partials.breadcum")
    @endif

    @yield('content')

    <!-- Button trigger modal -->
    @php
        $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
    @endphp
    <!-- Modal -->
    <div class="modal custom--modal fade" id="cookieModal" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="cookieModalLabel" aria-hidden="true">
        <div class="modal-dialog cookie-modal" role="document">
            <div class="modal-content custom">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="cookieModalLabel">@lang('Cookie Policy')</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @php echo @$cookie->data_values->description @endphp
                    <a href="{{ @$cookie->data_values->link }}" target="_blank">@lang('Read Policy')</a>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('cookie.accept') }}" class="btn btn--gamma">@lang('Accept')</a>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <!-- Footer  -->
    @include($activeTemplate."partials.footer")
    <!-- Footer End -->

    <!-- Back To Top -->
    <div class="back-to-top">
        <span class="back-top">
            <i class="las la-angle-up"></i>
        </span>
    </div>
    <!-- Back To Top End -->
    @stack('script-lib')
    @include('partials.plugins')
    @include('partials.notify')
    <script>
        (function($) {
            $(".langSel").on("change", function() {
                window.location.href = "{{ route('home') }}/change/" + $(this).val();
            });
            @if (@$cookie->data_values->status && !session('cookie_accepted'))
                $('#cookieModal').modal('show');
            @endif
        })(jQuery);
    </script>


    <!-- Scripts  -->
    <script src="{{ asset($activeTemplateTrue . 'js/jquery.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/slick.js') }}"></script>
    @if (request()->routeIs('home'))
        <script src="{{ asset($activeTemplateTrue . 'js/particles.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'js/particle-active.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'js/particles-stat.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'js/particles-2.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'js/odometer.js') }}"></script>
        <script src="{{ asset($activeTemplateTrue . 'js/odo-counter.js') }}"></script>
    @endif
    <script src="{{ asset($activeTemplateTrue . 'js/apexcharts.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/app.js') }}"></script>
    @stack('script')
</body>

</html>
