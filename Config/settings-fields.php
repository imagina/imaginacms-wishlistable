<?php

return [

  'wishlistActive' => [
    'name' => 'wishlistable::wishlistActive',
    'value' => "0",
    'groupName' => 'indexPage',
    'groupTitle' => 'wishlistable::common.wishlist.index',
    "onlySuperAdmin" => true,
    'type' => 'checkbox',
    'columns' => 'col-12 col-md-6',
    'props' => [
      'trueValue' => "1",
      'falseValue' => "0",
      'label' => 'wishlistable::common.settings.wishlistActive'
    ],
  ],
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