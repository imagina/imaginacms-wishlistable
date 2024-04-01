<?php

namespace Modules\Wishlistable\Entities;

use Modules\Core\Icrud\Entities\CrudModel;

class Wishlist extends CrudModel
{

  
  protected $forceDeleting = true; //DELETE ALL FROM DB

  protected $table = 'wishlistable__wishlists';
  public $transformer = 'Modules\Wishlistable\Transformers\WishlistTransformer';
  public $repository = 'Modules\Wishlistable\Repositories\WishlistRepository';
  public $requestValidation = [
      'create' => 'Modules\Wishlistable\Http\Requests\CreateWishlistRequest',
      'update' => 'Modules\Wishlistable\Http\Requests\UpdateWishlistRequest',
    ];
  //Instance external/internal events to dispatch with extraData
  public $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [],
    'creating' => [],
    'updated' => [],
    'updating' => [],
    'deleting' => [],
    'deleted' => []
  ];
  protected $fillable = [
    'title',
    'user_id',
    'type'
  ];

  public function user()
  {
    $driver = config('asgard.user.config.driver');
    return $this->belongsTo("Modules\\User\\Entities\\{$driver}\\User", 'customer_id');
  }

  public function wishlistables()
  {
    return $this->hasMany(Wishlistable::class);
  }

  public function getUrlAttribute($locale = null)
  { 
    $url = "";
    $currentLocale = $locale ?? locale();

    $url = route($currentLocale.'.wishlistable.wishlist.indexList',['listId' => $this->id]);

    return $url;
  }

}
