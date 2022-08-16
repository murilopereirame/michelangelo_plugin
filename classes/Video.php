<?php

namespace MopManager;

class Video
{
  public $idmop_video;
  public $preview;
  public $link;

  function __construct($idmop_video, $preview, $link)
  {
    $this->idmop_video = $idmop_video;
    $this->preview = $preview;
    $this->link = $link;
  }
}