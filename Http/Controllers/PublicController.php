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
  private $wishlistableService ;

  public function __construct()
  {
    parent::__construct();
    $this->wishlistableService = app('Modules\Wishlistable\Services\WishlistService');
  }

  /**
   * Index - ALL Wishlists
   */
  public function index(Request $request)
  {
    //Validate sessión
    $user = \Auth::user();
    if (!$user) return redirect("/ipanel/#/auth/login" . "?redirectTo=" . $request->fullUrl());

    $tpl = 'wishlistable::frontend.wishlist.index';
    $ttpl = 'wishlist.index';
    
    //Validation View
    if (view()->exists($ttpl)) $tpl = $ttpl;

    //Validation with lang from URL
    $result = validateLocaleFromUrl($request,[
      'fixedTrans'=>'wishlistable::routes.wishlist.index'
    ]);
    if(isset($result["reedirect"]))
      return redirect()->to($result["url"]);

    //get Wishlists for the user
    $wishlists = null;
    $wishlists = $this->wishlistableService->getUserWishlists($user->id);

    //Return view
    return view($tpl,compact('user','wishlists'));
    
  }

  /**
   * Index List - All Items from Wishlist
   */
  public function indexList(Request $request, $listId)
  {
    //Validate sessión
    $user = \Auth::user();
    if (!$user) return redirect("/ipanel/#/auth/login" . "?redirectTo=" . $request->fullUrl());

    //get infor wishlist
    $wishlist = $this->wishlistableService->getWishlist($listId);

    //default tpl (Default es la de product)
    $tpl = 'wishlistable::frontend.wishlist.index-list.default.index';

    if(!is_null($wishlist)){

      $type = $this->wishlistableService->getType($wishlist->type);

      //specific tpl
      $tplList = 'wishlistable::frontend.wishlist.index-list.'.$type.'.index';

      //Get Ids From Items
      //$itemIds = null;
      //$items = $wishlist->wishlistables()->get();

      /*
      if(count($items)>0)
        $itemIds = $items->pluck('wishlistable_id');
      */

      //Validation View
      if (view()->exists($tplList)) $tpl = $ttpl;

      //Data to view
      $data = [
        "title" => trans("wishlistable::wishlists.list.title").": ".$wishlist->title,
        //"itemIds" => $itemIds,
        "wishlistId" => $listId
      ];

    }else{
      //Extra validation
      return redirect()->back();
    }

    return view($tpl,compact('data'));

  }

}
