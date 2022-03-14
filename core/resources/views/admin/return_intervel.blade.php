@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th>@lang('Name')</th>
                                    <th>@lang('Time')
                                        <br>
                                        <small>@lang('(** Hours One Time Return)')</small>
                                    </th>
                                    <th>@lang('Created')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($returnIntervels as $key => $data)
                                    <tr>
                                        <td data-label="@lang('Name')">{{ $data->name }}</td>
                                        <td data-label="@lang('Time')">{{ $data->intervel }} @lang('Hours')</td>
                                        <td data-label="@lang('Created')">{{ diffForHumans($data->created_at) }}</td>
                                        <td data-label="@lang('Action')">
                                            <button class="btn btn-sm btn--primary text--small editReturnIntervelBtn"
                                                data-resourse="{{ $data }}"><i
                                                    class="las la-edit text--shadow"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                    </tr>

                                @endforelse

                            </tbody>
                        </table><!-- table end -->
                        <tfoot>
                            @if ($returnIntervels->hasPages())
                                {{ paginateLinks($returnIntervels) }}
                            @endif
                        </tfoot>
                    </div>
                </div>
            </div><!-- card end -->
        </div>
    </div>

    <!--Add Return Intervel Times Modal -->
    <div class="modal fade" id="addCategoryModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('Add Return Intervel')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.return.intervel.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">@lang('Name')<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="name" placeholder="@lang('Enter Name')"
                                name="name" value="{{ old('name') }}" requiredautocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="intervel">@lang('Return Intervel')<span class="text-danger"> *</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-lg" name="intervel" id="intervel"
                                    value="{{ old('intervel') }}" placeholder="@lang('Enter Hours')" autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">@lang('Hours')</div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn--primary">@lang('Save')</button>
                </div>
                </form>
            </div>

        </div>
    </div>

    <!--Update Return Intervel Times Modal -->
    <div class="modal fade" id="updateReturnIntervelBtn">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">@lang('Update Return Intervel')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="text-danger" aria-hidden="true">&times;</span>
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="edit-route" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="forumName">@lang('Name')</label>
                            <input type="text" class="form-control edit-name" id="forumName"
                                placeholder="@lang('Update Category name')" name="name" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="intervel">@lang('Return Intervel')<span class="text-danger"> *</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control form-control-lg edit-intervel" name="intervel"
                                    id="intervel" placeholder="@lang('Enter Hours')" autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">@lang('Hours')</div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Close')</button>
                    <button type="submit" class="btn btn--primary">@lang('Update')</button>
                </div>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <button class="btn btn-sm btn--primary text--small" data-toggle="modal" data-target="#addCategoryModal"><i
            class="fa fa-fw fa-plus"></i>@lang('Add New')</button>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/admin/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
@endpush
@push('script')
    <script>
        (function($) {
            $('.editReturnIntervelBtn').on('click', function() {
                var modal = $('#updateReturnIntervelBtn');
                var resourse = $(this).data('resourse');
                $('.edit-name').val(resourse.name);
                $('.edit-intervel').val(resourse.intervel);
                modal.modal('show');

                modal.find('.edit-route').attr('action',
                    `{{ route('admin.return.intervel.update', '') }}/${resourse.id}`);
            });
        })(jQuery);
    </script>
@endpush
