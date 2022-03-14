@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($withdrawMethod as $data)
                    <div class="col-lg-3 col-md-4 mb-4">
                        <div class="card custom--card">
                            <h5 class="text-center">{{ __($data->name) }}</h5>
                            <div class="card-body">
                                <img src="{{ getImage(imagePath()['withdraw']['method']['path'] . '/' . $data->image,imagePath()['withdraw']['method']['size']) }}"
                                    class="card-img-top" alt="{{ __($data->name) }}" class="w-100">
                            </div>
                            <div class="card-footer">
                                <a href="javascript:void(0)" data-id="{{ $data->id }}"
                                    data-resource="{{ $data }}"
                                    data-min_amount="{{ showAmount($data->min_limit) }}"
                                    data-max_amount="{{ showAmount($data->max_limit) }}"
                                    data-fix_charge="{{ showAmount($data->fixed_charge) }}"
                                    data-percent_charge="{{ showAmount($data->percent_charge) }}"
                                    data-processing_hours="{{ $data->delay }}"
                                    data-base_symbol="{{ __($general->cur_text) }}"
                                    data-base_symbol="{{ __($general->cur_text) }}"
                                    class="btn btn--xl btn--gamma withdraw w-100" data-toggle="modal"
                                    data-target="#withdrawModal">
                                    @lang('Withdraw Now')</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Modal -->
        <div class="modal custom--modal fade" id="withdrawModal" tabindex="-1" role="dialog"
            aria-labelledby="withdrawModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title method-name" id="withdrawModalLabel">@lang('Withdraw')</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('user.withdraw.money') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <p class="withdrawLimit"></p>
                            <p class="withdrawCharge"></p>
                            <p class="processingHours"></p>

                            <div class="form-group">
                                <input type="hidden" name="currency" class="edit-currency form-control">
                                <input type="hidden" name="method_code" class="edit-method-code  form-control">
                            </div>

                            <div class="form-group">
                                <label>@lang('Enter Amount'):</label>
                                <div class="input-group">
                                    <input id="amount" type="text" class="form-control form--control"
                                        onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')" name="amount"
                                        placeholder="0.00" required="" value="{{ old('amount') }}">

                                    <span
                                        class="input-group-text input-group-prepend addon-bg currency-addon">{{ __($general->cur_text) }}</span>

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Close')</button>
                            <button type="submit" class="btn btn--gamma">@lang('Confirm')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
v>
@endsection
@push('script')
    <script>
        (function($) {
            "use strict";
            $('.withdraw').on('click', function() {
                var id = $(this).data('id');
                var result = $(this).data('resource');
                var minAmount = $(this).data('min_amount');
                var maxAmount = $(this).data('max_amount');
                var fixCharge = $(this).data('fix_charge');
                var percentCharge = $(this).data('percent_charge');

                var withdrawLimit =
                    `@lang('Withdraw Limit'): ${minAmount} - ${maxAmount}  {{ __($general->cur_text) }}`;
                $('.withdrawLimit').text(withdrawLimit);
                var withdrawCharge =
                    `@lang('Charge'): ${fixCharge} {{ __($general->cur_text) }} ${(0 < percentCharge) ? ' + ' + percentCharge + ' %' : ''}`
                $('.withdrawCharge').text(withdrawCharge);
                var processHours = `@lang('Processing Hour'): ${$(this).data('processing_hours')} `;
                $('.processingHours').text(processHours);
                $('.method-name').text(`@lang('Withdraw Via') ${result.name}`);
                $('.edit-currency').val(result.currency);
                $('.edit-method-code').val(result.id);
            });
        })(jQuery);
    </script>

@endpush
