@php
$signupContent = getContent('sign_up.content', true);
@endphp
@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner__content">
            <div class="container">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h1 class="mt-0">@lang('Profile Setting')</h1>
                        <ul class="list list--row breadcrumbs justify-content-center">
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('home') }}"
                                    class="t-link breadcrumbs__link text--white t-link--gamma">@lang('Home')</a>
                            </li>
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('user.profile.setting') }}"
                                    class="t-link breadcrumbs__link text--danger t-link--gamma">@lang('Profile Setting')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <div class="section bg--alpha">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card custom--card">
                        <div class="card-body">
                            <form class="register row g-3 gy-lg-4" action=""
                                    method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-md-6">
                                        <label for="InputFirstname" class="my-2 t-heading-font">@lang('First Name')</label>
                                        <input type="text" class="form-control form--control" id="InputFirstname"
                                            name="firstname" placeholder="@lang('First Name')"
                                            value="{{ $user->firstname }}" minlength="3">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastname" class="my-2 t-heading-font">@lang('Last Name')</label>
                                        <input type="text" class="form-control form--control" id="lastname" name="lastname"
                                            placeholder="@lang('Last Name')" value="{{ $user->lastname }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="my-2 t-heading-font">@lang('E-mail Address')</label>
                                        <input class="form-control form--control" id="email"
                                            placeholder="@lang('E-mail Address')" value="{{ $user->email }}" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="my-2 t-heading-font">@lang('Mobile Number')</label>
                                        <input class="form-control form--control" id="phone" value="{{ $user->mobile }}"
                                            readonly>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="address" class="my-2 t-heading-font">@lang('Address')</label>
                                        <input type="text" class="form-control form--control" id="address" name="address"
                                          autocomplete="off"  placeholder="@lang('Address')" value="{{ @$user->address->address }}"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="state" class="my-2 t-heading-font">@lang('State')</label>
                                        <input type="text" class="form-control form--control" id="state" name="state"
                                            placeholder="@lang('state')" value="{{ @$user->address->state }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="zip" class="my-2 t-heading-font">@lang('Zip Code')</label>
                                        <input type="text" class="form-control form--control" id="zip" name="zip"
                                            placeholder="@lang('Zip Code')" value="{{ @$user->address->zip }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city" class="my-2 t-heading-font">@lang('City')</label>
                                        <input type="text" class="form-control form--control" id="city" name="city"
                                            placeholder="@lang('City')" value="{{ @$user->address->city }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="my-2 t-heading-font">@lang('Country')</label>
                                        <input class="form-control form--control" value="{{ @$user->address->country }}"
                                            readonly>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" data-trigger="fileinput">
                                                <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . $user->image,imagePath()['profile']['user']['size']) }}"
                                                    alt="@lang('Image')">

                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>

                                            <div class="img-input-div">
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new "> @lang('Select image')</span>
                                                    <span class="fileinput-exists"> @lang('Change')</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                                <a href="#" class="btn btn-danger fileinput-exists"
                                                    data-dismiss="fileinput">
                                                    @lang('Remove')</a>
                                            </div>

                                            <code>@lang('Image size')
                                                {{ imagePath()['profile']['user']['size'] }}</code>
                                        </div>


                                    </div>
                                    <div class="plan-card__footer mt-2">
                                        <button type="submit" class=" btn btn--gamma btn--lg">
                                            @lang('Update Profile')
                                        </button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('style-lib')
    <link href="{{ asset($activeTemplateTrue . 'css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endpush
@push('style')
    <link rel="stylesheet" href="{{ asset('assets/admin/build/css/intlTelInput.css') }}">
@endpush
