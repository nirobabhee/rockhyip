@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Plan Name')</th>
                                    <th scope="col">@lang('Amount')</th>
                                    <th scope="col">@lang('Interest')</th>
                                    <th scope="col">@lang('Capital Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($investments as $investment)
                                    <tr>
                                        <td data-label="@lang('Plan Name')">{{ $investment->plan->name }}</td>
                                        <td data-label="@lang('Amount')">{{ showAmount($investment->amount) }}</td>
                                        <td data-label="@lang('Amount')">{{ showAmount($investment->interest) }}</td>
                                        <td data-label="@lang('Capital Repeat')">
                                            @if ($investment->plan->repeat_time == 0)
                                                <span class="badge badge--success">@lang('Capital Lifetime')</span>
                                            @else
                                                <span class="badge badge--primary">@lang('Capital Will Back')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="javascript:void(0)"
                                                data-investment_details="{{ $investment->details }}"
                                                data-next_interest="{{ showDateTime($investment->next_time) }}"
                                                data-total_interest_receive="{{ $investment->receive_return }}"
                                                data-status="{{ $investment->status }}" class="icon-btn investment"
                                                data-toggle="modal" data-target="#investmentModal"><i
                                                    class="las la-desktop"></i></a>


                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">
                                            <h6 class="d-flex justify-content-center">
                                                {{ __($emptyMessage) }}
                                            </h6>
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    @if ($investments->hasPages())
                        {{ paginateLinks($investments) }}
                    @endif
                </div>
            </div><!-- card end -->
        </div>
    </div>
    {{-- //Modal --}}
    <div class="modal custom--modal fade" id="investmentModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">{{ $pageTitle }} @lang('Details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">


                        <li class="list-group-item d-flex justify-content-between ">
                            <b>@lang('Details')</b>
                            <span class="details"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>@lang('Upcoming Interest Time')</b>
                            <span class="nextInterest"></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>@lang('Total Receive Interest')</b>
                            <span class="totalReceive"></span>

                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>@lang('Investment Status')</b>
                            <span class="status"></span>
                        </li>
                    </ul>


                </div>

            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(function() {
            $('.investment').on('click', function() {




                var details = $(this).data('investment_details')
                var next_interest_time = $(this).data('next_interest')
                var total_receive = $(this).data('total_interest_receive')
                var status = $(this).data('status')


                $('.details').text(details);
                $('.nextInterest').text(next_interest_time);
                $('.totalReceive').text(total_receive);
                console.log(status == 1);
                if (status == 1) {
                    var status = `<span class="badge badge--success"> Continuing </span>`;
                    $('.status').html(status);
                } else {
                    var over = `<span class="badge badge--danger"> Time Over</span>`;
                    $('.status').html(over);

                }
            });
        });
    </script>

@endpush
