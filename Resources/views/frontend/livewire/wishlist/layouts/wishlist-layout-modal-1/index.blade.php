<div class="wishlist-layout-modal-1">

	<!-- Button -->
	<x-isite::button buttonClasses="button-base button-secondary button-normal rounded"
		withIcon="false"
		withLabel="true"
		label="Crear nueva lista"
		sizeLabel="16"
		color="primary"
		:onclick="'createList()'"
		/>


	<!-- Modal -->
    <div class="modal fade wishlist-modal-list" id="wishlistModal" tabindex="-1" role="dialog" aria-labelledby="wishlistModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="wishlistModalLabel">
                        <i class="fa-solid fa-list-check mr-2"></i> {{trans('wishlistable::wishlists.title.create your new list')}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

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
                        >

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn">{{trans('wishlistable::wishlists.button.create wishlist')}}</button>
                </div>
            </div>
        </div>
    </div>

</div>

@section('scripts')
    @parent

    <script type="text/javascript" defer>
        /* activar modal de bootstrap */
        /*
        function createList(){
            $('#wishlistModal').modal('show');
        }*/
        function createList(){
            Swal.fire({
                title: `<i class="fa-solid fa-list-check mr-2"></i> {{trans('wishlistable::wishlists.title.create your new list')}} `,
                background: "#f5f5f5",
                html: `
            <div class="text-center mb-3"><i class="fa-solid fa-list-check d-block"></i>
            Nombra y crea tu lista
            </div>
          `,
                showCloseButton: true,
                showCancelButton: false,
                focusConfirm: false,
                inputPlaceholder: "{{trans('wishlistable::wishlists.input.write the name')}}",
                confirmButtonText: "{{trans('wishlistable::wishlists.button.create wishlist')}}",
                input: "text",
                customClass: {
                    container: 'swal2-icommerce-modal-list',
                },
                showClass: {
                    popup: `
              animate__animated
              animate__fadeInUp
              animate__faster
            `
                },
                hideClass: {
                    popup: `
              animate__animated
              animate__fadeOutDown
              animate__faster
            `
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Emit-Create');
					window.livewire.dispatch('addToWishList_{{$this->id}}',{'title' : result.value});
                }
            });
        }

    </script>

@stop