<?php

namespace MopManager;

class Concept
{
  public $idmop_concept;
  public $title;
  public $body;
  public $image;
  public $mop_project_idmop_project;

  function __construct($projectId)
  {
    $this->mop_project_idmop_project = $projectId;
    global $wpdb;

    $queryLoadConcept = "SELECT * FROM wp_mop_concept WHERE mop_project_idmop_project = $this->mop_project_idmop_project;";
    $result = $wpdb->get_results($queryLoadConcept);

    foreach ($result[0] as $key => $value) {
      $this->{$key} = $value;
    }
  }
}
