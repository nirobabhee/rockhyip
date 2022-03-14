@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="section">
        <div class="container my-4">
            <div class="row justify-content-center">
                @foreach ($gatewayCurrency as $data)
                    <div class="col-md-4 col-lg-3 mb-3">
                        <div class="card custom--card">
                            <h5 class="text-center">{{ __($data->name) }} </h5>
                            <div class="card-body">
                                <img src="{{ $data->methodImage() }}" class="card-img-top" alt="{{ __($data->name) }}"
                                    class="w-100">
                                <div class="mt-2">
                                    <a href="javascript:void(0)" data-id="{{ $data->id }}"
                                        data-name="{{ $data->name }}" data-currency="{{ $data->currency }}"
                                        data-method_code="{{ $data->method_code }}"
                                        data-min_amount="{{ showAmount($data->min_amount) }}"
                                        data-max_amount="{{ showAmount($data->max_amount) }}"
                                        data-base_symbol="{{ $data->baseSymbol() }}"
                                        data-fix_charge="{{ showAmount($data->fixed_charge) }}"
                                        data-percent_charge="{{ showAmount($data->percent_charge) }}"
                                        class="btn btn--xl btn--gamma w-100 deposit" data-toggle="modal"
                                        data-target="#depositModal">
                                        @lang('Deposit Now')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- //Modal --}}
        <div class="modal custom--modal fade" id="depositModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong class="modal-title method-name" id="depositModalLabel"></strong>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('user.deposit.insert') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <p class="depositLimit"></p>
                            <p class="depositCharge"></p>
                            <div class="form-group">
                                <input type="hidden" name="currency" class="edit-currency">
                                <input type="hidden" name="method_code" class="edit-method-code">
                            </div>
                            <div class="form-group">
                                <label>@lang('Invest Amount'):</label>
                                    <div class="input-group">
                                        <input id="amount" type="text" class="form-control form--control" name="amount"
                                            placeholder="@lang('Amount')" required
                                            value="{{ $amount }}" @if($amount) readonly @endif>
                                        <span
                                            class="input-group-text input-group-append">{{ __($general->cur_text) }}</span>
                                    </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                            <div class="prevent-double-click">
                                <button type="submit" class="btn btn--gamma confirm-btn">@lang('Confirm')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        (function($) {
            $('.deposit').on('click', function() {
                var name = $(this).data('name');
                var currency = $(this).data('currency');
                var method_code = $(this).data('method_code');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var baseSymbol = "{{ $general->cur_text }}";
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var depositLimit = `@lang('Deposit Limit'): ${minAmount} - ${maxAmount}  ${baseSymbol}`;
                $('.depositLimit').text(depositLimit);
                var depositCharge =
                    `@lang('Charge'): ${fixCharge} ${baseSymbol}  ${(0 < percentCharge) ? ' + ' +percentCharge + ' % ' : ''}`;
                $('.depositCharge').text(depositCharge);
                $('.method-name').text(`@lang('Payment By ') ${name}`);
                $('.currency-addon').text(baseSymbol);
                $('.edit-currency').val(currency);
                $('.edit-method-code').val(method_code);
            });
        })(jQuery);
    </script>
@endpush
