<?php

namespace MopManager;

use MopManager\ImplementationItem;

require_once("ImplementationItem.php");

class Implementations
{
  public $projectId;
  public $items = array();

  function __construct($projectId)
  {
    $this->projectId = $projectId;
    global $wpdb;

    $queryLoadImplementations = "SELECT * FROM wp_mop_implementation WHERE mop_project_idmop_project = $this->projectId;";
    $result = $wpdb->get_results($queryLoadImplementations);

    foreach ($result as &$implementation)
      array_push($this->items, new ImplementationItem($implementation->idmop_implementation, $implementation->title, $implementation->image));
  }
}