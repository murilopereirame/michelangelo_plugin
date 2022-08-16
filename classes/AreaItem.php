<?php

namespace MopManager;

class AreaItem
{
  public $idmop_area_item;
  public $image;
  public $title;

  function __construct($idmop_area_item, $image, $title)
  {
    $this->idmop_area_item = $idmop_area_item;
    $this->image = $image;
    $this->title = $title;
  }
}
