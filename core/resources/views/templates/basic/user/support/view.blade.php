@extends($activeTemplate.'layouts.frontend')

@section('content')
    <!-- Banner -->
    <div class="banner">
        <div class="banner__content">
            <div class="container">
                <div class="row g-3 justify-content-center">
                    <div class="col-lg-10 text-center">
                        <h1 class="mt-0">@lang('Contact')</h1>
                        <ul class="list list--row breadcrumbs justify-content-center">
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('home') }}"
                                    class="t-link breadcrumbs__link text--white t-link--gamma">@lang('Home')</a>
                            </li>
                            <li class="list--row__item breadcrumbs__item">
                                <a href="{{ route('contact') }}"
                                    class="t-link breadcrumbs__link text--danger t-link--gamma">@lang('Contact')</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->



    <!-- Contact Page  -->

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom--card">
                    <div class="card-header card-header-bg d-flex flex-wrap justify-content-between align-items-center">
                        <h5 class="card-title mt-0">
                            @if ($my_ticket->status == 0)
                                <span class="badge badge--success py-2 px-3">@lang('Open')</span>
                            @elseif($my_ticket->status == 1)
                                <span class="badge badge--primary py-2 px-3">@lang('Answered')</span>
                            @elseif($my_ticket->status == 2)
                                <span class="badge badge--warning py-2 px-3">@lang('Replied')</span>
                            @elseif($my_ticket->status == 3)
                                <span class="badge badge--dark py-2 px-3">@lang('Closed')</span>
                            @endif
                            [@lang('Ticket')#{{ $my_ticket->ticket }}] {{ $my_ticket->subject }}
                        </h5>
                        <button class="btn btn-danger close-button" type="button" title="@lang('Close Ticket')"
                            data-toggle="modal" data-target="#DelModal"><i class="fa fa-lg fa-times-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <div class="card custom--card">
                                <div class="card-body">
                                    @if ($my_ticket->status != 4)
                                        <form method="post" action="{{ route('ticket.reply', $my_ticket->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="replayTicket" value="1">
                                            <div class="row justify-content-between">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <textarea name="message" class="form-control form--control-textarea"
                                                            id="inputMessage" placeholder="@lang('Your Reply')" rows="3"
                                                            cols="10"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-between">
                                                <div class="col-md-8">
                                                    <div class="row justify-content-between">
                                                        <div class="col-md-10">
                                                            <label class="my-2 t-heading-font" for="inputAttachments">
                                                                @lang('Attachments')
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <input type="file" name="attachments[]"
                                                                    class="form-control form--control" id="inputAttachments"
                                                                    aria-label="Sizing example input"
                                                                    aria-describedby="inputGroup-sizing-default">
                                                                <span
                                                                    class="input-group-text input-group-prepend text--danger addFile">
                                                                    <i class="las la-plus"></i></span>
                                                            </div>
                                                            <small class="my-2 ticket-attachments-message text-muted">
                                                                @lang('Allowed File Extensions'): .@lang('jpg'),
                                                                .@lang('jpeg'), .@lang('png'), .@lang('pdf'),
                                                                .@lang('doc'), .@lang('docx')
                                                            </small>
                                                            <div id="fileUploadsContainer"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-3  mt-4">
                                                    <button type="submit" class="btn btn--lg btn--success mt-3">
                                                        <i class="fa fa-reply"></i> @lang('Reply')
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card custom--card">
                                    <div class="card-body">
                                        @foreach ($messages as $message)
                                            @if ($message->admin_id == 0)
                                                <div class="row border border-primary border-radius-3 my-3 py-3 mx-2">
                                                    <div class="col-md-3 border-right text-right">
                                                        <h5 class="my-3">{{ $message->ticket->name }}</h5>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <small class="text-muted font-weight-bold my-3">
                                                            @lang('Posted on')
                                                            {{ $message->created_at->format('l, dS F Y @ H:i') }}
                                                        </small>
                                                        <p>{{ $message->message }}</p>
                                                        @if ($message->attachments->count() > 0)
                                                            <div class="mt-2">
                                                                @foreach ($message->attachments as $k => $image)
                                                                    <a href="{{ route('ticket.download', encrypt($image->id)) }}"
                                                                        class="mr-3"><i
                                                                            class="fa fa-file"></i>
                                                                        @lang('Attachment') {{ ++$k }} </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <div class="row border border-warning border-radius-3 my-3 py-3 mx-2"
                                                    style="background-color: #ffd96729">
                                                    <div class="col-md-3 border-right text-right">
                                                        <h5 class="my-3">{{ $message->admin->name }}</h5>
                                                        <small class="lead text-muted">@lang('Staff')</small>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <small class="text-muted font-weight-bold my-3">
                                                            @lang('Posted on')
                                                            {{ $message->created_at->format('l, dS F Y @ H:i') }}</small>
                                                        <p>{{ $message->message }}</p>
                                                        @if ($message->attachments->count() > 0)
                                                            <div class="mt-2">
                                                                @foreach ($message->attachments as $k => $image)
                                                                    <a href="{{ route('ticket.download', encrypt($image->id)) }}"
                                                                        class="mr-3"><i
                                                                            class="fa fa-file"></i>
                                                                        @lang('Attachment') {{ ++$k }} </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal custom--modal  fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title method-name" id="withdrawModalLabel">@lang('Withdraw')</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-content">
                    <form method="post" action="{{ route('ticket.reply', $my_ticket->id) }}">
                        @csrf
                        <input type="hidden" name="replayTicket" value="2">
                        <div class="modal-body">
                            <strong>@lang('Are you sure you want to close this support
                                ticket')?</strong>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i
                                    class="fa fa-times"></i>
                                @lang('Close')
                            </button>
                            <button type="submit" class="btn btn--gamma btn-sm"><i class="fa fa-check"></i>
                                @lang("Confirm")
                            </button>
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
            $('.delete-message').on('click', function(e) {
                $('.message_id').val($(this).data('id'));
            });
            $('.addFile').on('click', function() {
                $("#fileUploadsContainer").append(
                    ` <div class="input-group mb-3">
                             <input type="file" name="attachments[]" class="form-control form--control" id="inputAttachments"aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                             <span class="input-group-text input-group-prepend text--danger remove-btn"> <i class="las la-times"></i></span>
                         </div>`
                )
            });
            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
@endpush
