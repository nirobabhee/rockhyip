@php
$content = getContent('calculator.content', true);
$calculation = App\Models\Plan::with('intervel')
    ->where('status', 1)
    ->get();
@endphp
<div class="section profit-section">
    <div id="particles-2"></div>
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para"> {{ __(@$content->data_values->description) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="profit-calculator">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="d-inline-block mb-2 t-heading-font fw-md">
                                    @lang('Plan')
                                </label>
                                <select class="form-select form--select" id="plan">
                                    <option value="" disabled selected="@lang('Choose Plan')">@lang('Choose Plan')
                                    </option>
                                    @foreach ($calculation as $plan)
                                        <option value="{{ $plan->interest }}" data-resource="{{ $plan }}">
                                            {{ __(@$plan->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text--danger roiInterest"></p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="inputAmount" class="d-inline-block mb-2 t-heading-font fw-md">
                                @lang('Invest Amount')
                            </label>
                            <div class="input-group form--control">
                                <input id="inputAmount" type="text" name="amount"
                                    class="form-control form--control amount" />
                                <div class="input-append">
                                    <span class="form--control form-control">
                                        {{ $general->cur_text }}
                                    </span>
                                </div>
                            </div>
                            <p class="text--danger maxMin"></p>
                        </div>

                        <div class="col-md-4">
                            <label for="profit" class="d-inline-block mb-2 t-heading-font fw-md">
                                @lang('Profit')
                            </label>
                            <div class="input-group form--control">
                                <input id="profit" type="text" class="form-control form--control profit" value="0.00"
                                    readonly />
                                <div class="input-append">
                                    <span class="form--control form-control">
                                        {{ $general->cur_text }}
                                    </span>
                                </div>
                            </div>
                            <p class="text--danger times"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        $(function() {
            $('.maxMin').text('');
            $('#plan, .amount').focusout(function() {
                var curText = "{{ $general->cur_text }}";
                var resource = $("#plan").find(':selected').data("resource");
                var max = resource.maximum_investment;
                var min = resource.minimum_investment;
                var totalTime = resource.repeat_time;
                var interest = resource.interest;
                var intervel = resource.intervel.name;
                var fixed = !min ? max : 0;
                var amount = $(".amount").val()
                //warnning text
                var planMaxMin = `@lang('Between '): ${min}${curText}   -  ${max}${curText}`;
                if (!min) {
                    $('.maxMin').text('');
                    $('.amount').val(fixed);

                } else {
                    $('.maxMin').text(planMaxMin);
                }
                var capitalTTime = `@lang('Total ') ${totalTime} @lang(' Times')`;
                if (!totalTime) {
                    $(".profit").val('')
                    $(".times").text('Life Time Capital')
                } else {
                    $(".profit").val('')
                    $('.times').text(capitalTTime);
                }
                if (resource.interest_status) {
                    var interestWays =
                        `@lang('Profit ') ${interest}% @lang(' for Every ') ${intervel}`;
                } else {
                    var interestWays =
                        `@lang('Profit ') ${interest} ${curText} @lang(' for Every ') ${intervel}`;
                }
                $('.roiInterest').text(interestWays);
                //calculation
                if (!min) {
                    if (resource.interest_status) {
                        var balance = (fixed * interest / 100) * totalTime;
                        $(".profit").val(balance);
                    } else {
                        // fixd-currency
                        var balance = interest * totalTime;
                        $(".profit").val(balance);
                    }
                } else {
                    if (amount < min || amount > max) {
                        notify('error', 'Please follow the plan limit');
                    } else {
                        if (resource.interest_status) {
                            console.log('calculate area');
                            var balance = (parseFloat($('.amount').val()) * interest / 100) * totalTime;
                            console.log(balance);
                            $(".profit").val(balance);
                        } else {
                            //Range-currency
                            var balance = interest * totalTime;
                            $(".profit").val(balance);
                        }
                    }
                }
            })
        })
    </script>
@endpush
