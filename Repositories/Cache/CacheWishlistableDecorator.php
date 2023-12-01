<?php

namespace Modules\Wishlistable\Repositories\Cache;

use Modules\Wishlistable\Repositories\WishlistableRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheWishlistableDecorator extends BaseCacheCrudDecorator implements WishlistableRepository
{
    public function __construct(WishlistableRepository $wishlistable)
    {
        parent::__construct();
        $this->entityName = 'wishlistable.wishlistables';
        $this->repository = $wishlistable;
    }
}
