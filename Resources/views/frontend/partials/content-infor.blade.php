<div id="content-infor" class="list-card-item item-light">
	<div class="row align-items-center">
		<div class="col-lg-6">
			<p class="item-card-title">{{ trans('wishlistable::wishlists.list.myProductLists') }}</p>
			<p class="item-card-subtitle">{{ trans('wishlistable::wishlists.list.myProductListsSummary') }} </p>
		</div>
		<div class="col-lg-6 text-right">
			<!-- Wishlist Modal Basic (Create List)-->
			@livewire("wishlistable::wishlist",["layout"=>"wishlist-layout-modal-1"])

		</div>
	</div>
</div>

