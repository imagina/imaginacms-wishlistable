<?php

namespace Modules\Wishlistable\Entities;

use Illuminate\Database\Eloquent\Model;

class WishlistableTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'wishlistable__wishlistable_translations';
}
