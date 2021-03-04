<?php

namespace Modules\Wishlistable\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Ihelpers\Traits\Transformeable;

class WishlistTransformer extends JsonResource
{
  use Transformeable;
  
  public function toArray($request)
  {
  
    $entity = $this->wishlistable_type::find($this->wishlistable_id);
    $entityClass = get_class($entity);
    $entityName = explode("\\",$entityClass)[3];
    $entityConfig = config("asgard.wishlistable.config.transformeable.wishlistable.".strtolower($entityName));
    
    $item =  [
      'id' => $this->when($this->id,$this->id),
      'userId' => $this->when($this->user_id,$this->user_id),
      'wishlistableType' => $this->when($this->wishlistable_type,$this->wishlistable_type),
      'wishlistableId' => $this->when($this->wishlistable_id,$this->wishlistable_id),
      'createdAt' => $this->when($this->created_at,$this->created_at),
      'updatedAt' => $this->when($this->updated_at,$this->updated_at)
    ];
    
    if($entityClass == $entityConfig["entity"]){
      $item["entity"] = new $entityConfig["path"]($entity);
      if(isset($entity->url))
      $item["url"] = $entity->url;
    }
  
    $this->customIncludes($item);
    
    return $item;

  }
}