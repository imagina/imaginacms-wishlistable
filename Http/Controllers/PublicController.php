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
    $tpl = 'wishlistable::frontend.wishlist.index-list.default.index';//In Module
    $ttpl = 'wishlist.index-list.default.index';//in Theme

    //Validation View
    if (view()->exists($ttpl)) $tpl = $ttpl;

    if(!is_null($wishlist)){

      if($user->id!=$wishlist->user_id) throw new \Exception('Wishlist not found for this user', 404);
        
      $type = $this->wishlistableService->getType($wishlist->type);

      //specific tpl (Item list default is with 'product information' but others may need to be customized later depnds of wishlist type)
      $tplList = 'wishlistable::frontend.wishlist.index-list.'.$type.'.index';

      //Validation View
      if (view()->exists($tplList)) $tpl = $tplList;

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
