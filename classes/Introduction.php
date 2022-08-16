<?php

namespace MopManager;

class Introduction
{
  public $idmop_intro;
  public $title;
  public $body;
  public $button;
  public $action;
  public $mop_project_idmop_project;

  function __construct($projectId)
  {
    $this->mop_project_idmop_project = $projectId;
    global $wpdb;

    $queryLoadConvertion = "SELECT * FROM wp_mop_intro WHERE mop_project_idmop_project = $this->mop_project_idmop_project;";
    $result = $wpdb->get_results($queryLoadConvertion);

    foreach ($result[0] as $key => $value) {
      $this->{$key} = $value;
    }
  }
}
