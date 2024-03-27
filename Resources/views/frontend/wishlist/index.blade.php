@extends('iprofile::frontend.layouts.master')

@section('title')
    {{trans("wishlistable::wishlistables.title.myWishlist")}}   | @parent
@stop


@section('profileContent')
    <div id="contentWishlist">
        <h2 class="list-title">{{ trans('wishlistable::wishlists.list.myLists') }}</h2>

        <div class="list-card">

            <div class="list-card-body">

                @if(count($wishlists)==0)

                    @include("wishlistable::frontend.partials.content-infor")
                    @include("wishlistable::frontend.partials.content-steps")

                @else

                    @include("wishlistable::frontend.partials.content-infor")

                    <livewire:isite::items-list
                            moduleName="Wishlistable"
                            itemComponentName="wishlistable::item"
                            itemComponentNamespace="Modules\Wishlistable\View\Components\Item"
                            entityName="Wishlist"
                            :showTitle="false"
                            :params="['filter' => ['userId' => $user->id],'take' => setting('wishlistable::items-per-page',null,12)]"
                            :configOrderBy="config('asgard.wishlistable.config.orderBy')"
                            :pagination="config('asgard.wishlistable.config.pagination')"
                            :responsiveTopContent="['mobile'=>false,'desktop'=>false]"
                            :configLayoutIndex="config('asgard.wishlistable.config.layoutIndex')"/>

                @endif


            </div>
        </div>

    </div>

    @include("wishlistable::frontend.partials.style")
@stop

<!-- ALERT MODAL TO DELETE -->
@include("wishlistable::frontend.partials.confirm-delete")