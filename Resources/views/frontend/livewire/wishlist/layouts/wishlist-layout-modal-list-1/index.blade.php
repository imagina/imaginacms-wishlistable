<div class="wishlist-layout-modal-list-1">

  <div class="text-right">
    <div id="listCheck"
         class="mb-2 d-inline-block"
         data-toggle="tooltip"
         data-placement="top"
         title=" {{trans('wishlistable::wishlists.title.add to wishlist')}}">
      
      <x-isite::button
              style="outline"
              buttonClasses="button-small rounded-pill"
              :withIcon="true"
              iconClass="fa-solid fa-list-check"
              sizeLabel="16"
              color="dark"
              dataTarget="#wishlistAddList"

      />
      
    </div>
  </div>

  <div wire:ignore.self class="modal fade wishlist-modal-list" id="wishlistAddList" tabindex="-1" role="dialog" aria-labelledby="wishlistModalListLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="wishlistModalListLabel">
            <i class="fa-solid fa-list-check mr-2"></i> {{trans('wishlistable::wishlists.list.myLists')}}
          </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="text-center mb-3">

              @if(!is_null($user))
                <!-- DEFAULT -->
                @if($showInfor==false)

                  <x-media::single-image :mediaFiles="$item->mediaFiles()" :isMedia="true"
                          :alt="$item->title" zone="mainimage" imgClasses="image-product"/>
                  <div class="mt-2 mb-3 font-weight-bold">{{$item->name}}</div>
                  
                  @if(!empty($wishlists) && count($wishlists)>0)
                      <select class="custom-select form-control"  name="wishlistSelected" wire:model.defer="wishlistSelected">
                        <option value="0">{{trans('wishlistable::wishlists.title.select a wishlist')}}</option>
                        @foreach ($wishlists as $list)
                          <option value="{{$list->id}}">{{$list->title}}</option>
                        @endforeach
                      </select>
                  @endif

                @else
                    <!-- INFOR TO CREATE LIST -->
                    @include('wishlistable::frontend.livewire.partials.input-create')
                @endif

              @else
                <div id="msj-user-not-logged" class="mt-4">{{trans('wishlistable::wishlistables.messages.unauthenticated')}}</div>
              @endif
                
          </div>
        </div>
        <div class="modal-footer">

          <!-- BUTTONS TO ADD ITEM IN THE WISHLIST SELECTED -->
          @if($showInfor==false)
            @if(!is_null($user))
              <button type="button" class="btn outline" wire:click="showInforToCreate" >{{trans('wishlistable::wishlists.button.create wishlist')}}</button>
            @endif
            @if(!empty($wishlists) && count($wishlists)>0)
              <button id="btnAddItemToWishlist" type="button" class="btn" wire:click="btnAddItemToWishlist({{$item->id}})">{{trans('wishlistable::wishlists.button.save wishlist')}}</button>
            @endif
          @else
            <!-- BUTTONS TO CREATE LIST -->
            <button type="button" class="btn"  wire:click="addToWishList('createFromModalList')" >{{trans('wishlistable::wishlists.button.create wishlist')}}</button>
            <button type="button" class="btn outline btn-danger" wire:click="showInforToCreate" >{{trans('wishlistable::wishlists.button.cancel')}}</button>
          @endif

        </div>
      </div>
    </div>
  </div>

</div>

@section('scripts')
  @parent
  
    @include("wishlistable::frontend.partials.style-modal")
    
    <script type="text/javascript" defer>
      $('#listCheck').tooltip();

      //Event to close modal
      window.addEventListener('wishlist-close-modal', event => {
					$('#wishlistAddList').modal('hide');
			})

    
    </script>
@stop