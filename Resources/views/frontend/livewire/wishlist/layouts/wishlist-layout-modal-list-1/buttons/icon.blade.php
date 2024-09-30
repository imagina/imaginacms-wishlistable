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
              dataTarget="#wishlistAddList{{$item->id}}"
              onclick="window.livewire.emit('initProcess_{{$this->id}}')"

      />
      
    </div>
  </div>