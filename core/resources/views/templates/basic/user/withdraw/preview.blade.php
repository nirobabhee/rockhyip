@extends($activeTemplate.'layouts.frontend')

@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner__content">
            <div class="container">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h1 class="mt-0">@lang('Preview')</h1>
                        <ul class="list list--row breadcrumbs justify-content-center">
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('home') }}"
                                    class="t-link breadcrumbs__link text--white t-link--gamma">@lang('Home')</a>
                            </li>
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('user.withdraw') }}"
                                    class="t-link breadcrumbs__link text--danger t-link--gamma">@lang('Withdraw')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->


    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 ">
                    <div class="card custom--card">
                        <h4 class="card-title m-3 mt-5 text-center">@lang('Current Balance') :
                            <strong>{{ showAmount(auth()->user()->balance) }} {{ __($general->cur_text) }}</strong>
                        </h4>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="quickview-card">
                                        <div class="quickview-card__body mt-3">
                                            <table>
                                                <t-body>
                                                    <tr>
                                                        <td class="font-weight-bold pull-left">@lang('Request Amount') :</td>
                                                        <td>
                                                            {{ showAmount($withdraw->amount) }}
                                                                {{ __($general->cur_text) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="font-weight-bold">@lang('Withdrawal Charge') :</td>
                                                        <td>
                                                            {{ showAmount($withdraw->charge) }}
                                                                {{ __($general->cur_text) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('After Charge') :</td>
                                                        <td>
                                                            {{ showAmount($withdraw->after_charge) }}
                                                                {{ __($general->cur_text) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td> @lang('Conversion Rate') : </td>
                                                        <td>
                                                            1 {{ __($general->cur_text) }} =
                                                            {{ showAmount($withdraw->rate) }}
                                                            {{ __($withdraw->currency) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>@lang('You Will Get')
                                                            :</td>
                                                        <td>
                                                            {{ showAmount($withdraw->final_amount) }}
                                                            {{ __($withdraw->currency) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <div class="mt-3">
                                                                @lang('Balance Will be') :

                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ showAmount($withdraw->user->balance - $withdraw->amount) }}"
                                                                        class="form-control form--control" required
                                                                        readonly>
                                                                    <span
                                                                        class="input-group-text input-group-prepend">{{ __($general->cur_text) }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </t-body>
                                            </table>
                                        </div>
                                      </div>
                                </div>


                                <div class="col-8">
                                    <form action="{{ route('user.withdraw.submit') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @if ($withdraw->method->user_data)
                                            @foreach ($withdraw->method->user_data as $k => $v)

                                                @if ($v->type == 'text')
                                                    <div class="form-group">
                                                        <label class="t-heading-font my-2"><strong>{{ __($v->field_level) }}
                                                                @if ($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                        <input type="text" name="{{ $k }}"
                                                            class="form-control form--control" value="{{ old($k) }}"
                                                            placeholder="{{ __($v->field_level) }}"
                                                            @if ($v->validation == 'required') required @endif>
                                                        @if ($errors->has($k))
                                                            <span
                                                                class="text-danger">{{ __($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                @elseif($v->type == 'textarea')
                                                    <div class="form-group">
                                                        <label class="t-heading-font my-2"><strong>{{ __($v->field_level) }}
                                                                @if ($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                        <textarea name="{{ $k }}"
                                                            class="form-control form--control"
                                                            placeholder="{{ __($v->field_level) }}" rows="3"
                                                            @if ($v->validation == 'required') required @endif>{{ old($k) }}</textarea>
                                                        @if ($errors->has($k))
                                                            <span
                                                                class="text-danger">{{ __($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                @elseif($v->type == 'file')
                                                    <label class="t-heading-font my-2"><strong>{{ __($v->field_level) }}
                                                            @if ($v->validation == 'required') <span class="text-danger">*</span>  @endif</strong></label>
                                                    <div class="form-group">
                                                        <div class="fileinput fileinput-new " data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail withdraw-thumbnail"
                                                                data-trigger="fileinput">
                                                                <img class="w-100" src="{{ getImage('/') }}"
                                                                    alt="@lang('Image')">
                                                            </div>
                                                            <div
                                                                class="fileinput-preview fileinput-exists thumbnail wh-200-150">
                                                            </div>
                                                            <div class="img-input-div mt-3">
                                                                <span class="btn btn-info btn-file">
                                                                    <span class="fileinput-new "> @lang('Select')
                                                                        {{ __($v->field_level) }}</span>
                                                                    <span class="fileinput-exists"> @lang('Change')</span>
                                                                    <input class="form--control" type="file"
                                                                        name="{{ $k }}" accept="image/*"
                                                                        @if ($v->validation == 'required') required @endif>
                                                                </span>
                                                                <button class="btn btn--lg"> <a href="#"
                                                                        class="btn btn-danger fileinput-exists"
                                                                        data-dismiss="fileinput"><i
                                                                            class="las la-backspace"></i></a></button>
                                                            </div>
                                                        </div>
                                                        @if ($errors->has($k))
                                                            <br>
                                                            <span
                                                                class="text-danger">{{ __($errors->first($k)) }}</span>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        @if (auth()->user()->ts)
                                            <div class="form-group">
                                                <label class="t-heading-font my-2">@lang('Google Authenticator
                                                    Code')</label>
                                                <input type="text" name="authenticator_code" class="form-control"
                                                    required>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn--gamma btn-block  mt-4 text-center">@lang('Confirm')</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
