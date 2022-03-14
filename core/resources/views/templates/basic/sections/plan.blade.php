@php

$content = getContent('plan.content', true);
$plans = App\Models\Plan::where('status', 1)
    ->with('intervel')
    ->latest()
    ->get();
// dd($plans);
@endphp

<div class="section bg--alpha">
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
        <div class="row gy-4 gx-3 justify-content-center">
            @if ($plans)
                @forelse ($plans as $plan)
                    <div class="col-md-6 col-lg-4">
                        <div class="plan-card">
                            <div class="plan-card__head">
                                <h3 class="mt-0 mb-2 text-center text--danger">{{ __(@$plan->name) }}</h3>
                                @if (@$plan->interest_status == 1)
                                    <h4 class="mt-0 mb-2 text-center"> <small class="text--danger"
                                            title="Return On Investment">@lang('ROI
                                            ')</small>{{ showAmount($plan->interest) }}%</h4>
                                @else
                                    <h4 class="mt-0 mb-2 text-center">
                                        <small class="text--danger">@lang('ROI
                                            ')</small>{{ $general->cur_sym . showAmount($plan->interest) }}
                                    </h4>

                                @endif
                                <h6 class="d-block text-center lg-text">
                                    @lang("Profit Every ") <span
                                        class="text--danger">{{ __($plan->intervel->name) }}</span>
                                </h6>
                                <div class="text-center my-2">
                                    @if ($plan->repeat_time == 0)
                                        <div class="plan-card__badge plan-card__badge--primary">
                                            @lang('For Life Time')
                                        </div>
                                    @else
                                        <div class="plan-card__badge plan-card__badge--success">
                                            @lang('For ') {{ __($plan->repeat_time) }}
                                            @lang('Times')
                                        </div>
                                    @endif
                                </div>
                                <span class="d-block text-center"> {{ __(@$content->data_values->support_duration) }}
                                </span>
                            </div>
                            <div class="plan-card__body pt-2 mt-5">
                                @if ($plan->minimum_investment == 0)
                                    <span class="d-block text-center">
                                        @lang('Invest')
                                    </span>
                                    <h5 class="d-block text-center ">
                                        @lang('Amount ') {{ $general->cur_sym . $plan->maximum_investment }}
                                    </h5>
                                @else
                                    <span class="d-block text-center">
                                        @lang('Invest')
                                    </span>
                                    <h5 class="d-block text-center ">
                                        @lang('Min. ') {{ $general->cur_sym . $plan->minimum_investment }}
                                        - @lang('Max. '){{ $general->cur_sym . $plan->maximum_investment }}
                                    </h5>
                                @endif
                            </div>
                            <div class="plan-card__footer text-center mt-4">
                                @guest
                                    <div id="plan-{{ $plan->id }}" class="collapse">
                                        @lang('Please Login')
                                    </div>
                                    <a data-toggle="collapse" data-target="#plan-{{ $plan->id }}"
                                        href="javascript:void(0)" class="t-link btn btn--dark btn--lg rounded-pill">
                                        @lang('Invest Now')
                                    </a>

                                @endguest

                                @auth
                                    <a href="javascript:void(0)"
                                        class="ConfirmPlanBtn t-link btn btn--dark btn--lg rounded-pill"
                                        data-id="{{ $plan->id }}" data-name="{{ $plan->name }}"
                                        data-min="{{ $plan->minimum_investment }}"
                                        data-max="{{ $plan->maximum_investment }}" data-bs-placement="top"
                                        data-bs-original-title="Confirmation Plan">
                                        @lang('Invest Now')
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-4 col-lg-6 justify-content-center">
                        <h5 class="d-flex justify-content-center btn btn--transaction rounded-pill">
                            {{ __($emptyMessage) }}
                        </h5>
                    </div>
                @endforelse
            @endif
        </div>
    </div>
</div>
{{-- Plan Confirm MODAL --}}
<div id="investModal" class="modal custom--modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text--danger">@lang('Are you want to invest?')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" class="formAction">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <h5> @lang('Plan Name:')</h5>
                        </div>
                        <div class="col-8 justify-content-start">
                            <h5 class="plan-name"></span></h5>
                        </div>
                    </div>
                    <div class="row form-group">
                        <label class="t-heading-font">@lang('Select Your Method:')</label>
                        <div class="input-group mb-3">
                            <select name="payment_method" class="form-select form--select" required>
                                <option value="" disabled selected>@lang('Select Your Method')</option>
                                <option value="deposit">@lang('Deposit Wallet')</option>
                                <option value="interest">@lang('Interest Wallet')</option>
                                <option value="direct">@lang('Direct Payment')</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="investmentAmount" class="my-2 t-heading-font">@lang('Target Amount:')</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text input-group-prepend text--danger">
                                {{ $general->cur_sym }} </span>
                            <input type="number" name="amount" class="form-control form--control" id="investmentAmount"
                                autocomplete="off" aria-label="Sizing example input"
                                aria-describedby="inputGroup-sizing-default" placeholder="@lang('Enter Amount')">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--gamma">@lang('Confirm')</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('script')
    <script>
        (function($) {
            $('.ConfirmPlanBtn').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var max = $(this).data('max');
                if ($(this).data('min') == 0) {
                    $('#investmentAmount').val(max);
                } else {
                    $('#investmentAmount').val('');
                }
                $('.formAction').attr('action', '{{ route('investment.plan', '') }}/' + id);
                $('#investModal').find('.plan-name').html(name);
                $('#investModal').modal('show');
            });
        })(jQuery);
    </script>
@endpush
