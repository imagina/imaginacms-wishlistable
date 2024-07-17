<?php

namespace Modules\Wishlistable\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Modules\Wishlistable\Transformers\WishlistTransformer;

class WishlistTable extends Component
{

  use LivewireAlert;
  /*
  * Attributes From Config
  */
  public $moduleView;
  public $wishlist; //Specific wishlist
  private $params;
  public $wishlists;
  public $items; //Wishlistable
  public $wishlistTitle;
  private $log = "Wishlistable: Livewire|Wishlistable|";

  public function mount(Request $request, $showButton = false, $mainWishlist = null)
  {

    if (is_null($mainWishlist)) {

      $this->moduleView = 'wishlistable::frontend.livewire.wishlistable';
      $this->getWishlists();

    } else {

      //Set wishlist
      $this->wishlist = $mainWishlist;

      //default tpl (Default es la de product)
      $tpl = 'wishlistable::frontend.livewire.index-list.default.index';

      //specific tpl
      $type = $this->wishlistService()->getType($mainWishlist->type);
      $tplList = 'wishlistable::frontend.livewire.index-list.' . $type . '.index';
      if (view()->exists($tplList)) $tpl = $ttpl;

      //Set view
      $this->moduleView = $tpl;

      //Get Items
      $this->getWishlistItems();

    }

    $this->showButton = $showButton;
    $this->quantity = null;

  }

  /**
   * @return wishListEntity
   */
  public function wishlistEntity()
  {
    return app('Modules\Wishlistable\Entities\Wishlistable');
  }

  /**
   * @return wishlistService
   */
  public function wishlistService()
  {
    return app('Modules\Wishlistable\Services\WishlistService');
  }

  /**
   * Render Wishlist or Wishlist Item
   */
  public function render()
  {

    return view($this->moduleView);

  }

  /**
   * Wishlist - GET
   */
  public function getWishlists()
  {
    $this->wishlists = null;

    $user = \Auth::user();//Get user
    $wishlists = $this->wishlistService()->getUserWishlists($user->id);

    if (!is_null($wishlists)) {
      $this->wishlists = $wishlists;
    }

  }

  /**
   *  Wishlist - ADD (No se donde lo stan utilizando)
   */
  public function addToWishList($data)
  {
    \Log::info($this->log . "addToWishList");

    $user = \Auth::user();//Get user
    //Validate session
    if (!$user) {
      $this->alert('warning', trans('wishlistable::wishlistables.messages.unauthenticated'), [
        'position' => 'top-end',
        'iconColor' => setting("isite::brandPrimary", "#fff")
      ]);
    } else {
      //Create or update product
      $this->wishlistEntity()->updateOrCreate(
        ['user_id' => $user->id, 'wishlistable_type' => $data["entityName"], 'wishlistable_id' => $data["entityId"]]
      );
      $this->initQuantity();
      //Message
      $this->alert('success', trans('wishlistable::wishlistables.messages.itemAdded'), config("asgard.isite.config.livewireAlerts"));
    }
  }

  /**
   *  Wishlist - DELETE
   */
  public function deleteFromWishlist($id)
  {
    //\Log::info($this->log."deleteFromWishlist");

    dd("WISHLISTABLE - ELIMINAR");
    $user = \Auth::user();//Get user
    //Validate session
    if (!$user) {
      $this->alert('warning', trans('wishlistable::wishlistables.messages.unauthenticated'), [
        'position' => 'top-end',
        'iconColor' => setting("isite::brandPrimary", "#fff")
      ]);
    } else {

      //Search wishlist
      $wishlist = $this->wishlistService()->getWishlist($id);

      if (isset($wishlist->id)) {
        $wishlist->delete();

        $this->getWishlists();
        //Message
        $this->alert('success', trans('wishlistable::wishlistables.messages.wishlistDeleted'), config("asgard.isite.config.livewireAlerts"));
      }

    }
  }

  /*
  * ActionButton in Modal - OJO DUDA ACA CON EL DEFAULT
  */
  public function btnCreateWishlist()
  {

    dd("WISHLISTABLE - Otro");

    if (empty($this->wishlistTitle)) {

      $this->alert('warning', trans('wishlistable::wishlistables.messages.title empty'), [
        'position' => 'top-end',
        'iconColor' => setting("isite::brandPrimary", "#fff")
      ]);

    } else {

      //set data
      $user = \Auth::user();
      $data = [
        'title' => $this->wishlistTitle,
        'entityName' => "Modules\Icommerce\Entities\Product"
      ];

      //create
      $result = $this->wishlistService()->createWishlist($data, $user);

      //Refresh
      $this->wishlistTitle = "";
      $this->getWishlists();

      //Message
      $this->alert('success', trans('wishlistable::wishlistables.messages.listAdded'), config("asgard.isite.config.livewireAlerts"));
    }
  }

  /**
   * Wishlist ITEMS - GET
   */
  public function getWishlistItems()
  {

    $items = $this->wishlist->wishlistables()->get();
    $this->items = json_decode(json_encode(WishlistTransformer::collection($items)));

  }

  /**
   *  Wishlist ITEMS - DELETE
   */
  public function deleteItemFromWishlist($id)
  {

    $user = \Auth::user();//Get user
    //Validate session
    if (!$user) {
      $this->alert('warning', trans('wishlistable::wishlistables.messages.unauthenticated'), [
        'position' => 'top-end',
        'iconColor' => setting("isite::brandPrimary", "#fff")
      ]);
    } else {

      //Search wishlist
      $item = $this->wishlistService()->getItemFromWishlist($id);

      if (isset($item->id)) {
        $item->delete();

        $this->getWishlistItems();
        //Message
        $this->alert('success', trans('wishlistable::wishlistables.messages.wishlistDeleted'), config("asgard.isite.config.livewireAlerts"));
      }
    }
  }
}
