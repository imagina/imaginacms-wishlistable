<div class="item item-layout-1 list-card-item mb-3">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <p class="item-card-title">
                {{trans("wishlistable::wishlists.list.title")}}: {{$item->title}}
            </p>

            {{--
                TODO
                Cuando se eliminaba un Producto, no lo esta eliminando de la tabla "wishlistable__wishlistables" a pesar que si tenga claves foreaneas
                Por eso el count siempre muestra una cantidad
                Parece que es por lo del audistamp
            --}}
            {{--
            <p class="item-card-subtitle">{{trans("wishlistable::wishlists.list.item quantity")}}: {{$item->wishlistables()->count()}}</p>
            --}}

            <!-- Global method "deleteFromItemList in Isite -->
            <a onclick="confirmDelete({{$item->id}})"
                title="{{trans("wishlistable::wishlists.list.delete")}}"
                class="item-card-delete mb-4 mb-lg-0 cursor-pointer">
                 {{trans("wishlistable::wishlists.list.delete")}}
             </a>

        </div>
        <div class="col-lg-6 text-right">
            <x-isite::button buttonClasses="button-base button-primary button-normal rounded"
                             withIcon="false"
                             withLabel="true"
                             :label="trans('wishlistable::wishlists.list.show')"
                             sizeLabel="16"
                             color="white"
                             :href="$item->url"
            />
        </div>
    </div>
</div>