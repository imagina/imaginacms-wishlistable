<?php

namespace Modules\Wishlistable\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Wishlistable\Entities\Wishlist;
use Modules\Wishlistable\Repositories\WishlistRepository;

class WishlistApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Wishlist $model, WishlistRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
  
}
