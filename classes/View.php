<?php

namespace MopManager;

class View
{
  public $idmop_view;
  public $title;
  public $image;
  public $descricao;
  public $mop_project_idmop_project;

  function __construct($projectId)
  {
    $this->mop_project_idmop_project = $projectId;
    global $wpdb;

    $queryLoadConvertion = "SELECT * FROM wp_mop_view WHERE mop_project_idmop_project = $this->mop_project_idmop_project;";
    $result = $wpdb->get_results($queryLoadConvertion);

    foreach ($result[0] as $key => $value) {
      $this->{$key} = $value;
    }
  }
}