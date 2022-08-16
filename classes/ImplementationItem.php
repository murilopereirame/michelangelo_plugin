<?php

namespace MopManager;

class ImplementationItem
{
  public $idmop_implementation;
  public $title;
  public $image;

  function __construct($idmop_implementation, $title, $image)
  {
    $this->idmop_implementation = $idmop_implementation;
    $this->title = $title;
    $this->image = $image;
  }
}