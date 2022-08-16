<?php

namespace MopManager;

use MopManager\CRMConvertionItem;

require_once("CRMConvertionItem.php");

class CRMConvertion
{
  public $projectId;
  public $items = array();

  function __construct($projectId)
  {
    $this->projectId = $projectId;
    global $wpdb;

    $queryLoadConvertion = "SELECT * FROM wp_mop_crm_from_to WHERE mop_project_idmop_project = $this->projectId;";
    $result = $wpdb->get_results($queryLoadConvertion);

    foreach ($result as &$crm_convertion)
      array_push($this->items, new CRMConvertionItem($crm_convertion->idmop_crm_from_to, $crm_convertion->from_field, $crm_convertion->to_field));
  }

  function getConvertion($from)
  {
    $itemIndex = array_search($from, array_column($this->items, 'from'));
    return $this->items[$itemIndex];
  }
}