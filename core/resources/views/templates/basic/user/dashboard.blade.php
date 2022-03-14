@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="section">
        <!-- Main  -->
        <main class="container-lg p-0">
            <div class="row g-0">
                <div class="col-12">
                    <div class="dashboard">
                        <div class="dashboard__balance">
                            <div class="user px-3 justify-content-center align-items-lg-center">
                                <div class="user__img user__img--xl me-3">
                                    <a href="{{ route('user.home') }}">
                                        <img src="{{ getImage(imagePath()['profile']['user']['path'] . '/' . auth()->user()->image,imagePath()['profile']['user']['size']) }}"
                                            alt="{{ __($general->sitename) }}" class="user__img-is" />
                                    </a>
                                </div>
                                <div class="user__content quickview-card__body">
                                    <h6 class="my-0 t-heading-font text--white sm-text">@lang('WELCOME')</h6>
                                    <h5 class="mt-0 mb-2">
                                        {{ __(ucwords(auth()->user()->username)) }}
                                    </h5>
                                    <span class="d-block sm-text text--white">
                                        @lang('TOTAL BALANCE')
                                    </span>
                                    <h4 class="my-0">
                                        {{ $general->cur_sym . '' . showAmount(auth()->user()->balance) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard__content">
                            <div class="dashboard__quickview">
                                <div class="quickview-card">
                                    <div class="quickview-card__head justify-content-between">
                                        <div class="quickview-card__head-icon flex-shrink-0">
                                            <i class="las la-piggy-bank"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn quickview-card__menu" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('user.deposit') }}">@lang('Deposit')</a></li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.deposit.history') }}">@lang('Deposit
                                                        History')</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="quickview-card__body mt-3">
                                        <p class="mb-0 quickview-card__body-text sm-text">
                                            @lang('Your Total Deposit Money')
                                        </p>
                                        <h3 class="mt-3 mb-0 ">
                                            {{ $general->cur_sym . '' . showAmount($totalDeposit) }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="quickview-card">
                                    <div class="quickview-card__head justify-content-between">
                                        <div class="quickview-card__head-icon flex-shrink-0">
                                            <i class="las la-landmark"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn quickview-card__menu" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                                <li><a class="dropdown-item" href="{{ route('all.plan') }}">@lang('New
                                                        Investment')</a></li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.invested.plans') }}">@lang('Plan Log')</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="quickview-card__body mt-3">
                                        <p class="mb-0 quickview-card__body-text sm-text">
                                            @lang(' Your Total Invest Money')
                                        </p>
                                        <h3 class="mt-3 mb-0 ">
                                            {{ $general->cur_sym . '' . showAmount($totalInvestment) }}
                                        </h3>
                                    </div>
                                </div>

                                <div class="quickview-card">
                                    <div class="quickview-card__head justify-content-between">
                                        <div class="quickview-card__head-icon flex-shrink-0">
                                            <i class="las la-wallet"></i>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn quickview-card__menu" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="las la-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('user.withdraw') }}">@lang('Withdraw')</a></li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('user.withdraw.history') }}">@lang('Withdraw
                                                        History')</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="quickview-card__body mt-3">
                                        <p class="mb-0 quickview-card__body-text sm-text">
                                            @lang('Your Total Withdraw Money')
                                        </p>
                                        <h3 class="mt-3 mb-0">
                                            {{ $general->cur_sym . '' . showAmount($totalWithdraw) }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="quickview-card">
                                    <div class="quickview-card__head justify-content-between">
                                        <div class="quickview-card__head-icon flex-shrink-0">
                                            <i class="las la-ticket-alt"></i>
                                        </div>

                                    </div>
                                    <div class="quickview-card__body mt-3">
                                        <p class="mb-0 quickview-card__body-text sm-text">
                                            @lang('Your Total Interest Earning')
                                        </p>
                                        <h3 class="mt-3 mb-0">
                                            {{ $general->cur_sym . '' . showAmount(auth()->user()->interest_wallet) }}

                                    </div>
                                </div>
                                <div class="quickview-card">
                                    <div class="quickview-card__head justify-content-between">
                                        <div class="quickview-card__head-icon flex-shrink-0">
                                            <i class="las la-ticket-alt"></i>
                                        </div>

                                    </div>
                                    <div class="quickview-card__body mt-3">
                                        <p class="mb-0 quickview-card__body-text sm-text">
                                            @lang(' Your Total Support Ticket')
                                        </p>
                                        <h3 class="mt-3 mb-0 ">{{ $totalTicket }}</h3>
                                    </div>
                                </div>
                                <div class="quickview-card">
                                    <div class="quickview-card__head justify-content-between">
                                        <div class="quickview-card__head-icon flex-shrink-0">
                                            <i class="las la-ticket-alt"></i>
                                        </div>

                                    </div>
                                    <div class="quickview-card__body mt-3">
                                        <p class="mb-0 quickview-card__body-text sm-text">
                                            @lang('Your Total Active Plan')
                                        </p>
                                        <h3 class="mt-3 mb-0">
                                            {{ $referralUser }}
                                    </div>
                                </div>
                            </div>
                            <div class="dashboard__investment">
                                <div class="quickview-card__head justify-content-between align-items-center py-4 px-3">
                                    <div class="flex-grow-1">
                                        <p class="mb-0 quickview-card__body-text sm-text">
                                            @lang('Balance')
                                        </p>
                                        <h3 class="mt-2 mb-0 text--danger">
                                            {{ $general->cur_sym . '' . showAmount(auth()->user()->balance) }}</h3>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn quickview-card__menu" type="button" data-bs-toggle="dropdown">
                                            <i class="las la-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#">Action</a></li>
                                            <li>
                                                <a class="dropdown-item" href="#">Another action</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div id="chart"></div>

                                <div class="section--sm px-3">
                                    <h4 class="mt-0">@lang('Transaction History')</h4>
                                    <div class="table-responsive--md">
                                        <table class="table custom--table">
                                            <thead>
                                                <tr>
                                                    <th>@lang('Trx No')</th>
                                                    <th>@lang('Amount')</th>
                                                    <th>@lang('Charge')</th>
                                                    <th>@lang('Trx Type')</th>
                                                    <th>@lang('Date')</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($transactions as $data)
                                                    <tr>
                                                        <td data-label="Trx No">{{ $data->trx }}</td>
                                                        <td data-label="Amount">
                                                            {{ $general->cur_sym . '' . showAmount($data->amount) }}</td>
                                                        <td data-label="Charge">
                                                            {{ $general->cur_sym . '' . showAmount($data->charge) }}</td>
                                                        <td data-label="Trx Type">{{ $data->trx_type }}</td>
                                                        <td data-label="Date">{{ diffForHumans($data->created_at) }}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="100%">
                                                            <h5 class="d-flex justify-content-center">
                                                                {{ __($emptyMessage) }}
                                                            </h5>
                                                        </td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="section--sm px-3">
                                    <h4 class="mt-0">@lang('Referral Link')</h4>
                                    <div class="row col-md-12">
                                        <div class="card-body">
                                            <div class="input-group mb-2">
                                                <input type="text" name="key"
                                                    value="{{ url('?reference=' . auth()->user()->username) }}"
                                                    class="form-control form--control text-white" id="referralURL" readonly>
                                                <span class="input-group-text copytext" id="copyBoard"><i
                                                        class="fa fa-copy"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard__activity">
                            <h5 class="mt-0">@lang('Recent Withdraws')</h5>
                            <ul class="list list--column">
                                @forelse ($recentWithdraws->where('status',1) as $data)
                                    <li class="list--column__item">
                                        <div class="recent-activity">
                                            <div class="recent-activity__content me-2">
                                                <div class="icon icon--sm icon--sqr feature-card__icon me-2">
                                                    <i class="las la-smile"></i>
                                                </div>
                                                <div class="recent-activity__text">
                                                    <span
                                                        class="recent-activity__sub-title">{{ __($data->method->name) }}</span>
                                                    <span class="t-link recent-activity__title mt-2">
                                                        @lang('Currency By-') {{ $data->currency }}
                                                    </span>
                                                </div>
                                            </div>
                                            <h5 class="my-0 text--danger">
                                                {{ $general->cur_sym . showAmount($data->amount) }}
                                            </h5>
                                        </div>
                                    </li>
                                @empty
                                    <li class="list--column__item">
                                        <h6 class="d-flex justify-content-center">
                                            {{ __($emptyMessage) }}
                                        </h6>
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
        </main>
        <!-- Main End -->
    </div>
@endsection


@push('script')
    <script>
        (function($) {
            $('.copytext').on('click', function() {
                var copyText = document.getElementById("referralURL");
                copyText.select();
                copyText.setSelectionRange(0, 99999);
                document.execCommand("copy");
                iziToast.success({
                    message: "Copied: " + copyText.value,
                    position: "topRight"
                });
            });
        })(jQuery);



        let inv = {{ $investment }};
        let rev = {{ $revenue }};
        var options = {
            series: [{
                    name: "Investment",
                    data: inv,
                },
                {
                    name: "Revenue",
                    data: rev,
                },
            ],
            chart: {
                type: "bar",
                height: 350,
                toolbar: {
                    show: false,
                },
                foreColor: '#fff',
                options: {
                    colors: ['white', 'red']
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "55%",
                    endingShape: "rounded",
                },
            },
            dataLabels: {
                enabled: false,
            },
            stroke: {
                show: true,
                width: 2,
                colors: ["transparent"],
            },
            xaxis: {
                categories: [
                    "jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
            },
            fill: {
                opacity: 1,
                colors: ['#5a6791', '#f01313']
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "$ " + val + " thousands";
                    },
                },
                theme: "dark",
            },
            grid: {
                show: false,
            },
            legend: {
                markers: {
                    fillColors: ['#5a6791', '#f01313']
                }
            }
        };
        let balanceChart = document.querySelector("#chart");
        if (balanceChart) {
            var chart = new ApexCharts(balanceChart, options);
            chart.render();
        }
    </script>




@endpush
