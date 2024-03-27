<?php

namespace Modules\Wishlistable\Services;


class WishlistService
{
    
    private $wishlistRepository;
    private $wishlistableRepository;
  
    public function __construct()
    {
       $this->wishlistRepository = app('Modules\Wishlistable\Repositories\WishlistRepository');
       $this->wishlistableRepository = app('Modules\Wishlistable\Repositories\WishlistableRepository');
    }

    /**
     * Create Wishlist (General)
     */
    public function createWishlist($data,$user)
    {
        //Set Data
        $newListData = [
            'title' => isset($data['title']) ? $data['title'] : $this->getTitle($data["entityName"]),
            'user_id' => $user->id,
            'type' => $data["entityName"] ??  "Modules\Icommerce\Entities\Product"
        ];

        //Create new list
        $wishlist = $this->wishlistRepository->create($newListData);

        return $wishlist;
    }

    /**
     * Create or Update List with item (Case inside show product)
     */
    public function createOrUpdateList($data,$user)
    {

        //Only Create List | Case: Button Create in Index Wishlist
        if(isset($data['title'])){
            $list = $this->createWishlist($data,$user);
        }else{

            //Case: Wish List Modal (Add item to list)
            if(isset($data['wishlistId'])){
                $list  = $this->getWishlist($data['wishlistId']);
            }else{
                // Case: Button in product show
                $list = $this->getWishListUser($user->id);
            }
            
            //Create default List
            if(is_null($list)){
    
                $list = $this->createWishlist($data,$user);
    
                //Create item for the List
                $list->wishlistables()->create(
                    ['wishlist_id' => $list->id, 'wishlistable_type' => $data["entityName"], 'wishlistable_id' => $data["entityId"]]
                );
                
            }else{
               
                // Lists exists
                //Update or create only items
                $list->wishlistables()->updateOrCreate(
                    ['wishlist_id' => $list->id, 'wishlistable_type' => $data["entityName"], 'wishlistable_id' => $data["entityId"]]
                ); 
    
            }

        }

        return $list;
    }

    /**
    * Get user wishlist (Case Default)
    */
    public function getWishListUser($userId)
    {   
        
        $params = ['filter' => [
            'field' => 'user_id']
        ];
        $wishlist = $this->wishlistRepository->getItem($userId,json_decode(json_encode($params)));
        
        return $wishlist;
    }

    /**
     * Get title to the list by entity name
     */
    public function getTitle($entityName)
    {   

        switch ($entityName) {
            case 'Modules\Iad\Entities\Ad':
                $title = "wishlistable::wishlists.types.ad.title";
                break;
            
            default:
                $title = "wishlistable::wishlists.types.product.title";
                break;
        }

        return trans($title);
    }
    
    /**
     * Get Quantity from wishlistable to specific user (Case Default)
     */
    public function getQuantity($user)
    {
        $quantity = null;

        $list = $this->getWishListUser($user->id);

        if(!is_null($list))
            $quantity = $list->wishlistables()->get()->count();
        
        return $quantity;
    }

    /**
    * Get user lists (all)
    */
    public function getUserWishlists($userId)
    {   
        
        $params = ['filter' => [
            'user_id' => $userId]
        ];
        $wishlists = $this->wishlistRepository->getItemsBy(json_decode(json_encode($params)));
        
        return $wishlists;
    }

    /**
     * Get specific Wishlist
     */
    public function getWishlist($id)
    {    
        $wishlist = $this->wishlistRepository->getItem($id);
        return $wishlist;
    }
    
    /**
     * Get specific item from Wishlistable
     * @param $id (Wishlistable Id)
     */
    public function getItemFromWishlist($params)
    {    
        if(isset($params['wishlistableType'])){
            
            //Base
            $searchParams = ['filter' => $params];

            //Set Params
            $searchParams['filter']['field'] = "wishlistable_id";
            $criteria = $params['wishlistableId'];

            //Search
            $item = $this->wishlistableRepository->getItem($criteria,json_decode(json_encode($searchParams)));
            
        }else{
            $item = $this->wishlistableRepository->getItem($id); //wishlistable id
        }
        return $item;
    }

    /**
     * Get specific type from Wishlist
     */
    public function getType($entityName)
    {   
        $sepType = explode("\\",$entityName);
        $type = strtolower($sepType[3]);

        return $type;
    }

    

}