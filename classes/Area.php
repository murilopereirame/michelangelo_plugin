<?php

namespace MopManager;

use MopManager\AreaItem;

require_once("AreaItem.php");

class Area
{
  public $idmop_differential;
  public $title;
  public $mop_project_idmop_project;
  public $items = array();

  function __construct($idmop_differential)
  {
    $this->idmop_differential = $idmop_differential;
    global $wpdb;

    $queryLoadArea = "SELECT * FROM wp_mop_differential WHERE idmop_differential = $this->idmop_differential;";
    $result = $wpdb->get_results($queryLoadArea);

    foreach ($result[0] as $key => $value) {
      $this->{$key} = $value;
    }

    $queryLoadItems = "SELECT * FROM wp_mop_area_item WHERE mop_differential_idmop_differential = $this->idmop_differential;";
    $result = $wpdb->get_results($queryLoadItems);

    foreach ($result as &$area)
      array_push($this->items, new AreaItem($area->idmop_area_item, $area->image, $area->title));
  }
}