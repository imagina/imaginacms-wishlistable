<?php

return [
    'name' => 'Wishlistable',
  
  
  /*
 |--------------------------------------------------------------------------
 | Transformeable config
 | (if they are empty icommerce module will be using default includes) (slim)
 |--------------------------------------------------------------------------
 */
  'transformeable' => [
    'wishlistable' => [
      'product' => [
        'path' => 'Modules\Icommerce\Transformers\ProductTransformer', //this is the transformer path
        'multiple' => false, //if is one-to-many, multiple must be set to true
        'entity' => 'Modules\Icommerce\Entities\Product'
      ],
      'ad' => [
        'path' => 'Modules\Iad\Transformers\AdTransformer', //this is the transformer path
        'multiple' => false, //if is one-to-many, multiple must be set to true
        'entity' => 'Modules\Iad\Entities\Ad'
      ],
    ]
  ],
  
  /*
|--------------------------------------------------------------------------
| Define the options to the user menu component
|
| @note routeName param must be set without locale. Ex: (icommerce orders: 'icommerce.store.order.index')
| use **onlyShowInTheDropdownHeader** (boolean) if you want the link only appear in the dropdown in the header
| use **onlyShowInTheMenuOfTheIndexProfilePage** (boolean) if you want the link only appear in the dropdown in the header
| use **showInMenuWithoutSession** (boolean) if you want the link only appear in the dropdown when don't exist session
| use **dispatchModal** (string - modalAlias) if you want the link only appear in the dropdown when don't exist session
| use **url** (string) if you want customize the link
|--------------------------------------------------------------------------
*/
  "userMenuLinks" => [
  
    [
      "title" => "wishlistable::wishlistables.title.myWishlist",
      "routeName" => "wishlistable.wishlist.index",
      "icon" => "fa fa-heart",
    ]
  ],

  /*
 |--------------------------------------------------------------------------
 | Define config to the orderBy in the index page
 |--------------------------------------------------------------------------
 */
  'orderBy' => [
    'default' => 'recently',
    'options' => [
      'nameaz' => [
        'title' => 'icommerce::common.sort.name_a_z',
        'name' => 'nameaz',
        'order' => [
          'field' => "name",
          'way' => "asc",
        ]
      ],
      'nameza' => [
        'title' => 'icommerce::common.sort.name_z_a',
        'name' => 'nameza',
        'order' => [
          'field' => "name",
          'way' => "desc",
        ]
      ],
      'lowerprice' => [
        'title' => 'icommerce::common.sort.price_low_high',
        'name' => 'lowerprice',
        'order' => [
          'field' => "price",
          'way' => "asc",
        ]
      ],
      'higherprice' => [
        'title' => 'icommerce::common.sort.price_high_low',
        'name' => 'higherprice',
        'order' => [
          'field' => "price",
          'way' => "desc",
        ]
      ],
      'recently' => [
        'title' => 'icommerce::common.sort.recently',
        'name' => 'recently',
        'order' => [
          'field' => "created_at",
          'way' => "desc",
        ]
      ]
    ],
  ],

   /*
  |--------------------------------------------------------------------------
  | Layout Products - Index
  |--------------------------------------------------------------------------
  */
  'layoutIndex' => [
    'default' => 'one',
    'options' => [
      'four' => [
        'name' => 'four',
        'class' => 'col-6 col-md-4 col-lg-3',
        'icon' => 'fa fa-th-large',
        'status' => true
      ],
      'three' => [
        'name' => 'three',
        'class' => 'col-6 col-md-4 col-lg-4',
        'icon' => 'fa fa-square-o',
        'status' => true
      ],
      'one' => [
        'name' => 'one',
        'class' => 'col-12',
        'icon' => 'fa fa-align-justify',
        'status' => true
      ],
    ]
  ],

   /*
  |--------------------------------------------------------------------------
  | Layout Products - Index List - Show
  |--------------------------------------------------------------------------
  */
  'layoutShow' => [
    'default' => 'four',
    'options' => [
        'four' => [
            'name' => 'four',
            'class' => 'col-6 col-md-4 col-lg-3',
            'icon' => 'fa fa-th-large',
            'status' => true
        ],
        'three' => [
            'name' => 'three',
            'class' => 'col-6 col-md-4 col-lg-4',
            'icon' => 'fa fa-square-o',
            'status' => true
        ],
        'one' => [
            'name' => 'one',
            'class' => 'col-12',
            'icon' => 'fa fa-align-justify',
            'status' => true
        ],
    ]
  ],

  /*
  |--------------------------------------------------------------------------
  | Pagination to the index page
  |--------------------------------------------------------------------------
  */
  'pagination' => [
    "show" => true,
    /*
  * Types of pagination:
  *  normal
  *  loadMore
  *  infiniteScroll
  */
    "type" => "normal"
  ],

  
];
