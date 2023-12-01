<?php

namespace Modules\Wishlistable\Transformers;

use Modules\Core\Icrud\Transformers\CrudResource;

class WishlistableTransformer extends CrudResource
{
  /**
  * Method to merge values with response
  *
  * @return array
  */
  public function modelAttributes($request)
  {
    return [];
  }
}
