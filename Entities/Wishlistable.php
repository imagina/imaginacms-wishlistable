<?php

namespace Modules\Wishlistable\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Wishlistable extends CrudModel
{
  use Translatable;

  protected $table = 'wishlistable__wishlistables';
  public $transformer = 'Modules\Wishlistable\Transformers\WishlistableTransformer';
  public $repository = 'Modules\Wishlistable\Repositories\WishlistableRepository';
  public $requestValidation = [
      'create' => 'Modules\Wishlistable\Http\Requests\CreateWishlistableRequest',
      'update' => 'Modules\Wishlistable\Http\Requests\UpdateWishlistableRequest',
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
  public $translatedAttributes = [];
  protected $fillable = [
    'wishlist_id',
    'wishlistable_type',
    'wishlistable_id'
  ];

  protected $casts = [
    'options' => 'array'
  ];

  public function wishlist()
  {
    return $this->belongsTo(Wishlist::class);
  }
  
}
