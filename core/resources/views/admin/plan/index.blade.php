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
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Investment Limit')</th>
                                    <th scope="col">@lang('Return-Type')</th>
                                    <th scope="col">@lang('Return Intervel')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($plans as $plan)
                                    <tr>
                                        <td data-label="@lang('Name')">{{ $plan->name }}</td>
                                        <td data-label="@lang('Investment')">
                                            @if ($plan->minimum_investment == 0)
                                                <span>{{ $general->cur_sym . '' . $plan->maximum_investment }}</span>
                                            @else
                                                <span>{{ $general->cur_sym . '' . $plan->minimum_investment }}
                                                    - {{ $general->cur_sym . '' . $plan->maximum_investment }}</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Return-Type')">
                                            @if ($plan->interest_status == 1)
                                                <span>{{ $plan->interest }} %</span>
                                            @else
                                                <span>{{ $plan->interest . ' ' . $general->cur_text }}
                                                </span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Status')">

                                            {{-- <span class="badge badge--info">{{__($plan->intervel->name)}}</span> --}}
                                            <span class="badge badge--info">
                                                @if ($plan->times == 24)
                                                    @lang('Daily')
                                                @elseif($plan->times == 168)
                                                    @lang('Weekly')
                                                @elseif($plan->times == 720)
                                                    @lang('Monthly')
                                                @elseif($plan->times == 8760)
                                                    @lang('Yearly')
                                                    @elseif($plan->times == 1)
                                                    @lang('Hourly')
                                                @else
                                                    {{ $plan->times . ' ' . $plan->intervel->name }}
                                                @endif
                                            </span>

                                        </td>
                                        <td data-label="@lang('Status')">
                                            @if ($plan->status == 1)
                                                <span class="badge badge--success">@lang('Active')</span>
                                            @else
                                                <span class="badge badge--warning">@lang('Inactive')</span>
                                            @endif
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <a href="{{ route('admin.plan.edit', $plan->id) }}" class="icon-btn"><i
                                                    class="las la-pen"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>
                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    @if ($plans->hasPages())
                        {{ paginateLinks($plans) }}
                    @endif
                </div>
            </div><!-- card end -->
        </div>

    </div>
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('admin.plan.create') }}" class="btn btn--primary box--shadow1 text--small"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New')</a>
@endpush
