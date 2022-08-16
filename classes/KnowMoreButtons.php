<?php

namespace MopManager;

use MopManager\KnowMore;

require_once("KnowMore.php");

class KnowMoreButtons
{
  public $projectId;
  public $items = array();

  function __construct($projectId)
  {
    $this->projectId = $projectId;
    global $wpdb;

    $queryLoadKnowMore = "SELECT * FROM wp_mop_more WHERE mop_project_idmop_project = $this->projectId ORDER BY idmop_more ASC;";
    $result = $wpdb->get_results($queryLoadKnowMore);

    foreach ($result as &$more)
      array_push($this->items, new KnowMore($more->idmop_more, $more->title, $more->body, $more->button, $more->link, $more->position, $projectId));
  }
}