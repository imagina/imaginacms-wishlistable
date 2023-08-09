<div class="table-responsive">
	@include('isite::frontend.partials.preloader')
	<table class="table table-bordered table-shape">
		<thead>
		<tr>
			<th class="wishlistable-image">{{trans("wishlistable::wishlistables.table.image")}}</th>
			<th class="wishlistable-item">{{trans("wishlistable::wishlistables.table.item")}}</th>
			<th class="wishlistable-action">{{trans("wishlistable::wishlistables.table.action")}}</th>
		</tr>
		</thead>
		<tbody>
		@foreach($wishlist as $item)
			@if(isset($item->entity))

			<tr>
				<td>
					<a href="{{$item->url}}">

						<img v-if="" src="{{$item->entity->mediaFiles->mainimage->relativeSmallThumb}}" alt="{{$item->entity->name ?? $item->entity->title}}"
							 class="img-responsive img-fluid w-100 h-auto">
					</a>

				</td>

				<td><a href="{{$item->url}}">{{$item->entity->name ?? $item->entity->title}} </a></td>

				<td class="text-center">
					<a title="Eliminar de la lista de deseos" wire:click="deleteFromWishlist({{$item->id}})"
					   class="cart text-primary cursor-pointer">
						<i class="fa-solid fa-trash mx-2"></i>
					</a>
				</td>
			</tr>

			@endif
		@endforeach
		@if(empty($wishlist))
		<tr>
			<td class="text-center" colspan="4">{{trans("wishlistable::wishlistables.messages.noItems")}}</td>
		</tr>
		@endif
		</tbody>
	</table>
</div>
@section('scripts')
	@parent
	<style>
		#contentWishlist  #cont_products .wishlistable-image {
			width: 150px;
		}
		#contentWishlist  #cont_products .wishlistable-action {
			width: 50px;
		}
	</style>
@stop