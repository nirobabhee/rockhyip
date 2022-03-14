@php
$content = getContent('blog.content', true);
$element = getContent('blog.element', false, 3, true);
@endphp
<div class="section">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para">
                        {{ __(@$content->data_values->subheading) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row gy-4 justify-content-center">
            @foreach ($element as $blog)
                <div class="col-md-6 col-lg-4">
                    <div class="blog-post">
                        <a href="{{ route('blog.details', [$blog->id, slug($blog->data_values->title)]) }}"
                           target="_blank" class="t-link blog-post__img">
                            <img src="{{ getImage('assets/images/frontend/blog/' . @$blog->data_values->image_1) }}"
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
            @endforeach
        </div>
    </div>
</div>
