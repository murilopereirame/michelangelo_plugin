<?php

namespace MopManager;

use MopManager\BlueprintItem;

require_once("BlueprintItem.php");

class Blueprints
{
  public $projectId;
  public $items = array();

  function __construct($projectId)
  {
    $this->projectId = $projectId;
    global $wpdb;

    $queryLoadBlueprints = "SELECT * FROM wp_mop_blueprint WHERE mop_project_idmop_project = $this->projectId;";
    $result = $wpdb->get_results($queryLoadBlueprints);

    foreach ($result as &$blueprint)
      array_push($this->items, new BlueprintItem($blueprint->idmop_blueprint, $blueprint->title, $blueprint->image));
  }
}