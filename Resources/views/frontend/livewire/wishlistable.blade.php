<div class="wishlistable">
	@include('isite::frontend.partials.preloader')


	@if(count($wishlists)==0)
		@include("wishlistable::frontend.partials.content-infor")
		@include("wishlistable::frontend.partials.content-steps")
	@else

		<div id="all-lists" class="p-4 mx-4">

			@include("wishlistable::frontend.partials.content-infor")

			<div id="lists">

				@foreach($wishlists as $list)
					<div class="list list-{{$list->id}} p-4 mx-4 my-3  border">

						<h3>Lista: {{$list->title}}</h3>

						<a title="Eliminar" class="cart text-primary cursor-pointer" wire:click="deleteFromWishlist({{$list->id}})">
							Eliminar lista
						</a>

						<a title="Ver información" href="{{$list->url}}" class="cart text-primary cursor-pointer">
							Ver información
						</a>

					</div>
				@endforeach

			</div>

		</div>


	@endif

</div>
