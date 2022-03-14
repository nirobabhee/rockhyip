@extends($activeTemplate.'layouts.frontend')
@section('content')
    <div class="container section mt-2">
        <div class="row justify-content-center">
            <div class="col-md-6">


                <table class="table custom--table ">

                    <tbody>
                        <tr>
                            <td data-label="Date">@lang('Amount'):</td>
                            <td data-label="Amount"><strong>{{ showAmount($data->amount) }} </strong>
                                {{ __($general->cur_text) }}</td>
                        </tr>

                        <tr>
                            <td data-label="Date">@lang('Charge'):</td>
                            <td data-label="Charge"><strong><strong>{{ showAmount($data->charge) }}</strong>
                                    {{ __($general->cur_text) }}</td>
                        </tr>
                        <tr>
                            <td data-label="Payable">@lang('Payable'):</td>
                            <td data-label="Amount"><strong> {{ showAmount($data->amount + $data->charge) }}</strong>
                                {{ __($general->cur_text) }}</td>
                        </tr>
                        <tr>
                            <td data-label="Convertion Rate">@lang('Convertion Rate'):</td>
                            <td data-label="Amount"><strong> {{ showAmount($data->rate) }}
                                    {{ __($data->baseCurrency()) }}</td>
                        </tr>
                        <tr>
                            <td data-label="Convertion Rate">@lang('In')
                                {{ $data->baseCurrency() }}:</td>
                            <td data-label="Convertion Rate"><strong> <strong>{{ showAmount($data->final_amo) }}</strong></td>
                        </tr>
                        @if ($data->gateway->crypto == 1)
                            <tr>
                                <td>
                                    @lang('Conversion with')
                                    <b> {{ __($data->method_currency) }}</b> @lang('and final value will Show on next
                                    step')
                                </td>
                            </tr>
                        @endif

                        <tr>
                            <td colspan="2">
                                @if (1000 > $data->method_code)
                                    <a href="{{ route('user.deposit.confirm') }}"
                                        class="btn btn--gamma btn-block py-3 font-weight-bold w-100">@lang('Pay Now')</a>
                                @else
                                    <a href="{{ route('user.deposit.manual.confirm') }}"
                                        class="btn btn--gamma py-3 font-weight-bold w-100">@lang('Pay Now')</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
