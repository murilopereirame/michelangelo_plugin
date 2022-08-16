<?php

namespace MopManager;

class BlueprintItem
{
  public $idmop_blueprint;
  public $title;
  public $image;

  function __construct($idmop_blueprint, $title, $image)
  {
    $this->idmop_blueprint = $idmop_blueprint;
    $this->title = $title;
    $this->image = $image;
  }
}