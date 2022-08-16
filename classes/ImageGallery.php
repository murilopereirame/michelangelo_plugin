<?php

namespace MopManager;

use MopManager\Image;

require_once("Image.php");

class ImageGallery
{
  public $projectId;
  public $items = array();

  function __construct($projectId)
  {
    $this->projectId = $projectId;
    global $wpdb;

    $queryLoadImages = "SELECT * FROM wp_mop_image WHERE mop_project_idmop_project = $this->projectId;";
    $result = $wpdb->get_results($queryLoadImages);

    foreach ($result as &$image)
      array_push($this->items, new Image($image->idmop_image, $image->title, $image->image));
  }
}