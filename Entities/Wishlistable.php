<?php

namespace Modules\Wishlistable\Entities;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Wishlistable extends Model
{

    public $translatedAttributes = [];
    protected $fillable = [];
}
