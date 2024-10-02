@php $wishData = json_encode(["entityName" => $entityName, "entityId" => $entityId,"from" => "createFromModalList"]); @endphp

@if($type=="icon")
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
                :onclick="'window.livewire.emit(\'initProcess\','.$wishData.')'"
        />
        </div>
    </div>
@endif

@if($type=="btn")
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
                    dataTarget="#wishlistAddList"
                :onclick="'window.livewire.emit(\'initProcess\','.$wishData.')'"
            />
        </div>
    </div>
@endif