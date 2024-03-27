<?php

namespace Modules\Wishlistable\Repositories\Cache;

use Modules\Wishlistable\Repositories\WishlistRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheWishlistDecorator extends BaseCacheCrudDecorator implements WishlistRepository
{
    public function __construct(WishlistRepository $wishlist)
    {
        parent::__construct();
        $this->entityName = 'wishlistable.wishlists';
        $this->repository = $wishlist;
    }
}
