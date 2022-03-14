@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" class="form-horizontal" action="{{ route('admin.plan.update', $plan->id) }}">
                        @csrf
                        <div class="form-body">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="font-weight-bold">@lang('Name')</label>
                                    <input type="text" class="form-control form-control-lg" name="name"
                                        placeholder="@lang('Plan Name')" autocomplete="off" value="{{ $plan->name }}"
                                        required>
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="font-weight-bold">@lang('Amount Type')</label>
                                    <select id="amountType" class="form-control form-control-lg amount" name="amount_type">
                                        <option {{ $plan->minimum_investment != 0 ? 'selected' : '' }} value="range">
                                            @lang('Range')</option>
                                        <option {{ $plan->minimum_investment == 0 ? 'selected' : '' }} value="fixed">
                                            @lang('Fixed')</option>
                                    </select>
                                </div>

                                <div class="form-group min-max-investment col-md-3">
                                    <label class="font-weight-bold">@lang('Minimum Investmentment')</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-lg" name="minimum_investment"
                                            value="{{ $plan->minimum_investment != 0 ? $plan->minimum_investment : null }}"
                                            placeholder="@lang('Minimum Investment')" autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text">{{ $general->cur_sym }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group min-max-investment col-md-3">
                                    <label class="font-weight-bold">@lang('Maximum investmentment')</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-lg" name="maximum_investment"
                                            value="{{ $plan->minimum_investment != 0 ? $plan->maximum_investment : null }}"
                                            placeholder="@lang('Maximum Investment')" autocomplete="off">
                                        <div class="input-group-append">
                                            <div class="input-group-text">{{ $general->cur_sym }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group fixed-investment col-md-3">
                                    <label class="font-weight-bold"> @lang('Investment Amount')</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-lg" name="fixed_investment"
                                            placeholder="@lang('Fixed Investment')" autocomplete="off"
                                            value="{{ $plan->minimum_investment == 0 ? $plan->maximum_investment : null }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">{{ $general->cur_sym }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="font-weight-bold">@lang('Return /Interest')</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control form-control-lg" name="interest"
                                            placeholder="@lang('Interest Percent Or Amount')" autocomplete="off"
                                            value="{{ $plan->interest }}" required>
                                        <div class="input-group-append">
                                            <select name="interest_status" class="input-group-text">
                                                <option {{ $plan->interest_status == '1' ? 'selected' : '' }} value="%">%
                                                </option>
                                                <option {{ $plan->interest_status == '0' ? 'selected' : '' }}
                                                    value="{{ $general->cur_sym }}">{{ $general->cur_sym }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="font-weight-bold">@lang('Return Given Period')</label>
                                    <select class="form-control form-control-lg" name="times">
                                        @foreach ($intervals as $data)
                                            <option {{ $plan->times == $data->intervel ? 'selected' : '' }}
                                                value="{{ $data->intervel }}">
                                                {{ $data->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="font-weight-bold">@lang('Return For')</label>
                                    <select id="returnFor" class="form-control form-control-lg amount" name="time_status">
                                        <option {{ $plan->repeat_time == 0 ? 'selected' : '' }} value="lifetime">
                                            @lang('Lifetime')</option>
                                        <option {{ $plan->repeat_time != 0 ? 'selected' : '' }} value="periodical">
                                            @lang('Periodical')</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3 return d-none">
                                    <label class="font-weight-bold">@lang('How Many Times?')</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-lg" name="repeat_time"
                                            value="{{ $plan->repeat_time != 0 ? $plan->repeat_time : null }}"
                                            placeholder="@lang('How Many Times?')">
                                        <div class="input-group-append">
                                            <div class="input-group-text">@lang('Times')</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 return d-none">
                                    <label class="font-weight-bold">@lang('Capital Back')</label>
                                    <input data-toggle="toggle" data-size="large" data-onstyle="-success"
                                        data-offstyle="-danger" data-on="Yes" data-off="No" data-width="100%"
                                        {{ $plan->capital_back == 1 ? 'checked' : '' }} type="checkbox"
                                        name="capital_back">
                                </div>

                                <div class="form-group col-md-3">
                                    <label class="font-weight-bold">@lang('Status')</label>
                                    <input data-toggle="toggle" data-onstyle="-success" data-offstyle="-danger"
                                        data-size="large" {{ $plan->status == 1 ? 'checked' : '' }} data-on="Active"
                                        data-off="Inactive" data-width="100%" type="checkbox" name="status">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn--primary btn-block">@lang('Update')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.plan.list') }}" class="btn btn--primary box--shadow1 text--small"><i
            class="fa fa-fw fa-list"></i>@lang('Plan List')</a>
@endpush

@push('script')
    <script>
        $(function($) {
            $('#amountType').on('change', function() {
                var isType = $('#amountType').find(":selected").val();
                if (isType != 'fixed') {
                    $('.min-max-investment').show();
                    $('.fixed-investment').hide();
                } else {
                    console.log('Fixed10');
                    $('.min-max-investment').hide();
                    $('.fixed-investment').show();
                }
            }).change();

            $('#returnFor').on('change', function() {
                var isType = $('#returnFor').find(":selected").val();
                if (isType != 'lifetime') {
                    $('.return').addClass('d-block');
                    $('.return').removeClass('d-none');
                } else {
                    $('.return').addClass('d-none');
                    $('.return').removeClass('d-block');
                }
            }).change();
        });
    </script>
@endpush
