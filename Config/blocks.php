<?php

$vAttributes = include(base_path() . '/Modules/Isite/Config/standardValuesForBlocksAttributes.php');

return [
  "wishlist" => [
    "title" => "Lista de Deseos",
    "systemName" => "wishlistable::wishlist",
    "nameSpace" => "livewire",
    "contentFields" => [
      "label" => [
          "name" => "label",
          "type" => "input",
          "columns" => "col-12",
          "isTranslatable" => true,
          "props" => [
              "label" => "Texto de la lista de deseos"
          ]
      ],
    ],
    "attributes" => [
        "general" => [
            "title" => "General",
            "fields" => [
                "showButton" => [
                    "name" => "showButton",
                    "value" => "1",
                    "type" => "select",
                    "props" => [
                        "label" => "showButton",
                        "options" => $vAttributes["validation"]
                    ]
                ],
                "icon" => [
                    "name" => "icon",
                    "value" => "fa fa-heart",
                    "type" => "input",
                    "props" => [
                        "label" => "Icono",
                    ]
                ],
                "classWishlists" => [
                    "name" => "classWishlists",
                    "value" => "mx-1",
                    "columns" => "col-12",
                    "type" => "input",
                    "props" => [
                        "label" => "Clases",
                    ]
                ],
                "styleWishlists" => [
                    "name" => "styleWishlists",
                    "type" => "input",
                    "columns" => "col-12",
                    "props" => [
                        "label" => "Estilos",
                        'type' => 'textarea',
                        'rows' => 5,
                    ],
                ],
            ]
        ],
    ]
  ],
];
