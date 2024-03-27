<?php

return [

  'items-per-page' => [
    'name' => 'wishlistable::items-per-page',
    'value' => 12,
    'groupName' => 'indexPage',
    'groupTitle' => 'wishlistable::common.wishlist.index',
    "onlySuperAdmin" => true,
    'type' => 'input',
    'columns' => 'col-12 col-md-6',
    'props' => [
      'label' => 'wishlistable::common.settings.item-per-page'
    ],
  ],
 
];