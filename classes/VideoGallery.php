<?php

namespace MopManager;

use MopManager\Video;

require_once("Video.php");

class VideoGallery
{
  public $projectId;
  public $items = array();

  function __construct($projectId)
  {
    $this->projectId = $projectId;
    global $wpdb;

    $queryLoadVideos = "SELECT * FROM wp_mop_video WHERE mop_project_idmop_project = $this->projectId ORDER BY idmop_video;";
    $result = $wpdb->get_results($queryLoadVideos);

    foreach ($result as &$video)
      array_push($this->items, new Video($video->idmop_video, $video->preview, $video->link));
  }
}