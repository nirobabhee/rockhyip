@php
$content = getContent('transaction.content', true);
$deposits  = App\Models\Deposit::with('user', 'gateway')->where('status', 1)->latest()->limit(10)->get();
$withdraws  = App\Models\Withdrawal::with('user', 'method')->where('status', 1)->latest()->limit(10)->get();
@endphp
<div class="section transaction-section">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para">{{ __(@$content->data_values->sub_heading) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row gy-4 justify-content-center">
            <div class="col-12">
                <ul class="list list--row list-group justify-content-center">
                    <li class="list--row__item">
                        <a href="#latestDeposits" class="t-link btn btn--transaction rounded-pill active"
                            data-bs-toggle="list">
                            @lang('Latest Deposit')
                        </a>
                    </li>
                    <li class="list--row__item">
                        <a href="#latestWithdraw" class="t-link btn btn--transaction rounded-pill"
                            data-bs-toggle="list">
                            @lang('Latest Withdraw')
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-xl-10">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="latestDeposits">
                        <div class="table-responsive--md">
                            <table class="table custom--table">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Currency')</th>
                                        <th>@lang('Date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($deposits as $deposit)
                                        <tr>
                                            <td data-label="Name">
                                                <div class="user align-items-center">
                                                    <div class="user__img user__img--md me-3">
                                                        <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . @$deposit->user->image,imagePath()['profile']['user']['size']) }}"
                                                            alt="rockhyip" class="user__img-is" />
                                                    </div>
                                                    <span class="d-inline-block">
                                                        {{ __(@$deposit->user->username) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td data-label="Amount">
                                                {{ $general->cur_sym . showAmount(@$deposit->amount) }} </td>
                                            <td data-label="Currency">{{ __(@$deposit->gateway->name) }}</td>
                                            <td data-label="Date">{{ diffForHumans(@$deposit->created_at) }}</td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%">
                                            <h6 class="d-flex justify-content-center">
                                                {{ __($emptyMessage) }}
                                            </h6>
                                        </td>
                                    </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="latestWithdraw">
                        <div class="table-responsive--md">
                            <table class="table custom--table">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Amount')</th>
                                        <th>@lang('Method')</th>
                                        <th>@lang('Date')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($withdraws as $withdraw)
                                        <tr>
                                            <td data-label="Name">
                                                <div class="user align-items-center">
                                                    <div class="user__img user__img--md me-3">
                                                        <img src="{{ @getImage(imagePath()['profile']['user']['path'] . '/' . @$withdraw->user->image,imagePath()['profile']['user']['size']) }}"
                                                            alt="rockhyip" class="user__img-is" />
                                                    </div>
                                                    <span class="d-inline-block">
                                                      {{ __(@$withdraw->user->username) }}
                                                    </span>
                                                </div>
                                            </td>
                                            <td data-label="Amount">
                                                {{ $general->cur_sym . showAmount(@$withdraw->amount) }} </td>
                                            <td data-label="Currency">{{ __(@$withdraw->method->name) }}</td>
                                            <td data-label="Date">{{ diffForHumans(@$withdraw->created_at) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">
                                                <h6 class="d-flex justify-content-center">
                                                    {{ __($emptyMessage) }}
                                                </h6>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
