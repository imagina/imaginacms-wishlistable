<div id="contentSteps" class="list-card-steps">
    <div>
        <div class="list-card-num-title align-items-center">
            <div class="icon-num">1</div>
            <div>{{ trans('wishlistable::wishlists.list steps.step1') }}</div>
        </div>
        <div class="card-step card shadow">
            <x-media::single-image :isMedia="true" src="{{url('/modules/wishlistable/img/list-steps/step1.jpg')}}" alt="Step 1"/>
        </div>
    </div>
    <div>
        <div class="list-card-num-title align-items-center">
            <div class="icon-num">2</div>
            <div>{{ trans('wishlistable::wishlists.list steps.step2') }}</div>
        </div>
        <div class="card-step card shadow">
            <x-media::single-image :isMedia="true" src="{{url('/modules/wishlistable/img/list-steps/step2.jpg')}}" alt="Step 2"/>
        </div>
    </div>
    <div>
        <div class="list-card-num-title">
            <div class="icon-num">3</div>
            <div>{!!  trans('wishlistable::wishlists.list steps.step3')  !!}</div>
        </div>
        <div class="card-step card shadow">
            <x-media::single-image :isMedia="true" src="{{url('/modules/wishlistable/img/list-steps/step3.jpg')}}" alt="Step 3"/>
        </div>
    </div>
    <div>
        <div class="list-card-num-title">
            <div class="icon-num">4</div>
            <div>{{ trans('wishlistable::wishlists.list steps.step4') }}</div>
        </div>
        <div class="card-step card shadow">
            <x-media::single-image :isMedia="true" src="{{url('/modules/wishlistable/img/list-steps/step4.jpg')}}" alt="Step 4"/>
        </div>
    </div>
</div>