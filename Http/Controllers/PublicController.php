<?php

namespace Modules\Wishlistable\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Mockery\CountValidator\Exception;
use Modules\Core\Http\Controllers\BasePublicController;
use Route;
use Modules\Ihelpers\Http\Controllers\Api\BaseApiController;

class PublicController extends BaseApiController
{
  protected $auth;

  
  public function __construct(

  )
  {
    parent::__construct();

  }

  // view products by category
  public function index(Request $request)
  {
    
    $tpl = 'wishlistable::frontend.wishlist.index';
  

    return view($tpl);
  }
  
}
