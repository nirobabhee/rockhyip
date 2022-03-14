@extends($activeTemplate.'layouts.frontend')

@section('content')

    <div class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="table-responsive--md">
                        <table class="table custom--table">
                            <thead>
                                <tr>
                                    <th>@lang('Transaction ID')</th>
                                    <th>@lang('Gateway')</th>
                                    <th>@lang('Amount')</th>
                                    <th>@lang('Charge')</th>
                                    <th>@lang('After Charge')</th>
                                    <th>@lang('Rate')</th>
                                    <th>@lang('Receivable')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Time')</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($withdraws as  $data)
                                    <tr>
                                        <td data-label="#@lang('Trx')">{{ $data->trx }}</td>
                                        <td data-label="@lang('Gateway')">{{ __($data->method->name) }}</td>
                                        <td data-label="@lang('Amount')">
                                            <strong>{{ showAmount($data->amount) }}
                                                {{ __($general->cur_text) }}</strong>
                                        </td>
                                        <td data-label="@lang('Charge')" class="text-danger">
                                            {{ showAmount($data->charge) }} {{ __($general->cur_text) }}
                                        </td>
                                        <td data-label="@lang('After Charge')">
                                            {{ showAmount($data->after_charge) }} {{ __($general->cur_text) }}
                                        </td>
                                        <td data-label="@lang('Rate')">
                                            {{ showAmount($data->rate) }} {{ __($data->currency) }}
                                        </td>
                                        <td data-label="@lang('Receivable')" class="text-success">
                                            <strong>{{ showAmount($data->final_amount) }}
                                                {{ __($data->currency) }}</strong>
                                        </td>
                                        <td data-label="@lang('Status')">
                                            @if ($data->status == 2)
                                                <span class="badge badge--warning">@lang('Pending')</span>
                                            @elseif($data->status == 1)
                                                <span class="badge badge--success">@lang('Completed')</span>
                                                <button class="btn-info btn-rounded  badge approveBtn"
                                                    data-admin_feedback="{{ $data->admin_feedback }}"><i
                                                        class="fa fa-info"></i></button>
                                            @elseif($data->status == 3)
                                                <span class="badge badge--danger">@lang('Rejected')</span>
                                                <button class="btn--info btn--rounded badge approveBtn"
                                                    data-admin_feedback="{{ $data->admin_feedback }}"><i
                                                        class="fa fa-info"></i></button>
                                            @endif

                                        </td>
                                        <td data-label="@lang('Time')">
                                            {{ showDateTime($data->created_at) }}
                                        </td>
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
                    @if ($withdraws->hasPages())
                        {{ paginateLinks($withdraws) }}
                    @endif
                </div>
            </div>
        </div>

        {{-- Detail MODAL --}}
        <div id="detailModal" class="modal custom--modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Details')</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="withdraw-detail"></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--gamma" data-dismiss="modal">@lang('Close')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            "use strict";
            $('.approveBtn').on('click', function() {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');
                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush
