<?php

namespace Modules\Wishlistable\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class Wishlist extends Component
{

  public $view;
  public $showButton;
  public $quantity;

  public $layout;
  public $type;
  public $item;// Case Product Show
  public $wishlists; // All Wishlists
  public $wishlistSelected; //Select
  public $wishlistTitle; //Input
  public $showInfor; // Show information when create in modal
 
  private $params;
  private $log = "Wishlistable: Livewire|Wishlist|";

  
  public function mount(Request $request, $showButton = false, $layout = "wishlist-layout-1", $item = null)
  {

    //\Log::info($this->log."Mount|");

    $this->layout = $layout;
    $this->view = "wishlistable::frontend.livewire.wishlist.layouts.".$this->layout.".index";
    $this->item = $item;

    $this->showButton = $showButton;
    $this->quantity = null;
    
    //Only for this case
    if($this->layout=="wishlist-layout-modal-list-1"){
      $this->wishlistSelected = null;
      $this->showInfor = false;
      $this->getWishlists();
    }
   
    $this->initQuantity();
  }

  /**
   * Set Listeners
   */
  protected function getListeners()
  {
    return [
      'addToWishList',
      'deleteFromWishlist',
      'initWishlistQuantity' => "initQuantity",
      'addToWishList_'.$this->id => "addToWishList" // Esto es para evitar que lo ejecute 2 veces cuando agrega desde la modal
    ];
    
  }

  /**
   * Wishlist ITEM - Quantity in Header component
   */
  public function initQuantity()
  {
    $user = \Auth::user();
    
    if(isset($user->id))
      $this->quantity = $this->wishlistService()->getQuantity($user);
  }
  
  /**
   * @return wishlistService
   */
  public function wishlistService()
  {
    return app('Modules\Wishlistable\Services\WishlistService');
  }

  /**
   * Render wishlist
   */
  public function render()
  {
    return view($this->view);
  }

  /**
  * Wishlist - GET Wishlists from user logged
  */
  public function getWishlists()
  {
    $this->wishlists = null;

    $user = \Auth::user();//Get user

    if(!is_null($user)){
      $wishlists = $this->wishlistService()->getUserWishlists($user->id);
      
      if(!is_null($wishlists)){
        $this->wishlists = $wishlists;
      }
    }

  }

  /**
   * Create Wishlist and Wishlistable | Case: Inside product show (Default)
   * Create Only Wishlist | Case: Modal Wishlist Index
   * Create Wishlistable | Case: Modal Wishlist in product show
   * Create Wishlist | Case: Modal Wishlist in product show
   */
  public function addToWishList($data = null)
  {
    //\Log::info($this->log."addToWishList");
    $message = "wishlistable::wishlistables.messages.itemAdded";
    
    $user = \Auth::user();//Get user
    //Validate session
    if (!$user) {
      $this->alert('warning', trans('wishlistable::wishlistables.messages.unauthenticated'), [
        'position' => 'top-end',
        'iconColor' => setting("isite::brandPrimary", "#fff")
      ]);
    } else {

      //Validation when data come from Modal List 
      $continue = true;
      if($data=="createFromModalList"){
        
        if(empty($this->wishlistTitle)){
         
          $this->alert('warning', trans('wishlistable::wishlistables.messages.title empty'), [
            'position' => 'top-end',
            'iconColor' => setting("isite::brandPrimary", "#fff")
          ]);
          $continue = false;

        }else{ 
            //Checkpoint
            $fromModalList = true;
            //Clean data
            $data= null;
            //Set title
            $data['title'] = $this->wishlistTitle;
        }
        
      }
      
      //Continue normal process
      if($continue){

        //Create or update list
        $result = $this->wishlistService()->createOrUpdateList($data,$user);

        //Case: Modal Wishlist Index | After Create List
        if(isset($data['title']) && !isset($fromModalList)){
          //Update the Isite ItemList
          $message = "wishlistable::wishlistables.messages.listAdded";
          $this->emit("itemsListGetData",['onlyResetList' => true]);
        }else{
          $this->initQuantity();
        }

        //Case: Modal Wishlist in product show | After Create List
        if(isset($fromModalList)){
          $message = "wishlistable::wishlistables.messages.listAdded";
          $this->getWishlists();
          $this->wishlistSelected = $result->id;
          $this->showInforToCreate(); //Hide the infor
          $this->wishlistTitle = "";
        }
          

        //Case: Modal Wishlist in product show | After Add item to Wishlist selected
        if(isset($data['closeModal'])){
          $this->dispatchBrowserEvent('wishlist-close-modal');
        }

    
        //Message
        $this->alert('success', trans($message), config("asgard.isite.config.livewireAlerts"));

      }

    }
    
  }

  /*
  * Action Button | SAVE in Modal | Add Item to Wishlist
  */
  public function btnAddItemToWishlist($itemId)
  {

    //\Log::info($this->log."btnAddItemToWishlist");

    //Validation List Selected
    if(empty($this->wishlistSelected) || $this->wishlistSelected=="0"){

      $this->alert('warning', trans('wishlistable::wishlistables.messages.listEmpty'), [
        'position' => 'top-end',
        'iconColor' => setting("isite::brandPrimary", "#fff")
      ]);

    }else{
      
      //Set Data to item for this wishlist
      $data["wishlistId"] = $this->wishlistSelected;
      $data['entityId'] = $itemId;
      $data['entityName'] = "Modules\Icommerce\Entities\Product";

      //Extra event
      $data['closeModal'] = true;

      //Call Process
      $this->addToWishList($data);
      
      //Message
      $this->alert('success', trans('wishlistable::wishlistables.messages.itemAdded'), config("asgard.isite.config.livewireAlerts"));

    }
   
  }

  /**
   *  Wishlist - DELETE ITEM
   * @param $id (wishlistable Id or Entity Id)
   */
  public function deleteFromWishlist($id,$entityType=null,$params = null)
  {

    //\Log::info($this->log."deleteFromWishlist");
    $user = \Auth::user();//Get user
    //Validate session
    if (!$user) {
      $this->alert('warning', trans('wishlistable::wishlistables.messages.unauthenticated'), [
        'position' => 'top-end',
        'iconColor' => setting("isite::brandPrimary", "#fff")
      ]);
    } else {
      
      //Extra params (Case: Delete from other List Item - Products)
      if(!is_null($params)){
        $paramsToQuery['wishlistableId'] = $id;
        $paramsToQuery['wishlistableType'] = $entityType;
        $paramsToQuery['wishlistId'] = (int)$params['wishlistId'];
      }else{
        // Case - Wishlistable Id
        $paramsToQuery['id'] = $id;
      }

      //Search wishlistable
      $item = $this->wishlistService()->getItemFromWishlist($paramsToQuery);

      if(isset($item->id)){
        $item->delete();
        
        //Update the Isite - ItemList
        $this->emit("itemsListGetData",['onlyResetList' => true]);

        //Message
        $this->alert('success', trans('wishlistable::wishlistables.messages.itemDeleted'), config("asgard.isite.config.livewireAlerts"));
      }
 
    }

  }

  /**
   * Action Button - Create New list in Modal
   */
  public function showInforToCreate()
  {
      $this->showInfor  = !$this->showInfor;
  }
  
}
