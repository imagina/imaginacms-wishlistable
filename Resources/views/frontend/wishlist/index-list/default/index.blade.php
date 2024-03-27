@extends('iprofile::frontend.layouts.master')


@section('title')
  {{trans("wishlistable::wishlistables.title.myWishlist")}}   | @parent
@stop

@section('profileContent')

<div id="contentWishlist" class="index-list index-list-default">

    @include("wishlistable::frontend.partials.header-list-item")

    <div class="list-card">

        <div class="list-card-body">

        <livewire:isite::items-list
          moduleName="Icommerce"
          itemComponentName="icommerce::product-list-item"
          itemComponentNamespace="Modules\Icommerce\View\Components\ProductListItem"
          :itemComponentAttributes="['showDeleteBtn' => true]"
          entityName="Product"
          :title="$data['title']"
          :params="[
          'filter' => ['wishlist' => $data['wishlistId']],
          'include' => ['translations'],
          'take' => setting('icommerce::product-per-page',null,12)]"
          :configOrderBy="config('asgard.wishlistable.config.orderBy')"
          :pagination="config('asgard.wishlistable.config.pagination')"
          :responsiveTopContent="['mobile'=>false,'desktop'=>false]"
          :configLayoutIndex="config('asgard.wishlistable.config.layoutShow')"
          :eventToDelete="[
            'eventName'=> 'deleteFromWishlist', 
            'params' => [
              'wishlistId'=> $data['wishlistId']
            ]
          ]"/>


        </div>

    </div>

    @include('wishlistable::frontend.partials.extra-buttons')

</div>
@include("wishlistable::frontend.partials.style")
@stop

<!-- ALERT MODAL TO DELETE -->
@include("wishlistable::frontend.partials.confirm-delete")