@section('scripts')
    @parent

    <script type="text/javascript" defer>
        
        function confirmDelete(id){
            Swal.fire({
                title: '{{trans('wishlistable::frontend.title.delete')}}',
                text: '{{trans('wishlistable::frontend.messages.sure delete')}}',
                cancelButtonText: '{{trans('wishlistable::frontend.button.cancel')}}',
                showCancelButton: true,
                confirmButtonText: '{{trans('wishlistable::frontend.button.confirm')}}',
                showCloseButton: true,
                background: "#f5f5f5",
                focusConfirm: false,
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
                    //Global method "deleteFromItemList in Isite | Remember depends some attributes in item lists (Check wishlist/index-list/default/index)
					window.livewire.dispatch('deleteFromItemList',id);
                }
            });
        }

    </script>

@stop