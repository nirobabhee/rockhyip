@extends($activeTemplate.'layouts.frontend')

@section('content')

    <!-- Blog -->
    <div class="section">
        <div class="container">
            <div class="row gy-5 gy-lg-0">
                <div class="col-lg-8">
                    <div class="row gy-4 justify-content-center">

                        @forelse ($blogs as $blog)
                            <div class="col-md-6 col-lg-6">
                                <div class="blog-post">
                                    <a href="{{ route('blog.details', [$blog->id, slug($blog->data_values->title)]) }}"
                                        target="_blank" class="t-link blog-post__img">
                                        <img src="{{ getImage('assets/images/frontend/blog/' . $blog->data_values->image_1) }}"
                                            alt="viserfly" class="blog-post__img-is" />
                                    </a>
                                    <div class="blog-post__body">
                                        <h4 class="text-capitalize mt-0">
                                            <a href="{{ route('blog.details', [$blog->id, slug($blog->data_values->title)]) }}"
                                                target="_blank" class="t-link blog-post__title">
                                                {{ __(shortDescription($blog->data_values->title, 80)) }}

                                            </a>
                                        </h4>
                                        <p class="blog-post__article mt-4 mb-0">
                                            {{ __(shortDescription($blog->data_values->description)) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <ul class="list list--row justify-content-center align-items-center t-mt-60">
                                    {{ __($emptyMessage) }}
                                </ul>

                            </div>
                        @endforelse
                        @if ($blogs->hasPages())
                            <div class="col-12">
                                <ul class="list list--row justify-content-center align-items-center t-mt-6">
                                    {{ paginateLinks($blogs) }}
                                </ul>
                            </div>
                        @endif
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
                                        @forelse ($popular as $blog)
                                            <li class="list--column__item widget-category__item">
                                                <div class="d-flex pb-3">
                                                    <div class="me-3 flex-shrink-0">
                                                        <div class="user__img user__img--md">
                                                            <img src="{{ getImage('assets/images/frontend/blog/' . $blog->data_values->image_1) }}"
                                                                alt="viserhyip" class="user__img-is" />
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
                                        @empty
                                            <div class="justify-content-center align-items-center">
                                                {{ __($emptyMessage) }}
                                            </div>
                                        @endforelse

                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </aside>
                </div>

            </div>
        </div>
        @if ($sections->secs != null)

            @foreach (json_decode($sections->secs) as $sec)
                @include($activeTemplate.'sections.'.$sec)
            @endforeach
        @endif
    </div>
    <!-- Blog End -->
@endsection
@push('fbComment')
    @php echo loadFbComment() @endphp
@endpush
