<?php

namespace MopManager;

use \MopManager\CRMConvertion;
use \MopManager\Introduction;
use \MopManager\View;
use \MopManager\VideoGallery;
use \MopManager\ArchitectGallery;
use \MopManager\Implementations;
use \MopManager\Concept;
use \MopManager\KnowMoreButtons;
use \MopManager\Differentials;
use \MopManager\Blueprints;

require_once("ArchitectGallery.php");
require_once("Concept.php");
require_once("CRMConvertion.php");
require_once("Differentials.php");
require_once("ImageGallery.php");
require_once("Implementations.php");
require_once("Introduction.php");
require_once("KnowMoreButtons.php");
require_once("VideoGallery.php");
require_once("View.php");
require_once("Blueprints.php");

class Project
{
  public $idmop_project;
  public $codename;
  public $name;
  public $chat;
  public $whatsapp;
  public $email;
  public $phone;
  public $crm_url;
  public $crm_id;
  public $privacy_url;
  public $video;

  public $bg_header;
  public $logo;
  public $bg_section_2;
  public $bg_video;
  public $bg_implementation;
  public $bg_differentials;
  public $form_key;
  public $recaptcha_key;

  public $legal;
  public $adress_text;
  public $maps_link;

  public $crm_convertion;
  public $introduction;
  public $view;
  public $videoGallery;
  public $architects;
  public $imageGallery;
  public $implementation;
  public $concept;
  public $knowMoreButtons;
  public $differentials;
  public $blueprints;

  function __construct($projectId = -1, $codename = '')
  {
    if ($projectId > 0)
      $this->idmop_project = $projectId;
    else
      $this->codename = $codename;

    global $wpdb;

    if ($projectId > 0)
      $queryLoadProject = "SELECT * FROM wp_mop_project WHERE idmop_project = $this->idmop_project;";
    else
      $queryLoadProject = "SELECT * FROM wp_mop_project WHERE codename = '$this->codename';";

    $result = $wpdb->get_results($queryLoadProject);

    if (!$result)
      die;

    foreach ($result[0] as $key => $value) {
      $this->{$key} = $value;
    }

    $this->crm_convertion = new CRMConvertion($this->idmop_project);
    $this->introduction = new Introduction($this->idmop_project);
    $this->view = new View($this->idmop_project);
    $this->videoGallery = new VideoGallery($this->idmop_project);
    $this->architects = new ArchitectGallery($this->idmop_project);
    $this->imageGallery = new ImageGallery($this->idmop_project);
    $this->implementation = new Implementations($this->idmop_project);
    $this->concept = new Concept($this->idmop_project);
    $this->knowMoreButtons = new KnowMoreButtons($this->idmop_project);
    $this->differentials = new Differentials($this->idmop_project);
    $this->blueprints = new Blueprints($this->idmop_project);
  }
}