<?php

namespace MopManager;

use MopManager\Area;

require_once("Area.php");

class Differentials
{
  public $projectId;
  public $items = array();

  function __construct($projectId)
  {
    $this->projectId = $projectId;
    global $wpdb;

    $queryLoadAreas = "SELECT idmop_differential FROM wp_mop_differential WHERE mop_project_idmop_project = $this->projectId;";
    $result = $wpdb->get_results($queryLoadAreas);

    foreach ($result as &$area)
      array_push($this->items, new Area($area->idmop_differential));
  }
}