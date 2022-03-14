@php
$content = getContent('expert_team.content', true);
$element = getContent('expert_team.element', false, null, true);
@endphp
<div class="section bg--alpha">
    <div class="section__head">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <h2 class="mt-0 text-center">{{ __(@$content->data_values->heading) }}</h2>
                    <p class="mb-0 mx-auto text-center t-short-para">
                        {{ __(@$content->data_values->subheading) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row gy-4 justify-content-center">
            @foreach ($element as $member)
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="team-member">
                        <div class="team-member__img">
                            <a href="" class="t-link d-inline-block">
                                <img src="{{ getImage('assets/images/frontend/expert_team/' . @$member->data_values->image,'1000x650') }}"
                                    alt="{{ __($general->sitename) }}" class="team-member__img-is" />
                            </a>
                            <div class="team-member__share flex-column">
                                <h5 class="mt-0">{{ __(@$member->data_values->name) }} </h5>
                                <h6 class="mt-0 mb-3 sm-text text-center">{{ __(@$member->data_values->designation) }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                @if (!$loop->last)  @endif
            @endforeach

        </div>
    </div>
</div>
