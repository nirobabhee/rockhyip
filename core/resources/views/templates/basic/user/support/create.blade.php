@extends($activeTemplate.'layouts.frontend')
@section('content')
   <div class="section">
    <!-- Contact Page  -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card custom--card">

                    <div class="card-body">
                        <form action="{{ route('ticket.store') }}" method="post" enctype="multipart/form-data"
                            onsubmit="return submitUserForm();" class="row">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name" class="my-2 t-heading-font">@lang('Name')</label>
                                    <input type="text" name="name" value="{{ @$user->firstname . ' ' . @$user->lastname }}"
                                        class="form-control form--control" placeholder="@lang('Enter your name')" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email" class="my-2 t-heading-font">@lang('Email address')</label>
                                    <input type="email" name="email" value="{{ @$user->email }}"
                                        class="form-control form--control" placeholder="@lang('Enter your email')" readonly>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="website" class="my-2 t-heading-font">@lang('Subject')</label>
                                    <input type="text" name="subject" value="{{ old('subject') }}"
                                        class="form-control form-control-lg" placeholder="@lang('Subject')">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="priority" class="my-2 t-heading-font">@lang('Priority')</label>
                                    <select name="priority" class="form-select form--select">
                                        <option value="3">@lang('High')</option>
                                        <option value="2">@lang('Medium')</option>
                                        <option value="1">@lang('Low')</option>
                                    </select>
                                </div>
                                <div class="col-12 form-group">
                                    <label for="inputMessage" class="my-2 t-heading-font">@lang('Message')</label>
                                    <textarea name="message" id="inputMessage" rows="6"
                                        class="form-control form--control-textarea"
                                        placeholder="@lang('Your Message')">{{ old('message') }}</textarea>
                                </div>
                            </div>

                            <div class="row form-group ">
                                <div class="col-sm-10 file-upload">
                                    <label for="inputAttachments" class="my-2 t-heading-font">@lang('Attachments')</label>

                                    <div class="input-group mb-3">
                                        <input type="file" name="attachments[]" class="form-control form--control"
                                            id="inputAttachments" aria-label="Sizing example input"
                                            aria-describedby="inputGroup-sizing-default">
                                        <span class="input-group-text input-group-prepend text--danger addFile">
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

                            <div class="row form-group justify-content-center mt-2">
                                <div class="col-md-12">
                                    <button class="btn btn--gamma" type="submit" id="recaptcha"><i
                                            class="fa fa-paper-plane"></i>&nbsp;@lang('Submit')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection


@push('script')
    <script>
        (function($) {
            $('.addFile').on('click', function() {
                $("#fileUploadsContainer").append(`


                    <div class="input-group mb-3">
                             <input type="file" name="attachments[]" class="form-control form--control" id="inputAttachments"aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                             <span class="input-group-text input-group-prepend text--danger remove-btn"> <i class="las la-times"></i></span>
                         </div>
                `)
            });
            $(document).on('click', '.remove-btn', function() {
                $(this).closest('.input-group').remove();
            });
        })(jQuery);
    </script>
@endpush
