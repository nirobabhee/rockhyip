@extends($activeTemplate.'layouts.master')

@section('content')
   <!-- Banner -->
   <div class="banner">
    <div class="banner__content">
        <div class="container">
            <div class="row g-3 justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="mt-0">{{ __($pageTitle) }}</h1>
                    <ul class="list list--row breadcrumbs justify-content-center">
                        <li class="list--row__item breadcrumbs__item">
                           @lang('Home - Stype Payment')
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->
<div class="container section mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-deposit text-center">
                    <div class="card-header card-header-bg">
                        <h3>@lang('Payment Preview')</h3>
                    </div>
                    <div class="card-body card-body-deposit text-center">
                        <h4 class="my-2"> @lang('PLEASE SEND EXACTLY') <span class="text-success"> {{ $data->amount }}</span> {{__($data->currency)}}</h4>
                        <h5 class="mb-2">@lang('TO') <span class="text-success"> {{ $data->sendto }}</span></h5>
                        <img src="{{$data->img}}" alt="@lang('Image')">
                        <h4 class="text-white bold my-4">@lang('SCAN TO SEND')</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
