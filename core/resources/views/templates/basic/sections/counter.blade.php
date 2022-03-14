
@php
$element = getContent('counter.element', false, null, true);
@endphp
<div class="section stat-section">
    <div id="particles"></div>
    <div class="container">
        <div class="row gy-4 justify-content-center">
            @foreach ($element as $counter)
            <div class="col-md-6 col-xl-4">
                <div class="stat-card stat-card--danger">
                    <div class="stat-card__content flex-grow-1 me-3">
                        <div class="stat-card__icon flex-shrink-0 bg--gamma p-2 rounded">
                            <?php echo @$counter->data_values->icon ?>
                        </div>
                        <h5 class="mb-0">{{__(@$counter->data_values->title)}}</h5>
                    </div>
                    <div class="stat-card__counter">
                        <h3 class="stat-card__counter-text my-0">
                            <span class="odometer pl-2" id="deposits">{{@$counter->data_values->counter_digit}}</span>
                        </h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>


