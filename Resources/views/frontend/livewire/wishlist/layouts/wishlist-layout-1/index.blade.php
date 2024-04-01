<div class="wishlist wishlist-layout-1">
@if($showButton)
	<a href="{{\URL::route(\LaravelLocalization::getCurrentLocale() . '.wishlistable.wishlist.index')}}" class="btn-wishlist {{$classWishlists}}">
		@if(!empty($quantity))
		   <span class="quantity text-dark">{{$quantity}}</span>
		@endif
		<i class="{{$icon}}" aria-hidden="true"></i><span class="wishlist-label">{{$label}}</span>
	</a>
@endif
</div>
@section('scripts')
	@parent
	@if(!empty($styleWishlists))
	<style>
	.wishlist-layout-1 .btn-wishlist {
	{!!$styleWishlists!!}
	}
	</style>
	@endif
@stop