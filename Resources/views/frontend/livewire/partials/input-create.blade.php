<div class="text-center mb-3">

	<div class="modal-subtitle">
		<i class="fa-solid fa-list-check d-block"></i>
		{{trans('wishlistable::wishlists.title.name and create your list')}}
	</div>

	<input
			type="text"
			id="wishlistTitle"
			name="wishlistTitle"
			class="form-control mx-auto"
			placeholder="{{trans('wishlistable::wishlists.input.write the name')}}"
			wire:model.defer="wishlistTitle"
	>
	
</div>