@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner__content">
            <div class="container">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h1 class="mt-0">@lang('Blog Details')</h1>
                        <ul class="list list--row breadcrumbs justify-content-center">
                            <li class="list--row__item breadcrumbs__item">
                                <a href="index.html"
                                    class="t-link breadcrumbs__link text--white t-link--gamma">@lang('Home')</a>
                            </li>
                            <li class="list--row__item breadcrumbs__item">
                                <a href="blog.html"
                                    class="t-link breadcrumbs__link text--white t-link--gamma">@lang('Blog')</a>
                            </li>
                            <li class="list--row__item breadcrumbs__item">
                                <a href="blog-details.html" class="t-link breadcrumbs__link text--danger t-link--gamma">
                                    @lang('Blog
                                    Details')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Blog -->
    <div class="section">
        <div class="container">
            <div class="row gy-5 gy-lg-0">
                <div class="col-lg-8">
                    <div class="blog-post">
                        <img src="{{ getImage('assets/images/frontend/blog/' . @$blog->data_values->image_1) }}"
                            alt="viserfly" class="img-fluid w-100" />
                        <div class="blog-post__body">

                            <h4 class="mt-0 fw-md">
                                {{ __(@$blog->data_values->title) }}
                            </h4>
                            <p class="mt-4">
                                @php echo __(@$blog->data_values->details) @endphp
                            </p>
                            <div class="my-5">
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <img src="{{ getImage('assets/images/frontend/blog/' . @$blog->data_values->image_1, '800x800') }}"
                                            alt="viserfly" class="blog-post__img-is rounded" />
                                    </div>
                                    <div class="col-md-6">
                                        <img src="{{ getImage('assets/images/frontend/blog/' . @$blog->data_values->image_2, '800x800') }}"
                                            alt="viserfly" class="blog-post__img-is rounded" />
                                    </div>
                                </div>
                            </div>
                            <div class="my-5">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <ul class="list list--row   align-items-center justify-content-md-end">
                                            <li class="list--row__item">@lang('Share'):</li>
                                            <li class="list--row__item">
                                                <a class="t-link social-icon--alt"
                                                    href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li class="list--row__item">
                                                <a class="t-link social-icon--alt"
                                                    href="https://twitter.com/intent/tweet?text=my share text&amp;url={{ urlencode(url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="list--row__item">
                                                <a class="t-link social-icon--alt"
                                                    href="https://plus.google.com/share?url={{ urlencode(url()->current()) }}"
                                                    target="_blank">
                                                    <i class="fab fa-google"></i>
                                                </a>
                                            </li>
                                            <li class="list--row__item">
                                                <a class="t-link social-icon--alt"
                                                    href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary"
                                                    target="_blank">
                                                    <i class="fab fa-linkedin"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />

                        </div>
                    </div>

                </div>
                <div class="col-lg-4">
                    <aside id="sidebar">
                        <ul class="list list--column blog-list">
                            <li class="blog-list__item">
                                <div class="widget bg--alpha">
                                    <h4 class="widget__title mt-0 mb-4">
                                        @lang('Popular News')
                                    </h4>
                                    <ul class="list list--column widget-category">
                                        @foreach ($popular as $blog)
                                            <li class="list--column__item widget-category__item">
                                                <div class="d-flex pb-3">
                                                    <div class="me-3 flex-shrink-0">
                                                        <div class="user__img user__img--md">
                                                            <img src="{{ getImage('assets/images/frontend/blog/' . @$blog->data_values->image_1) }}"
                                                                alt="Blog" class="user__img-is" />
                                                        </div>
                                                    </div>
                                                    <div class="article">
                                                        <h5 class="texte-capitalize t-fw-md mt-0 mb-2">
                                                            <a href="{{ route('blog.details', [$blog->id, slug($blog->data_values->title)]) }}"
                                                                class="t-link d-inline-block text--white t-link--danger ">
                                                                {{ __(shortDescription($blog->data_values->title, 45)) }}
                                                            </a>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
@push('fbComment')
    @php echo loadFbComment() @endphp
@endpush
