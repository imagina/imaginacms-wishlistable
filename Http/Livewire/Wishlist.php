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
  public $layoutButton;
  public $type;
  public $item;// Case Product Show
  public $wishlists; // All Wishlists
  public $wishlistSelected; //Select
  public $wishlistTitle; //Input
  public $showInfor; // Show information when create in modal
  public $user;
  public $label;
  public $icon;
  public $classWishlists;
  public $styleWishlists;
  public $loading = true; //Default true para que muestre la infor despues del initProcess
 
  private $params;
  private $log = "Wishlistable: Livewire|Wishlist|";

  public function mount(Request $request, $showButton = false, $layout = "wishlist-layout-1",
                        $item = null, $label = '', $classWishlists = 'mx-1', $styleWishlists = '',
                        $icon = 'fa fa-heart', $layoutButton = "icon"
  )
  {

    $this->layout = $layout;
    $this->layoutButton = "wishlistable::frontend.livewire.wishlist.layouts.".$this->layout.".buttons.".$layoutButton;
    $this->view = "wishlistable::frontend.livewire.wishlist.layouts.".$this->layout.".index";
    $this->item = $item;

    $this->showButton = $showButton;
    $this->quantity = null;
    $this->label = $label;
    $this->icon = $icon;
    $this->classWishlists = $classWishlists;
    $this->styleWishlists = $styleWishlists;

    //Layout del Header
    if($showButton) $this->initQuantity();

  }

  /**
   * Set Listeners
   */
  protected function getListeners()
  {
    
    //Base Listeners
    $base = [
      'deleteFromWishlist' => "deleteFromWishlist",
      'initWishlistQuantity' => "initQuantity",
      'addToWishList' => "addToWishList",
      'addToWishList_'.$this->id => "addToWishList", //Esto es para evitar que lo ejecute 2 veces cuando agrega desde la modal
      'initProcess' => "initProcess"
    ];

    return $base;
    
  }

  /**
   * INIT METHOD
   * Onclick | Partials Buttons
   * wishlist-layout-modal-1 | Wishlist Modal Basic (Create List)
   */
  public function initProcess($data = null)
  { 
    //\Log::info($this->log."initProcess|");

    $this->loading = true;

    $this->checkUserLogged();

    if(isset($data['from']) && $data['from']=='createFromModalList'){

      //El item que llega sea diferente al que ya eligió
      if(!is_null($this->item) && $this->item->id!=$data['entityId']) $this->item = null;

      //Validation to repeat
      if(is_null($this->item)){
        $this->wishlistSelected = null;
        $this->showInfor = false;
        
        //Obtener la data del Item necesaria para la informacion en la Modal
        $itemRepository = $this->getItemRepository($data['entityName']);
        $this->item = $itemRepository->getItem($data['entityId']);

      }

      //Case Cache
      $this->getWishlists();

    }

    $this->loading = false;

  }

  /**
   * Wishlist ITEM - Quantity in Header component
   */
  public function initQuantity()
  {
    
    $this->checkUserLogged();

    if(isset($this->user->id))
      $this->quantity = $this->wishlistService()->getQuantity($this->user);
    
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
    //\Log::info($this->log."getWishlists|");
    $this->wishlists = null;

    if(!is_null($this->user)){
      $wishlists = $this->wishlistService()->getUserWishlists($this->user->id);
      
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

    //\Log::info($this->log."addToWishList|Layout: ".$this->layout);
    //\Log::info($this->log."addToWishList|Data: ".json_encode($data));
 
    $this->checkUserLogged();

    //Default message
    $message = "wishlistable::wishlistables.messages.itemAdded";
    
    //Validate session
    if (!$this->user) {
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
        $result = $this->wishlistService()->createOrUpdateList($data,$this->user);

        //Case: Modal Wishlist Index | After Create List
        if(isset($data['title']) && !isset($fromModalList)){
          //Set message
          $message = "wishlistable::wishlistables.messages.listAdded";
          //Update the Isite ItemList
          $this->emit("itemsListGetData",['onlyResetList' => true]);

        }else{
          $this->initQuantity();
        }

        //Case: Modal Wishlist in product show or other | After Create List
        if(isset($fromModalList)){
          $message = "wishlistable::wishlistables.messages.listAdded";
          
          $this->getWishlists();

          //Esto se omitió porque actualizaba todo
          //$this->emit("updateWishLists");
          
          $this->wishlistSelected = $result->id;
          $this->showInforToCreate(); //Hide the infor
          $this->wishlistTitle = "";
        }
          

        //Case: Modal Wishlist in product show | After Add item to Wishlist selected
        if(isset($data['closeModal'])){
          $this->dispatchBrowserEvent('wishlist-close-modal',["entityId" => $data['entityId']]);
        }

        //Case: Button add wishlist in product show (next to add cart button)
        if(isset($data['fromBtnAddWishlist'])){
            $this->getWishlists();
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

  private function wislistableRepository()
  {
    return app('Modules\Wishlistable\Repositories\WishlistableRepository');
  }

  /**
   *  Wishlist - DELETE ITEM
   * @param $id (wishlistable Id or Entity Id)
   */
  public function deleteFromWishlist($id,$entityType=null,$params = null)
  {

    //\Log::info($this->log."deleteFromWishlist");
    $user = \Auth::user() ?? null;

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
        //\Log::info($this->log."deleteFromWishlist|WishlistableId: ".$item->id);
        //$item->delete();
        //app('Modules\Wishlistable\Repositories\WishlistableRepository')->deleteBy($item->id);
        $this->wislistableRepository()->deleteBy($item->id);

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

  /**
   * Como ya no se inicializa el usuario en el Init, toca verificarlo directamente | Case: Cache
   */
  public function checkUserLogged()
  {
     
    if(is_null($this->user)){
      $this->user = \Auth::user() ?? null;
    }

  }

  /**
   * Get repository from item
   */
  public function getItemRepository($itemClass)
  {
    switch ($itemClass) {
      case 'Modules\Icommerce\Entities\Product':
        return app('Modules\Icommerce\Repositories\ProductRepository');
        break;
      
      default:
        return app('Modules\Icommerce\Repositories\ProductRepository');
        break;
    }
  }

  
}
