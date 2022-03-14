@php
$getPlan = getContent('investment_plan.content', true);
@endphp
@extends($activeTemplate.'layouts.frontend')
@section('content')

    <div class="container">
        <div class="section--sm px-3">
            <div class="table-responsive--md">
                <table class="table custom--table">
                    <thead>
                        <tr>
                            <th>@lang('Name')</th>
                            <th>@lang('Amount')</th>
                            <th>@lang('Interest')</th>
                            <th>@lang('Return Intervel')</th>
                            <th>@lang('Capital Status')</th>
                            <th>@lang('Investment Date')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($investedPlans)
                            @forelse ($investedPlans as  $k => $investment)
                                <tr>
                                    <td data-label="Name">{{ @$investment->plan->name }}</td>
                                    <td data-label="Amount">{{ $general->cur_sym . $investment->amount }}</td>
                                    <td data-label="Interest Value">
                                        <span>{{ $investment->interest . ' ' . $general->cur_text }}
                                        </span>
                                    </td>
                                    <td data-label="Return Intervel">
                                        @if ($investment->times == 24)
                                            <span class="badge badge--success rounded-pill">
                                                @lang('Daily')
                                            </span>
                                        @elseif($investment->times == 168)
                                            <span class="badge badge--primary rounded-pill">
                                                @lang('Weekly')
                                            </span>
                                        @elseif($investment->times == 720)
                                            <span class="badge badge--secondary rounded-pill">
                                                @lang('Monthly')
                                            </span>
                                        @elseif($investment->times == 8760)
                                            <span class="badge badge--warning rounded-pill">
                                                @lang('Yearly')
                                            </span>
                                        @elseif($investment->times == 1)
                                            <span class="badge badge--info rounded-pill">
                                                @lang('Hourly')
                                            </span>
                                        @else
                                            <span class="badge badge--success rounded-pill">
                                                {{ $investment->times . ' Hours' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($investment->repeat_time == 0)
                                            <span class="badge badge--primary rounded-pill">
                                                @lang('Capital lifetime')
                                            </span>
                                        @else
                                            <span class="badge badge--success rounded-pill">
                                                @lang('Capital Will be back')
                                            </span>
                                        @endif
                                    </td>
                                    <td data-label="Investment Date">{{ diffForHumans($investment->created_at) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="text-center">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        @endif
                    </tbody>
                </table>
                @if ($investedPlans->hasPages())
                    {{ paginateLinks($investedPlans) }}
                @endif
            </div>
        </div>
    </div>


    {{-- Plan Confirm MODAL --}}
    <div id="investModal" class="modal custom--modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="plan-name text--danger"></h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="POST" class="formAction">
                    @csrf
                    <div class="modal-body">
                        <div class="row form-group">
                            <label class="my-2 t-heading-font">@lang('Select Your Method:')</label>
                            <div class="input-group mb-3">
                                <select name="payment_method" class="form-select form--select">
                                    <option value="" disabled selected>@lang('Select Your Method')</option>
                                    <option value="1">@lang('Deposit Balance')</option>
                                    <option value="2">@lang('Interest Wallet')</option>
                                    <option value="3">@lang('Direct Payment')</option>
                                </select>
                            </div>
                        </div>

                        <div class="row form-group targetAmount">
                            <label for="investmentAmount" class="my-2 t-heading-font">@lang('Target Amount:')</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text input-group-prepend text--danger">
                                    {{ $general->cur_sym }} </span>
                                <input type="number" name="amount" class="form-control form--control" id="investmentAmount"
                                    autocomplete="off" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default" placeholder="@lang('Enter target value')">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <p class="modal-title text--success float-start investment-confirmation-msg"></p> --}}
                        <button type="button" class="btn btn-dark" data-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--gamma">@lang('Confirm')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>


    </style>
@endpush

@push('script')
    <script>
        (function($) {


            $('.ConfirmPlanBtn').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');


                if ($(this).data('min') == 0) {
                    $('.targetAmount').hide();
                } else {
                    $('.targetAmount').show();
                }


                $('.formAction').attr('action', '{{ route('investment.plan', '') }}/' + id);
                var confirmPlanMessage =
                    `@lang('Are you sure to invest the') <span class="text--success fw-bold">@lang(' plan') ?</span>`;

                $('#investModal').find('.investment-confirmation-msg').html(confirmPlanMessage);
                $('#investModal').find('.plan-name').html(name);
                $('#investModal').modal('show');
            });


        })(jQuery);
    </script>
@endpush
