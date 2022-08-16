<?php

namespace MopManager;

use Architect;

require_once("Architect.php");

class ArchitectGallery
{
  public $projectId;
  public $items = array();

  function __construct($projectId)
  {
    $this->projectId = $projectId;
    global $wpdb;

    $queryLoadArchitects = "SELECT * FROM wp_mop_architect WHERE mop_project_idmop_project = $this->projectId;";
    $result = $wpdb->get_results($queryLoadArchitects);

    foreach ($result as &$architect)
      array_push($this->items, new Architect($architect->idmop_architect, $architect->title, $architect->body, $architect->image));
  }
}