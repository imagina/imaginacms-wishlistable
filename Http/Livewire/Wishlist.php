<?php

namespace Modules\Wishlistable\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class Wishlist extends Component
{

 
  public $moduleView;
  public $showButton;

  private $params;
  protected $listeners = ['addToWishList'];

  public function mount(Request $request, $showButton = false)
  {
    $this->moduleView = 'wishlistable::frontend.livewire.wishlist';
    $this->showButton = $showButton;
  }

  /**
   * @return wislistRepository
   */
  public function wishlistRepository()
  {
    return app('Modules\Wishlistable\Repositories\WishlistableRepository');
  }

  /**
   * @return wishListEntity
   */
  public function wishlistEntity()
  {
    return app('Modules\Wishlistable\Entities\Wishlistable');
  }

  /**
   * Render wishlist
   */
  public function render()
  {
    
    return view($this->moduleView);

  }

  /**
   *  Add product to wishlist
   */
  public function addToWishList($data)
  {
    $user = \Auth::user();//Get user
    //Validate session
    if (!$user) {
      $this->alert('warning', trans('wishlistable::wishlistable.messages.unauthenticated'), [
        'position' => 'top-end',
        'iconColor' => setting("isite::brandPrimary", "#fff")
      ]);
    } else {
      //Create or update product
      $this->wishlistEntity()->updateOrCreate(
        ['user_id' => $user->id, 'wishlistable_type' => $data["entityName"], 'wishlistable_id' => $data["entityId"]]
      );

      //Message
      $this->alert('success', trans('wishlistable::wishlistable.messages.productAdded'), config("asgard.isite.config.livewireAlerts"));
    }
  }

  /**
   * Get user wishlist
   */
  public function getWishListUser($userId)
  {
    $params = json_decode(json_encode([
      "filter" => [
        'user' => $userId
      ]
    ]));
    $wishlist = $this->wishlistRepository()->getItemsBy($params);

    return $wishlist;
  }
}
