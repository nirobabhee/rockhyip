<header class="header header--primary">
    <div class="container">
        <div class="row g-0 align-items-center">
            <div class="col-6 col-lg-2">
                <a href="{{ route('home') }}"><img
                        src="{{ getImage(imagePath()['logoIcon']['path'] . '/logo.png') }}"
                        alt="{{ __($general->sitename) }}" class="img-fluid logo__is"></a>
                <!-- Logo End -->
            </div>
            <div class="col-6 col-lg-10">
                <div class="nav-container">
                    <!-- Navigation Toggler  -->
                    <div class="d-flex justify-content-end align-items-center d-lg-none">
                        <a href="#" class="  primary-menu__link t-link search--toggler text-center text--white">
                            <i class="las la-search"></i>
                        </a>
                        <button type="button" class="btn btn--sqr btn--gamma nav--toggle text--white">
                            <i class="las la-bars"></i>
                        </button>
                    </div>
                    <!-- Navigation Toggler End -->
                    <!-- Navigation  -->
                    <nav class="navs">
                        <!-- Primary Menu  -->
                        <ul class="list primary-menu">
                            @auth
                                @if (request()->routeIs('home'))
                                    <li class="primary-menu__list">
                                        <a href="{{ route('home') }}" class="primary-menu__link text-capitalize">
                                            @lang('Home')
                                        </a>
                                    </li>
                                @else
                                    <li class="primary-menu__list">
                                        <a href="{{ route('user.home') }}" class="primary-menu__link text-capitalize">
                                            @lang('Dashboard')
                                        </a>
                                    </li>
                                @endif
                            @endauth
                            @guest
                                <li class="primary-menu__list">
                                    <a href="{{ route('home') }}" class="primary-menu__link text-capitalize">
                                        @lang('Home')
                                    </a>
                                </li>
                            @endguest
                            <li class="primary-menu__list">
                                <a href="{{ route('all.plan') }}" class="primary-menu__link text-capitalize">
                                    @lang('Plan')
                                </a>
                            </li>
                            @if ($pages)
                                @foreach ($pages as $k => $data)
                                    <li class="primary-menu__list {{ menuActive('pages', [$data->slug]) }}">
                                        <a href="{{ route('pages', [$data->slug]) }}"
                                            class="primary-menu__link text-capitalize">{{ __($data->name) }}</a>
                                    </li>
                                @endforeach
                            @endif
                            <li class="primary-menu__list">
                                <a href="{{ route('blog') }}" class="primary-menu__link text-capitalize">
                                    @lang('Blog')
                                </a>
                            </li>
                            @if (request()->routeIs('home'))
                                @auth
                                    <li class="primary-menu__list">
                                        <a href="{{ route('contact') }}" class="primary-menu__link text-capitalize">
                                            @lang('Contact')
                                        </a>
                                    </li>
                                @endauth
                            @endif
                            @guest
                                <li class="primary-menu__list">
                                    <a href="{{ route('contact') }}" class="primary-menu__link text-capitalize">
                                        @lang('Contact')
                                    </a>
                                </li>
                            @endguest
                            @auth
                                @if (!request()->routeIs('home'))
                                    <li class="primary-menu__list has-sub">
                                        <a href="#" class="primary-menu__link text-capitalize">
                                            @lang('Deposit')
                                        </a>
                                        <ul class="primary-menu__sub">
                                            <li class="primary-menu__sub-list">
                                                <a href="{{ route('user.deposit') }}"
                                                    class="t-link primary-menu__sub-link text-capitalize">
                                                    @lang('Deposit')</a>
                                                </a>
                                            </li>
                                            <li class="primary-menu__sub-list">
                                                <a href="{{ route('user.deposit.history') }}"
                                                    class="t-link primary-menu__sub-link  text-capitalize">
                                                    @lang('Deposit History')</a>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="primary-menu__list has-sub">
                                        <a href="#" class="primary-menu__link text-capitalize">
                                            @lang('Withdraw')
                                        </a>
                                        <ul class="primary-menu__sub">
                                            <li class="primary-menu__sub-list">
                                                <a href="{{ route('user.withdraw') }}"
                                                    class="t-link primary-menu__sub-link text-capitalize">
                                                    @lang('Withdraw')</a>
                                                </a>
                                            </li>
                                            <li class="primary-menu__sub-list">
                                                <a href="{{ route('user.withdraw.history') }}"
                                                    class="t-link primary-menu__sub-link  text-capitalize">
                                                    @lang('Withdraw History')</a>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="primary-menu__list has-sub">
                                        <a href="{{ route('user.home') }}" class="primary-menu__link text-capitalize">
                                            @lang('Ticket')
                                        </a>
                                        <ul class="primary-menu__sub">
                                            <li class="primary-menu__sub-list">
                                                <a href="{{ route('ticket.open') }}"
                                                    class="t-link primary-menu__sub-link text-capitalize">
                                                    @lang('Create Ticket')</a>
                                                </a>
                                            </li>
                                            <li class="primary-menu__sub-list">
                                                <a href="{{ route('ticket') }}"
                                                    class="t-link primary-menu__sub-link  text-capitalize">
                                                    @lang('My Ticket')</a>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @endauth
                        </ul>
                        <!-- Primary Menu End -->
                        <!-- User Login  -->
                        <div class="mx-3 ms-lg-auto me-lg-0">
                            <ul class="list justify-content-center primary-menu primary-menu--alt">
                                @guest
                                    <li class="list--row__item text-center">
                                        <a href="{{ route('user.login') }}" class="btn btn--md btn--gamma fw-md w-100">
                                            @lang('Join Now')
                                        </a>
                                    </li>
                                    <li class="list--row__item text-center">
                                        <a href="{{ route('user.register') }}"
                                            class="btn btn--md btn--gamma fw-md w-100">
                                            @lang('Sign Up Now')
                                        </a>
                                    </li>
                                @endguest
                                @auth
                                @if (request()->routeIs('home'))
                                <li class="primary-menu__list">
                                    <a href="{{ route('user.home') }}"class="btn btn--md btn--gamma fw-md w-100">
                                        @lang('Dashboard')
                                    </a>
                                </li>
                                @else
                                <li class="primary-menu__list list--row__item text-center has-sub">
                                    <a href="{{ route('user.home') }}" class="btn btn--md btn--gamma fw-md w-100">
                                        {{ __(ucwords(auth()->user()->username)) }}
                                    </a>
                                    <ul class="primary-menu__sub">
                                        <li class="primary-menu__sub-list">
                                            <a class="t-link primary-menu__sub-link text-capitalize"
                                                href="{{ route('user.invested.plans') }}">
                                                @lang('My Plans')
                                            </a>
                                        </li>
                                        <li class="primary-menu__sub-list">
                                            <a class="t-link primary-menu__sub-link text-capitalize"
                                                href="{{ route('user.profile.setting') }}">
                                                @lang('Profile Setting')
                                            </a>
                                        </li>
                                        <li class="primary-menu__sub-list">
                                            <a class="t-link primary-menu__sub-link  text-capitalize"
                                                href="{{ route('user.change.password') }}">
                                                @lang('Change Password')
                                            </a>
                                        </li>
                                        <li class="primary-menu__sub-list">
                                            <a class="t-link primary-menu__sub-link text-capitalize"
                                                href="{{ route('user.twofactor') }}">
                                                @lang('2FA Security')
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                                    <li class="list--row__item text-center">
                                        <a href="{{ route('user.logout') }}" class="btn btn--md btn--gamma fw-md w-100">
                                            @lang('Logout')
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                        <!-- User Login End -->
                    </nav>
                    <!-- Navigation End -->
                </div>
            </div>
        </div>
    </div>
</header>
