<?php

namespace Modules\Wishlistable\View\Components;

use Illuminate\View\Component;

class Item extends Component
{

  public $item;
  public $view;

  /**
   * Create a new component instance.
   */
  public function __construct($item, $layout = "item-layout-1")
  {

    $this->item = $item;
    $this->view = "wishlistable::frontend.components.item.layouts.$layout.index";

  }

  /**
   * Get the view
   */
  public function render()
  {
    return view($this->view);
  }

}