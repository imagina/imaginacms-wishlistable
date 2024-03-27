<?php

namespace Modules\Wishlistable\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Wishlistable\Entities\Wishlistable;
use Modules\Wishlistable\Repositories\WishlistableRepository;

class WishlistableApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Wishlistable $model, WishlistableRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
