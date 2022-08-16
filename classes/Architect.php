<?php

class Architect
{
  public $idmop_architect;
  public $title;
  public $body;
  public $image;

  function __construct($idmop_architect, $title, $body, $image)
  {
    $this->idmop_architect = $idmop_architect;
    $this->title = $title;
    $this->body = $body;
    $this->image = $image;
  }
}