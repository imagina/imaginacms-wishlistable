<div class="text-center">
    <div id="listCheck"
         class="mb-2 d-inline-block">
        <x-isite::button
                style="outline"
                buttonClasses="button-small rounded-pill"
                :withIcon="true"
                iconClass="fa-solid fa-list-check"
                sizeLabel="13"
                color="primary"
                :withLabel="true"
                :label="trans('wishlistable::wishlists.title.add to wishlist')"
                dataTarget="#wishlistAddList{{$item->id}}"
                onclick="window.livewire.emit('initProcess_{{$this->id}}')"
        />

        
    </div>
</div>