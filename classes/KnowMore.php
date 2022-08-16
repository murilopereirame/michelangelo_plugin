<?php

namespace MopManager;

class KnowMore
{
  public $idmop_more;
  public $title;
  public $body;
  public $button;
  public $link;
  public $position;
  public $mop_project_idmop_project;

  function __construct($idmop_more, $title, $body, $button, $link, $position, $mop_project_idmop_project)
  {
    $this->idmop_more = $idmop_more;
    $this->title = $title;
    $this->body = $body;
    $this->button = $button;
    $this->link = $link;
    $this->position = $position;
    $this->mop_project_idmop_project = $mop_project_idmop_project;
  }
}
