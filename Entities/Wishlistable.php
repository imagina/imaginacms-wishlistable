<?php

namespace Modules\Wishlistable\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Wishlistable extends Model
{
    use Translatable;

    protected $table = 'wishlistable__wishlistables';
    public $translatedAttributes = [];
    protected $fillable = [];
}
