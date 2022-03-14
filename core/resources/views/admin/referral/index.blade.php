@extends('admin.layouts.app')
@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12">
            <div class="card">
                <form action="" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="type" class="my-2 font-weight-bold">@lang('Type') <span
                                        class="text--danger">*</span></label>
                                <select name="type" class=" form-control form-control-md">
                                    <option value="">@lang('Select Type')</option>
                                    <option value="1">@lang('Deposit')</option>
                                    <option title="Return on Interest" value="2">@lang('ROI')</option>
                                </select>

                                <div class="mt-3">
                                    <label class="font-weight-bold">@lang('Number of Commission Level') <span
                                            class="text--danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control  form-control-md" name="level_number"
                                            placeholder="@lang('Enter Commission Level Number')">
                                        <div class="input-group-append">
                                            <button class="btn btn--primary btn-block addLevel" type="button"><i
                                                    class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="FormLevel"></div>
                                </div>
                            </div>

                            <div class="col-md-6 pt-2">
                                <div class="card mt-4">
                                    <div class="card-header bg--primary d-flex justify-content-around">
                                        <span class="text-white ">@lang('Type')</span>
                                        <span class="text-white ">@lang('Level')</span>
                                        <span class="text-white">@lang('Commission')</span>
                                    </div>

                                    @foreach ($commissions as $commission)
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-around align-items-center">
                                                @if ($commission->type == 1)
                                                    <span>@lang('Deposit')</span>
                                                @else
                                                    <span>@lang('ROI')</span>
                                                @endif
                                                {{ __('Level - ' . @$commission->level) }}
                                                <span>{{ __($commission->percent) . '%' }}</span>
                                            </li>
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Submit')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        (function($) {
            var commissions = {!! $commissions !!};
            $('.addLevel').on('click', function() {
                $('.FormLevel').empty();
                var levelNumber = $('input[name=level_number]').val();
                levelNumber = parseInt(levelNumber);
                if (!Number.isInteger(levelNumber)) {
                    $('input[name=level_number]').val('');
                    return notify('error', 'Put your desire commission level number');
                }
                var type = $("select option").filter(":selected").val();
                if (!type) {
                    return notify('error', 'Select referral type');
                }
                for (var i = 0; i < levelNumber; i++) {

                    if (commissions.length > 0 && commissions.length > i) {
                        $('.FormLevel').append(`
                            <div class="form-group ">
                                    <label class="font-weight-bold" class="LevelLabel">@lang('Percentage Level - ')${i+1}</label>
                                    <div class="input-group">
                                        <input value="${commissions[i].percent}" type="number" class="form-control form-control-md" name="commissions[]" step="any" required/>
                                        <div class="input-group-append">
                                            <span class="input-group-text text--danger remove-btn" onclick="deleteItem(this)">
                                            <i class="fas fa-times"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        `);
                    } else {
                        $('.FormLevel').append(`
                                 <div class="form-group ">
                                    <label class="font-weight-bold" class="LevelLabel">@lang('Percentage Level - ')${i+1}</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-lg" type="number" step="any" placeholder="Enter Commission %" name="commissions[]" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text text--danger remove-btn" onclick="deleteItem(this)">
                                            <i class="fas fa-times"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                        `);
                    }
                }
            })
        })(jQuery);
        //remove Item with re-arrange lable
        function deleteItem(e) {
            var levelNumber = $('input[name=level_number]').val();
            levelNumber = parseInt(levelNumber);
            $(e).parent().parent().parent().remove();
            for (var i = 1; i <= $('.FormLevel').children().length; i++) {
                $($($('.FormLevel').children()[i - 1]).children()[0]).text('Percentage Level -  ' + i)
            }
        }
    </script>
@endpush
