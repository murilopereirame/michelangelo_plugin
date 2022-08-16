<?php

namespace MopManager;

class Image
{
  public $idmop_image;
  public $title;
  public $image;

  function __construct($idmop_image, $title, $image)
  {
    $this->idmop_image = $idmop_image;
    $this->title = $title;
    $this->image = $image;
  }
}