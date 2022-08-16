<?php

/** 
 * Hello World 
 * 
 * @package Mop Manager
 * @author Murilo Pereira
 * @copyright 2022 Murilo Pereira
 * @license GPL-2.0-or-later 
 * 
 * @wordpress-plugin 
 * Plugin Name: Mop Manager
 * Plugin URI: https://www.murilopereira.dev.br
 * Description: Manage content from projects pages
 * Version: 1.0.1
 * Author: Murilo Pereira
 * Author URI: https://www.murilopereira.dev.br
 * Text Domain: Murilo Pereira DEV
 * License: GPL v2 or later 
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt */


include(__DIR__ . '/classes/Project.php');
include(__DIR__ . '/functions.php');

register_activation_hook(__FILE__, 'crudOperationsTable');
function crudOperationsTable()
{
  global $wpdb;

  $tables = [
    "mop_project" => "CREATE TABLE IF NOT EXISTS wp_mop_project (
      idmop_project INT(11) NOT NULL AUTO_INCREMENT,
      codename VARCHAR(220) NOT NULL,
      name VARCHAR(220) NOT NULL,
      chat VARCHAR(500) NOT NULL,
      whatsapp VARCHAR(15) NOT NULL,
      email VARCHAR(500) NOT NULL,
      phone VARCHAR(15) NOT NULL,
      crm_url VARCHAR(500) NOT NULL,
      crm_id VARCHAR(50) NOT NULL,
      privacy_url VARCHAR(500) NOT NULL,
      video VARCHAR(500) NOT NULL,
      bg_header VARCHAR(500) NOT NULL,
      logo VARCHAR(500) NOT NULL,
      bg_section_2 VARCHAR(500) NOT NULL,
      bg_video VARCHAR(500) NOT NULL,
      bg_implementation VARCHAR(500) NOT NULL,
      bg_differentials VARCHAR(500) NOT NULL,
      form_key VARCHAR(300) NOT NULL,
      recaptcha_key VARCHAR(300) NOT NULL,
      legal TEXT NOT NULL,
      adress_text VARCHAR (500) NOT NULL,
      maps_link VARCHAR(500) NOT NULL,
      PRIMARY KEY  (idmop_project)) ENGINE=MyISAM;",
    "mop_intro" => "CREATE TABLE IF NOT EXISTS wp_mop_intro (
      idmop_intro INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(220) NOT NULL,
      body TEXT NOT NULL,
      button VARCHAR(220) NOT NULL,
      action TEXT NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_intro, mop_project_idmop_project),      
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_video" => "CREATE TABLE IF NOT EXISTS wp_mop_video (
      idmop_video INT(11) NOT NULL AUTO_INCREMENT,
      preview TEXT NOT NULL,
      link VARCHAR(500) NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_video, mop_project_idmop_project),      
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_concept" => "CREATE TABLE IF NOT EXISTS wp_mop_concept (
      idmop_concept INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(220) NOT NULL,
      body TEXT NOT NULL,
      image VARCHAR(500) NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_concept, mop_project_idmop_project),      
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_view" => "CREATE TABLE IF NOT EXISTS wp_mop_view (
      idmop_view INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(220) NOT NULL,
      image VARCHAR(500) NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_view, mop_project_idmop_project),      
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_architect" => "CREATE TABLE IF NOT EXISTS wp_mop_architect (
      idmop_architect INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(220) NOT NULL,
      body TEXT NOT NULL,
      image VARCHAR(500) NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_architect, mop_project_idmop_project),
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_more" => "CREATE TABLE IF NOT EXISTS wp_mop_more (
      idmop_more INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(220) NOT NULL,
      body TEXT NOT NULL,
      button VARCHAR(220) NOT NULL,
      link VARCHAR(500) NOT NULL,
      position INT(11) NOT NULL DEFAULT 0,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_more, mop_project_idmop_project),
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_blueprint" => "CREATE TABLE IF NOT EXISTS wp_mop_blueprint (
      idmop_blueprint INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(220) NOT NULL,
      image VARCHAR(500) NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_blueprint, mop_project_idmop_project),      
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_implementation" => "CREATE TABLE IF NOT EXISTS wp_mop_implementation (
      idmop_implementation INT(11) NOT NULL AUTO_INCREMENT,
      image VARCHAR(500) NOT NULL,
      title VARCHAR(220) NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_implementation, mop_project_idmop_project),         
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_image" => "CREATE TABLE IF NOT EXISTS wp_mop_image (
      idmop_image INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(220) NOT NULL,
      image VARCHAR(500) NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_image, mop_project_idmop_project),
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_differential" => "CREATE TABLE IF NOT EXISTS wp_mop_differential (
      idmop_differential INT(11) NOT NULL AUTO_INCREMENT,
      title VARCHAR(220) NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_differential, mop_project_idmop_project),
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
    "mop_area_item" =>
    "CREATE TABLE IF NOT EXISTS wp_mop_area_item (
      idmop_area_item INT(11) NOT NULL AUTO_INCREMENT,
      image VARCHAR(500) NOT NULL,
      title VARCHAR(220) NOT NULL,
      mop_differential_idmop_differential INT(11) NOT NULL,
      PRIMARY KEY  (idmop_area_item, mop_differential_idmop_differential),
      FOREIGN KEY  (mop_differential_idmop_differential) REFERENCES  mop_differential(idmop_differential)) ENGINE=MyISAM;",
    "mop_crm_from_to" => "CREATE TABLE IF NOT EXISTS wp_mop_crm_from_to (
      idmop_crm_from_to INT(11) NOT NULL AUTO_INCREMENT,
      from_field VARCHAR(200) NOT NULL,
      to_field VARCHAR(200) NOT NULL,
      mop_project_idmop_project INT(11) NOT NULL,
      PRIMARY KEY  (idmop_crm_from_to, mop_project_idmop_project), 
      FOREIGN KEY  (mop_project_idmop_project) REFERENCES  mop_project(idmop_project)) ENGINE=MyISAM;",
  ];

  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

  foreach ($tables as $key  => $sql) {
    $wpdb->query($sql);
  }

  file_put_contents(__DIR__ . '/my_loggg.txt', ob_get_contents());
}

add_action('admin_menu', 'addAdminPageContent');

function addAdminPageContent()
{
  add_menu_page('Mop Manager', 'Mop Manager', null, 'mop-manager.php', null, 'dashicons-wordpress');
  add_submenu_page('mop-manager.php', 'Mop Manager - Create Project', 'New Project', 'manage_options', 'mop-edit.php', 'mopCreate');
  add_submenu_page('mop-manager.php', 'Mop Manager - List Of Projects', "List of Projects", 'manage_options', 'mop-list.php', 'mopList');
}

add_action('wp_ajax_save_project', 'saveProject');
add_action('wp_ajax_update_project', 'updateProject');
add_action('wp_ajax_load_project', 'loadProject');

function loadProject()
{
  if (isset($_GET["projectId"]) && $_GET["projectId"] > 0) {
    $project = new \MopManager\Project($_GET["projectId"]);
    echo json_encode($project);
    wp_die();
  }

  return status_header(404, 'Project not found');
}

function allSuccess($array)
{
  foreach ($array as $key => $result) {
    if (!($result > 0))
      return false;
  }

  return true;
}

function updateProject()
{
  global $wpdb;
  $idmop_project = $_POST["idmop_project"];
  $project_data = $_POST["data"];

  $projectId = $project_data["projectId"];
  $projectName = $project_data["projectName"];
  $mainVideo = $project_data["mainVideo"];
  $chatURL = $project_data["chatURL"];
  $whatsapp = $project_data["whatsapp"];
  $email = $project_data["email"];
  $phone = $project_data["phone"];
  $crmURL = $project_data["crmURL"];
  $crmProduto = $project_data["crmProduto"];
  $politicaPrivacidade = $project_data["politicaPrivacidade"];
  $bg_header = $project_data["bg_header"];
  $logo = $project_data["logo"];
  $bg_section_2 = $project_data["bg_section_2"];
  $bg_video = $project_data["bg_video"];
  $bg_implementation = $project_data["bg_implementation"];
  $bg_differentials = $project_data["bg_differentials"];
  $form_key = $project_data["form_key"];
  $recaptcha_key = $project_data["recaptcha_key"];
  $legal = $project_data["legal"];
  $adress_text = $project_data["adress_text"];
  $maps_link = $project_data["maps_link"];

  $introId = $project_data["introId"];
  $introTitle = $project_data["introTitle"];
  $introBody = $project_data["introBody"];
  $introButton = $project_data["introButton"];
  $introButtonURL = $project_data["introButtonURL"];

  $viewId = $project_data["viewId"];
  $viewTitle = $project_data["viewTitle"];
  $viewImage = $project_data["viewImage"];
  $viewDesc = $project_data["viewDesc"];
	var_dump($project_data);

  $youtubeVideos = $project_data["youtubeVideos"];

  $architects = $project_data["architects"];

  $images = $project_data["images"];

  $implantations = $project_data["implantations"];

  $blueprints = $project_data["blueprints"];

  $conceptId = $project_data["conceptId"];
  $conceptTitle = $project_data["conceptTitle"];
  $conceptBody = $project_data["conceptBody"];
  $conceptImage = $project_data["conceptImage"];

  $moreOneId = $project_data["moreOneId"];
  $moreOneTitle = $project_data["moreOneTitle"];
  $moreOneBody = $project_data["moreOneBody"];
  $moreOneButton = $project_data["moreOneButton"];
  $moreOneUrl = $project_data["moreOneUrl"];
  $moreOnePosition = $project_data["moreOnePosition"];

  $moreTwoId = $project_data["moreTwoId"];
  $moreTwoTitle = $project_data["moreTwoTitle"];
  $moreTwoBody = $project_data["moreTwoBody"];
  $moreTwoButton = $project_data["moreTwoButton"];
  $moreTwoUrl = $project_data["moreTwoUrl"];
  $moreTwoPosition = $project_data["moreTwoPosition"];

  $areas = $project_data["areas"];

  $fromTos = $project_data["fromTos"];

  $wpdb->query('START TRANSACTION');

  $queryProject = "
    UPDATE
      wp_mop_project
    SET
      codename='$projectId',
      name='$projectName',
      chat='$chatURL',
      whatsapp='$whatsapp',
      email='$email',
      phone='$phone',
      crm_url='$crmURL',
      crm_id='$crmProduto',
      privacy_url='$politicaPrivacidade',
      video='$mainVideo',      
      bg_header='$bg_header',
      logo='$logo',
      bg_section_2='$bg_section_2',
      bg_video='$bg_video',
      bg_implementation='$bg_implementation',
      bg_differentials='$bg_differentials',
      form_key='$form_key',
      recaptcha_key='$recaptcha_key',
      legal='$legal',
      adress_text='$adress_text',
      maps_link='$maps_link'
    WHERE
      idmop_project = $idmop_project;
  ";

  $resultProject = $wpdb->query(
    $wpdb->prepare($queryProject)
  );

  if ((int)$introId > 0) {
    $queryIntro = "
      UPDATE
        wp_mop_intro
      SET
        title='$introTitle',
        body='$introBody',
        button='$introButton',
        action='$introButtonURL'              
      WHERE
        mop_project_idmop_project = $idmop_project
      AND
        idmop_intro='$introId';
    ";
  } else {
    $queryIntro = "
      INSERT INTO
        wp_mop_intro(title,body,button,action,mop_project_idmop_project)
      VALUES(
        '$introTitle',
        '$introBody',
        '$introButton',
        '$introButtonURL'              
        '$idmop_project'
      );";
  }

  $resultIntro = $wpdb->query(
    $wpdb->prepare($queryIntro)
  );

  if ((int)$viewId > 0) {
    $queryView = "
    UPDATE
      wp_mop_view      
    SET
      title='$viewTitle',
      image='$viewImage',
      descricao='$viewDesc'  
    WHERE
      mop_project_idmop_project = $idmop_project
    AND
      idmop_view='$viewId';
  ";
  } else {
    $queryView = "
      INSERT INTO
        wp_mop_view(title,image,descricao,mop_project_idmop_project)
      VALUES(
        '$viewTitle',
        '$viewImage',            
        '$viewDesc',
        '$idmop_project'
      );";
  }
	var_dump($queryView);
  $resultView = $wpdb->query(
    $wpdb->prepare($queryView)
  );

  if ((int)$conceptId > 0) {
    $queryConcept = "
      UPDATE
        wp_mop_concept              
      SET
        title='$conceptTitle',
        body='$conceptBody',      
        image='$conceptImage'
      WHERE
        mop_project_idmop_project = $idmop_project
      AND
        idmop_concept='$idmop_project';
    ";
  } else {
    $queryConcept = "
      INSERT INTO
        wp_mop_concept(title,body,image,mop_project_idmop_project)
      VALUES(
        '$conceptTitle',
        '$conceptBody',    
        '$conceptImage',        
        '$idmop_project'
      );";
  }

  $resultConcept = $wpdb->query(
    $wpdb->prepare($queryConcept)
  );

  if ((int)$moreOneId > 0) {
    $queryMoreOne = "
    UPDATE
      wp_mop_more
    SET
      title='$moreOneTitle',
      body='$moreOneBody',
      button='$moreOneButton',
      link='$moreOneUrl',
      position='$moreOnePosition'
    WHERE
      mop_project_idmop_project = $idmop_project
    AND
      idmop_more='$moreOneId';
  ";
  } else {
    $queryMoreOne = "
      INSERT INTO
        wp_mop_more(title,body,button,link,position,mop_project_idmop_project)
      VALUES(
        '$moreOneTitle',
        '$moreOneBody',    
        '$moreOneButton',
        '$moreOneUrl',
        '$moreOnePosition',
        '$idmop_project'
      );";
  }

  $resultMoreOne = $wpdb->query(
    $wpdb->prepare($queryMoreOne)
  );

  if ((int)$moreTwoId > 0) {
    $queryMoreTwo = "
    UPDATE
      wp_mop_more
    SET
      title='$moreTwoTitle',
      body='$moreTwoBody',
      button='$moreTwoButton',
      link='$moreTwoUrl',
      position='$moreTwoPosition'
    WHERE
      mop_project_idmop_project = $idmop_project
    AND
      idmop_more='$moreTwoId';
  ";
  } else {
    $queryMoreTwo = "
      INSERT INTO
        wp_mop_more(title,body,button,link,position,mop_project_idmop_project)
      VALUES(
        '$moreTwoTitle',
        '$moreTwoBody',    
        '$moreTwoButton',
        '$moreTwoUrl',
        '$moreTwoPosition',
        '$idmop_project'
      );";
  }

  $resultMoreTwo = $wpdb->query(
    $wpdb->prepare($queryMoreTwo)
  );

  $videoResults = [];
  $videoIds = [];

  foreach ($youtubeVideos as $key => $video) {
    $queryVideo = "";

    if ((int)$video["id"] > 0) {
      $queryVideo = "
        UPDATE
          wp_mop_video
        SET
          preview='" . $video["preview"] . "',
          link='" . $video["url"] . "'
        WHERE
          mop_project_idmop_project = $idmop_project
        AND
          idmop_video = '" . $video["id"] . "';
      ";
    } else {
      $queryVideo = "
        INSERT INTO
          wp_mop_video(
            preview,
            link,
            mop_project_idmop_project
          )
        VALUES (
          '" . $video["preview"] . "', 
          '" . $video["url"] . "', 
          $idmop_project
        );
      ";
    }

    $videoResult = $wpdb->query(
      $wpdb->prepare($queryVideo)
    );

    array_push($videoResults, $videoResult);

    if ((int)$video["id"] > 0)
      array_push($videoIds, $video["id"]);
    else
      array_push($videoIds, $wpdb->insert_id);
  }

  if (empty($videoIds)) {
    $queryDeleteVideo = "DELETE FROM wp_mop_video WHERE mop_project_idmop_project = $idmop_project";
  } else {
    $queryDeleteVideo = "DELETE FROM wp_mop_video WHERE mop_project_idmop_project = $idmop_project AND idmop_video NOT IN(" . implode(",", $videoIds) . ")";
  }

  $videoResult = $wpdb->query(
    $wpdb->prepare($queryDeleteVideo)
  );

  array_push($videoResults, $videoResult);

  $resultsArchitects = [];
  $architectIds = [];
  foreach ($architects as $key => $architect) {
    if ((int)$architect["id"] > 0) {
      $queryArchitect = "
        UPDATE
          wp_mop_architect              
        SET
          title='" . $architect["name"] . "',
          body='" . $architect["body"] . "',
          image='" . $architect["image"] . "'
        WHERE
          mop_project_idmop_project = $idmop_project
        AND
          idmop_architect = '" . $architect["id"] . "';    
      ";
    } else {
      $queryArchitect = "INSERT INTO
        wp_mop_architect(
          title,
          body,
          image,
          mop_project_idmop_project
        )
      VALUES(
        '" . $architect["name"] . "',
        '" . $architect["body"] . "',
        '" . $architect["image"] . "',
        '$idmop_project'
      );
      ";
    }

    $resultArchitect = $wpdb->query(
      $wpdb->prepare($queryArchitect)
    );

    array_push($resultsArchitects, $resultArchitect);

    if ((int)$video["id"] > 0)
      array_push($architectIds, $architect["id"]);
    else
      array_push($architectIds, $wpdb->insert_id);
  }

  if (empty($architectIds)) {
    $queryDeleteArchitect = "DELETE FROM wp_mop_architect WHERE mop_project_idmop_project = $idmop_project";
  } else {
    $queryDeleteArchitect = "DELETE FROM wp_mop_architect WHERE mop_project_idmop_project = $idmop_project AND idmop_architect NOT IN(" . implode(",", $architectIds) . ")";
  }

  $architectResult = $wpdb->query(
    $wpdb->prepare($queryDeleteArchitect)
  );

  $imageResults = [];
  $imageIds = [];

  foreach ($images as $key => $image) {
    $queryImage = "";

    if ((int)$image["id"] > 0) {
      $queryImage = "
        UPDATE
          wp_mop_image
        SET
          title='" . $image["title"] . "',
          image='" . $image["url"] . "'
        WHERE
          mop_project_idmop_project = $idmop_project
        AND
          idmop_image = '" . $image["id"] . "';
      ";
    } else {
      $queryImage = "
        INSERT INTO
          wp_mop_image(
            title,
            image,
            mop_project_idmop_project
          )
        VALUES (
          '" . $image["title"] . "', 
          '" . $image["url"] . "', 
          $idmop_project
        );
      ";
    }

    $imageResult = $wpdb->query(
      $wpdb->prepare($queryImage)
    );

    array_push($imageResults, $imageResult);

    if ((int)$image["id"] > 0)
      array_push($imageIds, $image["id"]);
    else
      array_push($imageIds, $wpdb->insert_id);
  }

  if (empty($imageIds)) {
    $queryDeleteImage = "DELETE FROM wp_mop_image WHERE mop_project_idmop_project = $idmop_project";
  } else {
    $queryDeleteImage = "DELETE FROM wp_mop_image WHERE mop_project_idmop_project = $idmop_project AND idmop_image NOT IN(" . implode(",", $imageIds) . ")";
  }

  $imageResult = $wpdb->query(
    $wpdb->prepare($queryDeleteImage)
  );

  array_push($imageResults, $imageResult);

  $implantationResults = [];
  $implantationIds = [];

  foreach ($implantations as $key => $implantation) {
    $queryImplantation = "";

    if ((int)$implantation["id"] > 0) {
      $queryImplantation = "
        UPDATE
          wp_mop_implementation
        SET
          title='" . $implantation["title"] . "',
          image='" . $implantation["image"] . "'
        WHERE
          mop_project_idmop_project = $idmop_project
        AND
          idmop_implementation = '" . $implantation["id"] . "';
      ";
    } else {
      $queryImplantation = "
        INSERT INTO
          wp_mop_implementation(
            title,
            image,
            mop_project_idmop_project
          )
        VALUES (
          '" . $implantation["title"] . "', 
          '" . $implantation["image"] . "', 
          $idmop_project
        );
      ";
    }

    $implantationResult = $wpdb->query(
      $wpdb->prepare($queryImplantation)
    );

    array_push($implantationResults, $implantationResult);

    if ((int)$implantation["id"] > 0)
      array_push($implantationIds, $implantation["id"]);
    else
      array_push($implantationIds, $wpdb->insert_id);
  }

  if (empty($implantationIds)) {
    $queryDeleteImplantation = "DELETE FROM wp_mop_implementation WHERE mop_project_idmop_project = $idmop_project";
  } else {
    $queryDeleteImplantation = "DELETE FROM wp_mop_implementation WHERE mop_project_idmop_project = $idmop_project AND idmop_implementation NOT IN(" . implode(",", $implantationIds) . ")";
  }
  $implantationResult = $wpdb->query(
    $wpdb->prepare($queryDeleteImplantation)
  );

  array_push($implantationResults, $implantationResult);

  $blueprintResults = [];
  $blueprintIds = [];

  foreach ($blueprints as $key => $blueprint) {
    $queryBlueprint = "";

    if ((int)$blueprint["id"] > 0) {
      $queryBlueprint = "
        UPDATE
          wp_mop_blueprint
        SET
          title='" . $blueprint["title"] . "',
          image='" . $blueprint["image"] . "'
        WHERE
          mop_project_idmop_project = $idmop_project
        AND
          idmop_blueprint = '" . $blueprint["id"] . "';
      ";
    } else {
      $queryBlueprint = "
        INSERT INTO
          wp_mop_blueprint(
            title,
            image,
            mop_project_idmop_project
          )
        VALUES (
          '" . $blueprint["title"] . "', 
          '" . $blueprint["image"] . "', 
          $idmop_project
        );
      ";
    }

    $blueprintResult = $wpdb->query(
      $wpdb->prepare($queryBlueprint)
    );

    array_push($blueprintResults, $blueprintResult);

    if ((int)$blueprint["id"] > 0)
      array_push($blueprintIds, $blueprint["id"]);
    else
      array_push($blueprintIds, $wpdb->insert_id);
  }

  if (empty($blueprintIds)) {
    $queryDeleteBlueprint = "DELETE FROM wp_mop_blueprint WHERE mop_project_idmop_project = $idmop_project;";
  } else {
    $queryDeleteBlueprint = "DELETE FROM wp_mop_blueprint WHERE mop_project_idmop_project = $idmop_project AND idmop_blueprint NOT IN(" . implode(",", $blueprintIds) . ")";
  }
  $blueprintResult = $wpdb->query(
    $wpdb->prepare($queryDeleteBlueprint)
  );

  array_push($blueprintResults, $blueprintResult);

  $resultAreas = [];
  $areaIds = [];
  $areaItemIds = [];

  foreach ($areas as $key => $area) {
    if ((int)$area["id"] > 0) {
      $queryArea = "
      UPDATE
        wp_mop_differential
      SET
        title='" . $area["title"] . "'
      WHERE
        mop_project_idmop_project = $idmop_project
      AND
        idmop_differential = '" . $area["id"] . "';
    ";
    } else {
      $queryArea = "INSERT INTO
      wp_mop_differential(
        title,
        mop_project_idmop_project
      )
    VALUES(
      '" . $area["title"] . "',
      $idmop_project
    );
    ";
    }

    $resultArea = $wpdb->query(
      $wpdb->prepare($queryArea)
    );

    $areaId = (int)$area["id"] > 0 ? $area["id"] : $wpdb->insert_id;

    array_push($resultAreas, $resultArea);
    array_push($areaIds, $areaId);

    foreach ($area["items"] as $key => $item) {
      if ((int)$item["id"] > 0) {
        $areaItemQuery = "
          UPDATE
            wp_mop_area_item              
          SET
            image='" . $item["image"] . "',
            title='" . $item["title"] . "'
          WHERE
            idmop_area_item = '" . $item["id"] . "'
          AND
            mop_differential_idmop_differential = $areaId;          
        ";
      } else {
        $areaItemQuery = "
          INSERT INTO
            wp_mop_area_item(
              image,
              title,
              mop_differential_idmop_differential
            )
          VALUES(
            '" . $item["image"] . "',
            '" . $item["title"] . "',
            $areaId
          );
        ";
      }

      $resultAreaItem = $wpdb->query(
        $wpdb->prepare($areaItemQuery)
      );

      $itemId = (int)$item["id"] > 0 ? $item["id"] : $wpdb->insert_id;

      array_push($resultAreas, $resultAreaItem);
      array_push($areaItemIds, $itemId);
    }
  }

  if (empty($areaItemIds)) {
    $queryDeleteAreaItem = "
    DELETE FROM 
      wp_mop_area_item 
    WHERE 
      mop_differential_idmop_differential IN (" . implode(",", $areaIds) . ")";
  } else {
    $queryDeleteAreaItem = "
    DELETE FROM 
      wp_mop_area_item 
    WHERE 
      mop_differential_idmop_differential IN (" . implode(",", $areaIds) . ") 
    AND idmop_area_item NOT IN(" . implode(",", $areaItemIds) . ")";
  }
  $deleteAreaItemResult = $wpdb->query(
    $wpdb->prepare($queryDeleteAreaItem)
  );

  array_push($resultAreas, $deleteAreaItemResult);

  $queryDeleteArea = "
    DELETE FROM 
      wp_mop_differential
    WHERE 
      mop_project_idmop_project = $idmop_project 
    AND idmop_differential NOT IN(" . implode(",", $areaIds) . ")";
  $deleteAreaResult = $wpdb->query(
    $wpdb->prepare($queryDeleteArea)
  );

  array_push($resultAreas, $deleteAreaResult);

  $fromToResults = [];
  $fromToIds = [];

  foreach ($fromTos as $key => $fromTo) {
    $queryFromTo = "";

    if ((int)$fromTo["id"] > 0) {
      $queryFromTo = "
        UPDATE
          wp_mop_crm_from_to
        SET
          from_field='" . $fromTo["from"] . "',
          to_field='" . $fromTo["to"] . "'
        WHERE
          mop_project_idmop_project = $idmop_project
        AND
          idmop_crm_from_to = '" . $fromTo["id"] . "';
      ";
    } else {
      $queryFromTo = "
        INSERT INTO
          wp_mop_crm_from_to(
            from_field,
            to_field,
            mop_project_idmop_project
          )
        VALUES (
          '" . $fromTo["from"] . "', 
          '" . $fromTo["to"] . "', 
          $idmop_project
        );
      ";
    }

    $fromToResult = $wpdb->query(
      $wpdb->prepare($queryFromTo)
    );

    array_push($fromToResults, $fromToResult);

    if ((int)$fromTo["id"] > 0)
      array_push($fromToIds, $fromTo["id"]);
    else
      array_push($fromToIds, $wpdb->insert_id);
  }

  if (empty($fromToIds)) {
    $queryDeleteFromTo = "DELETE FROM wp_mop_crm_from_to WHERE mop_project_idmop_project = $idmop_project";
  } else {
    $queryDeleteFromTo = "DELETE FROM wp_mop_crm_from_to WHERE mop_project_idmop_project = $idmop_project AND idmop_crm_from_to NOT IN(" . implode(",", $fromToIds) . ")";
  }
  $fromToResult = $wpdb->query(
    $wpdb->prepare($queryDeleteFromTo)
  );

  $wpdb->query('COMMIT');
  echo json_encode([
    "success" => true,
    "id" => $idmop_project
  ]);

  wp_die();
}

function saveProject()
{
  global $wpdb;
  $project_data = $_POST["data"];

  $projectId = $project_data["projectId"];
  $projectName = $project_data["projectName"];
  $mainVideo = $project_data["mainVideo"];
  $chatURL = $project_data["chatURL"];
  $whatsapp = $project_data["whatsapp"];
  $email = $project_data["email"];
  $phone = $project_data["phone"];
  $crmURL = $project_data["crmURL"];
  $crmProduto = $project_data["crmProduto"];
  $politicaPrivacidade = $project_data["politicaPrivacidade"];
  $bg_header = $project_data["bg_header"];
  $logo = $project_data["logo"];
  $bg_section_2 = $project_data["bg_section_2"];
  $bg_video = $project_data["bg_video"];
  $bg_implementation = $project_data["bg_implementation"];
  $bg_differentials = $project_data["bg_differentials"];
  $form_key = $project_data["form_key"];
  $recaptcha_key = $project_data["recaptcha_key"];
  $legal = $project_data["legal"];
  $adress_text = $project_data["adress_text"];
  $maps_link = $project_data["maps_link"];

  $introTitle = $project_data["introTitle"];
  $introBody = $project_data["introBody"];
  $introButton = $project_data["introButton"];
  $introButtonURL = $project_data["introButtonURL"];

  $viewTitle = $project_data["viewTitle"];
  $viewImage = $project_data["viewImage"];
  $viewDesc = $project_data["viewDesc"];
	var_dump($project_data);

  $youtubeVideos = $project_data["youtubeVideos"];

  $architects = $project_data["architects"];

  $images = $project_data["images"];

  $implantations = $project_data["implantations"];

  $blueprints = $project_data["blueprints"];

  $conceptTitle = $project_data["conceptTitle"];
  $conceptBody = $project_data["conceptBody"];
  $conceptImage = $project_data["conceptImage"];

  $moreOneTitle = $project_data["moreOneTitle"];
  $moreOneBody = $project_data["moreOneBody"];
  $moreOneButton = $project_data["moreOneButton"];
  $moreOneUrl = $project_data["moreOneUrl"];
  $moreOnePosition = $project_data["moreOnePosition"];

  $moreTwoTitle = $project_data["moreTwoTitle"];
  $moreTwoBody = $project_data["moreTwoBody"];
  $moreTwoButton = $project_data["moreTwoButton"];
  $moreTwoUrl = $project_data["moreTwoUrl"];
  $moreTwoPosition = $project_data["moreTwoPosition"];

  $areas = $project_data["areas"];

  $fromTos = $project_data["fromTos"];

  $queryProject = "
    INSERT INTO 
      wp_mop_project(
        codename,
        name,
        chat,
        whatsapp,
        email,
        phone,
        crm_url,
        crm_id,
        privacy_url,
        video,
        bg_header,
        logo,
        bg_section_2,
        bg_video,
        bg_implementation,
        bg_differentials,
        form_key,
        recaptcha_key,
        legal,
        adress_text,
        maps_link
      ) 
    VALUES(
      '$projectId',
      '$projectName',
      '$chatURL',
      '$whatsapp',
      '$email',
      '$phone',
      '$crmURL',
      '$crmProduto',
      '$politicaPrivacidade',
      '$mainVideo',      
      '$bg_header',
      '$logo',
      '$bg_section_2',
      '$bg_video',
      '$bg_implementation',
      '$bg_differentials',
      '$form_key',
      '$recaptcha_key',
      '$legal',
      '$adress_text',
      '$maps_link'
    );
  ";

  $resultProject = $wpdb->query(
    $wpdb->prepare($queryProject)
  );

  var_dump($wpdb->query("SELECT * FROM wp_mop_project"));

  $projectId = $wpdb->insert_id;

  if (!($projectId > 0)) {
    echo json_encode(["success" => false, "error" => $wpdb->last_error, "id" => $projectId, "query" => $queryProject]);
    wp_die();
  }

  $queryIntro = "
    INSERT INTO 
      wp_mop_intro(
        title,
        body,
        button,
        action,
        mop_project_idmop_project
      )
    VALUES (
      '$introTitle',
      '$introBody',
      '$introButton',
      '$introButtonURL',
      $projectId
    );
  ";

  $resultIntro = $wpdb->query(
    $wpdb->prepare($queryIntro)
  );

  $queryView = "
    INSERT INTO 
      wp_mop_view(
        title,
        image,
        descricao,
        mop_project_idmop_project
      )
    VALUES (
      '$viewTitle',
      '$viewImage',      
      '$viewDesc',
      $projectId
    );
  ";

  $resultView = $wpdb->query(
    $wpdb->prepare($queryView)
  );

  $queryVideos = "
    INSERT INTO
      wp_mop_video(
        preview,
        link,
        mop_project_idmop_project
      )
    VALUES
  ";

  foreach ($youtubeVideos as $key => $video) {
    $queryVideos .= "('" . $video["preview"] . "', '" . $video["url"] . "', $projectId),";
  }

  $queryVideos = rtrim($queryVideos, ",") . ";";

  $resultVideos = $wpdb->query(
    $wpdb->prepare($queryVideos)
  );

  $resultsArchitects = [];

  foreach ($architects as $key => $architect) {
    $queryArchitect = "INSERT INTO
      wp_mop_architect(
        title,
        body,
        image,
        mop_project_idmop_project
      )
    VALUES(
      '" . $architect["name"] . "',
      '" . $architect["body"] . "',
      '" . $architect["image"] . "',
      '$projectId'
    );
    ";

    $resultArchitect = $wpdb->query(
      $wpdb->prepare($queryArchitect)
    );

    array_push($resultsArchitects, $resultArchitect);
  }

  $queryImages = "
    INSERT INTO
      wp_mop_image(
        title,
        image,
        mop_project_idmop_project
      )
    VALUES
  ";

  foreach ($images as $key => $image) {
    $queryImages .= "('" . $image['title'] . "', '" . $image['url'] . "', $projectId),";
  }

  $queryImages = rtrim($queryImages, ",") . ";";

  $resultImages = $wpdb->query(
    $wpdb->prepare($queryImages)
  );

  $queryImplantations = "
    INSERT INTO
      wp_mop_implementation(
        image,
        title,
        mop_project_idmop_project
      )
    VALUES
  ";

  foreach ($implantations as $key => $implantation) {
    $queryImplantations .= "('" . $implantation["image"] . "', '" . $implantation["title"] . "', $projectId),";
  }

  $queryImplantations = rtrim($queryImplantations, ",") . ";";

  $resultImplantations = $wpdb->query(
    $wpdb->prepare($queryImplantations)
  );

  $queryBlueprints = "
    INSERT INTO
      wp_mop_blueprint(
        image,
        title,
        mop_project_idmop_project
      )
    VALUES
  ";

  foreach ($blueprints as $key => $blueprint) {
    $queryBlueprints .= "('" . $blueprint["image"] . "', '" . $blueprint["title"] . "', $projectId),";
  }

  $queryBlueprints = rtrim($queryBlueprints, ",") . ";";

  $resultBlueprints = $wpdb->query(
    $wpdb->prepare($queryBlueprints)
  );

  $queryConcept = "
    INSERT INTO 
      wp_mop_concept(
        title,
        body,
        image,
        mop_project_idmop_project
      )
    VALUES (
      '$conceptTitle',
      '$conceptBody',      
      '$conceptImage',      
      $projectId
    );
  ";

  $resultConcept = $wpdb->query(
    $wpdb->prepare($queryConcept)
  );

  $queryMoreOne = "
    INSERT INTO 
      wp_mop_more(
        title,
        body,
        button,
        link,
        position,
        mop_project_idmop_project
      )
    VALUES (
      '$moreOneTitle',
      '$moreOneBody',
      '$moreOneButton',
      '$moreOneUrl',
      '$moreOnePosition',
      $projectId
    );
  ";

  $resultMoreOne = $wpdb->query(
    $wpdb->prepare($queryMoreOne)
  );

  $queryMoreTwo = "
    INSERT INTO 
      wp_mop_more(
        title,
        body,
        button,
        link,
        position,
        mop_project_idmop_project
      )
    VALUES (
      '$moreTwoTitle',
      '$moreTwoBody',
      '$moreTwoButton',
      '$moreTwoUrl',
      '$moreTwoPosition',
      $projectId
    );
  ";

  $resultMoreTwo = $wpdb->query(
    $wpdb->prepare($queryMoreTwo)
  );

  foreach ($areas as $key => $area) {
    $queryArea = "INSERT INTO
      wp_mop_differential(
        title,
        mop_project_idmop_project
      )
    VALUES(
      '" . $area["title"] . "',
      $projectId
    );
    ";

    $resultArea = $wpdb->query(
      $wpdb->prepare($queryArea)
    );

    $areaId = $wpdb->insert_id;

    array_push(
      $resultAreas,
      $resultArea
    );
    array_push($areaIds, $areaId);

    foreach ($area["items"] as $key => $item) {
      $areaItemQuery = "
        INSERT INTO
          wp_mop_area_item(
            image,
            title,
            mop_differential_idmop_differential
          )
        VALUES(
          '" . $item["image"] . "',
          '" . $item["title"] . "',
          $areaId
        );
      ";


      $resultAreaItem = $wpdb->query(
        $wpdb->prepare($areaItemQuery)
      );

      $itemId = $wpdb->insert_id;

      array_push($resultAreas, $resultAreaItem);
      array_push($areaItemIds, $itemId);
    }
  }

  $queryFromTo = "
    INSERT INTO
      wp_mop_crm_from_to(
        from_field,
        to_field,
        mop_project_idmop_project
      )
    VALUES
  ";

  foreach ($fromTos as $key => $fromTo) {
    $queryFromTo .= "('" . $fromTo['from'] . "', '" . $fromTo['to'] . "', $projectId),";
  }

  $queryFromTo = rtrim($queryFromTo, ",") . ";";

  $resultFromTo = $wpdb->query(
    $wpdb->prepare($queryFromTo)
  );

  if (
    $resultProject &&
    $resultIntro &&
    $resultView &&
    $resultVideos &&
    allSuccess($resultsArchitects) &&
    $resultImages &&
    $resultImplantations &&
    $resultConcept &&
    $resultMoreOne &&
    $resultMoreTwo &&
    allSuccess($resultAreas) &&
    $resultFromTo &&
    $resultBlueprints
  ) {
    $wpdb->query('COMMIT');
    echo json_encode([
      "success" => true,
      "id" => $projectId
    ]);
  } else {
    $wpdb->query('ROLLBACK');
    status_header(500);
  }

  wp_die();
}

function mopList()
{
  global $wpdb;

  if (isset($_GET["del"]) && $_GET["del"] > 0) {
    $projectId = $_GET["del"];
    $wpdb->query("DELETE FROM wp_mop_project WHERE idmop_project = $projectId");

    echo "<script>window.location = `admin.php?page=mop-list.php`</script>";
  }

  $queryLoadProjects = "SELECT idmop_project, codename, name FROM wp_mop_project;";
  $result = $wpdb->get_results($queryLoadProjects);
?>
<div class="wrap">
  <script>
  const confirmBeforeDelete = (projectId, projectName) => {
    if (confirm(`Você tem certeza que deseja excluir o projeto ${projectName}?`)) {
      window.location = `admin.php?page=mop-list.php&del=${projectId}`
    }

    return;
  }
  </script>
  <h2>Lista de Projetos</h2>
  <table class="wp-list-table widefat striped">
    <tr>
      <th>Id Projetos</th>
      <th>Codename</th>
      <th>Nome</th>
      <th>Ações</th>
    </tr>
    <?php
      foreach ($result as &$project) {
      ?>
    <tr>
      <td><?= $project->idmop_project ?></td>
      <td><?= $project->codename ?></td>
      <td><?= $project->name ?></td>
      <td><a href="admin.php?page=mop-edit.php&updt=<?= $project->idmop_project ?>"><button
            type='button'>EDITAR</button></a>&nbsp;<button
          onclick="confirmBeforeDelete(<?= $project->idmop_project ?>, '<?= $project->name ?>')"
          type='button'>DELETE</button></td>
    </tr>
    <?
      }
      ?>
  </table>
</div>
<?php
}

function mopCreate()
{
?>
<div id="form-container" class=" wrap">
  <style>
  .lds-ring {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
  }

  .lds-ring div {
    box-sizing: border-box;
    display: block;
    position: absolute;
    width: 64px;
    height: 64px;
    margin: 8px;
    border: 8px solid #dfc;
    border-radius: 50%;
    animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
    border-color: #dfc transparent transparent transparent;
  }

  .lds-ring div:nth-child(1) {
    animation-delay: -0.45s;
  }

  .lds-ring div:nth-child(2) {
    animation-delay: -0.3s;
  }

  .lds-ring div:nth-child(3) {
    animation-delay: -0.15s;
  }

  @keyframes lds-ring {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }
  </style>
  <h2>Novo Projeto</h2>
  <div class="sections-wrapper">
    <div class="section-fit">
      <span>Informações Básicas</span>
      <div class="section">
        <div class="field">
          <label for="project-id">ID Projeto</label>
          <input id="project-id" type="text" maxlength="500" readonly />
        </div>
        <div class="field">
          <label for="project-name">Nome do Projeto</label>
          <input id="project-name" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="video">Vídeo de Apresentação</label>
          <input id="video" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="chat-url">Chat URL</label>
          <input id="chat-url" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="whatsapp">Whatsapp</label>
          <input id="whatsapp" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="email">Email</label>
          <input id="email" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="telefone">Telefone</label>
          <input id="telefone" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="crm-url">CRM URL</label>
          <input id="crm-url" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="crm-produto">CRM Produto</label>
          <input id="crm-produto" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="privacidade">Política de Privacidade</label>
          <input id="privacidade" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="bg_header">Background Header</label>
          <input id="bg_header" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="logo">Logo</label>
          <input id="logo" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="bg_section_2">Background Seção 2</label>
          <input id="bg_section_2" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="bg_video">Background Vídeo</label>
          <input id="bg_video" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="bg_implementation">Background Implantação</label>
          <input id="bg_implementation" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="bg_differentials">Background Diferenciais</label>
          <input id="bg_differentials" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="form_key">Form Key</label>
          <input id="form_key" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="recaptcha_key">Recaptcha Key</label>
          <input id="recaptcha_key" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="legal">Texto Legal</label>
          <textarea id="legal"></textarea>
        </div>
        <div class="field">
          <label for="adress_text">Texto Endereço</label>
          <input id="adress_text" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="maps_link">Google Maps</label>
          <input id="maps_link" type="text" maxlength="500" />
        </div>
      </div>
    </div>
    <div class="section-fit">
      <span>CRM - De/Para</span>
      <div class="section">
        <div class="field">
          <label for="crm-from">De</label>
          <input id="crm-from" type="text" maxlength="500" />
        </div>
        <div class="field">
          <label for="crm-to">Para</label>
          <input id="crm-to" type="text" maxlength="500" />
        </div>
        <button onclick="addCRMFromTo()" type="button" style="align-self: flex-end; margin-top: 10px">Adicionar</button>
        <div id="crm-list" class="url-list">
        </div>
      </div>
    </div>
    <div class="vertical">
      <div class="section-fit">
        <span>Introdução</span>
        <input type="hidden" value="-1" id="intro-id" />
        <div class="section">
          <div class="field">
            <label for="intro-title">Título</label>
            <input id="intro-title" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="intro-body">Corpo</label>
            <textarea id="intro-body"></textarea>
          </div>
          <div class="field">
            <label for="intro-button">Botão</label>
            <input id="intro-button" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="intro-url">URL Botão</label>
            <input id="intro-url" type="text" maxlength="500" />
          </div>
        </div>
      </div>
      <div class="section-fit">
        <span>Vista</span>
        <input type="hidden" value="-1" id="view-id" />
        <div class="section">
          <div class="field">
            <label for="view-title">Título</label>
            <input id="view-title" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="view-image">Imagem</label>
            <input id="view-image" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="view-desc">Descrição</label>
            <textarea id="view-desc"></textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="vertical">
      <div class="section-fit">
        <span>Galeria de Vídeos</span>
        <div class="section h-450">
          <div class="field">
            <label for="gallery-of-videos-preview">Preview</label>
            <input id="gallery-of-videos-preview" type="text" maxlength="500" />
            <label for="gallery-of-videos-url">URL Youtube</label>
            <input id="gallery-of-videos-url" type="text" maxlength="500" />
            <button onclick="addYoutubeVideo()" type="button"
              style="align-self: flex-end; margin-top: 10px">Adicionar</button>
          </div>
          <div id="youtube-list" class="url-list">
          </div>
        </div>
      </div>
      <div class="section-fit">
        <span>Arquitetos</span>
        <div class="section">
          <div class="field">
            <label for="architect-name">Nome</label>
            <input id="architect-name" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="architect-body">Corpo</label>
            <textarea id="architect-body"></textarea>
          </div>
          <div class="field">
            <label for="architect-image">Imagem</label>
            <input id="architect-image" type="text" maxlength="500" />
          </div>
          <button onclick="addArchitect()" type="button"
            style="align-self: flex-end; margin-top: 10px">Adicionar</button>
          <div id="architect-list" class="url-list">
          </div>
        </div>
      </div>
    </div>
    <div class="vertical">
      <div class="section-fit">
        <span>Galeria de Imagens</span>
        <div class="section">
          <div class="field">
            <label for="gallery-of-images-title">Título</label>
            <input id="gallery-of-images-title" type="text" maxlength="500" />
            <label for="gallery-of-images-url">URL Imagem</label>
            <input id="gallery-of-images-url" type="text" maxlength="500" />
            <button onclick="addImageToGallery()" type="button"
              style="align-self: flex-end; margin-top: 10px">Adicionar</button>
          </div>
          <div id="image-list" class="url-list">
          </div>
        </div>
      </div>
      <div class="section-fit">
        <span>Implantação</span>
        <div class="section">
          <div class="field">
            <label for="implantation-title">Título</label>
            <input id="implantation-title" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="implantation-image">Imagem</label>
            <input id="implantation-image" type="text" maxlength="500" />
          </div>
          <button onclick="addImplantation()" type="button"
            style="align-self: flex-end; margin-top: 10px">Adicionar</button>
          <div id="implantation-list" class="url-list">
          </div>
        </div>
      </div>
      <div class="section-fit">
        <span>Plantas</span>
        <div class="section">
          <div class="field">
            <label for="blueprint-title">Título</label>
            <input id="blueprint-title" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="blueprint-image">Imagem</label>
            <input id="blueprint-image" type="text" maxlength="500" />
          </div>
          <button onclick="addBlueprint()" type="button"
            style="align-self: flex-end; margin-top: 10px">Adicionar</button>
          <div id="blueprint-list" class="url-list">
          </div>
        </div>
      </div>
      <div class="section-fit">
        <span>Conceito</span>
        <input type="hidden" value="-1" id="concept-id" />
        <div class="section">
          <div class="field">
            <label for="concept-title">Título</label>
            <input id="concept-title" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="concept-body">Corpo</label>
            <textarea id="concept-body"></textarea>
          </div>
          <div class="field">
            <label for="concept-image">Imagem</label>
            <input id="concept-image" type="text" maxlength="500" />
          </div>
        </div>
      </div>
      <div class="section-fit">
        <span>Saiba Mais [1]</span>
        <div class="section">
          <input type="hidden" value="-1" id="more-1-id" />
          <div class="field">
            <label for="more-1-title">Título</label>
            <input id="more-1-title" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="more-1-body">Corpo</label>
            <textarea id="more-1-body"></textarea>
          </div>
          <div class="field">
            <label for="more-1-button">Botão</label>
            <input id="more-1-button" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="more-1-url">URL Botão</label>
            <input id="more-1-url" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="more-1-positon">Posição Botão</label>
            <select id="more-1-positon">
              <option value="0">Esquerda</option>
              <option value="1">Centro</option>
              <option value="2">Direita</option>
            </select>
          </div>
        </div>
      </div>
      <div class="section-fit">
        <span>Saiba Mais [2]</span>
        <input type="hidden" value="-1" id="more-2-id" />
        <div class="section">
          <div class="field">
            <label for="more-2-title">Título</label>
            <input id="more-2-title" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="more-2-body">Corpo</label>
            <textarea id="more-2-body"></textarea>
          </div>
          <div class="field">
            <label for="more-2-button">Botão</label>
            <input id="more-2-button" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="more-2-url">URL Botão</label>
            <input id="more-2-url" type="text" maxlength="500" />
          </div>
          <div class="field">
            <label for="more-2-positon">Posição Botão</label>
            <select id="more-2-positon">
              <option value="0">Esquerda</option>
              <option value="1">Centro</option>
              <option value="2">Direita</option>
            </select>
          </div>
        </div>
      </div>
      <div class="section-fit">
        <span>Diferenciais</span>
        <div class="row">
          <div class="section-fit">
            <span>Áreas - Criação</span>
            <div class="section">
              <div class="field">
                <label for="diferential">Título</label>
                <div class="field-button-wrapper">
                  <input id="area-name" type="text" maxlength="500" />
                  <button id="area-name" class="field-button" onclick="addArea()" type=" button">Adicionar</button>
                </div>
              </div>
              <div class="field">
                <label for="area-option">Área</label>
                <select id="area-option">
                  <option value="0">Selecione uma opção</option>
                </select>
              </div>
              <div class="field">
                <label for="area-title">Descrição</label>
                <input id="area-title" type="text" maxlength="500" />
              </div>
              <div class="field">
                <label for="area-image">Imagem</label>
                <input id="area-image" type="text" maxlength="500" />
              </div>
              <button onclick="addAreaItem()" type="button"
                style="align-self: flex-end; margin-top: 10px">Adicionar</button>
            </div>
          </div>
          <div class="section-fit">
            <span>Áreas - Listagem</span>
            <div class="section" style="border: none">
              <div id="area-list" class="url-list">

              </div>
            </div>
          </div>
        </div>
      </div>
      <button onclick="saveProject()" type="button" style="align-self: flex-end; margin-top: 10px">Salvar
        Projeto</button>
    </div>
  </div>
</div>
<?php
}

function editor_scripts()
{
  wp_register_script('local_jquery', plugins_url('js/jquery-3.6.0.min.js', __FILE__), array('jquery'), '3.6.0', true);
  wp_enqueue_script('local_jquery');

  wp_enqueue_style('editor-css', plugins_url('css/editor.css', __FILE__));
  wp_enqueue_script('editor-js', plugins_url('js/editor.js', __FILE__), array(), false, true);

  wp_localize_script('editor-js', 'ipAjaxVar', array(
    'ajaxurl' => admin_url('admin-ajax.php')
  ));
}
add_action('admin_enqueue_scripts', 'editor_scripts');

function removeSpaces($input)
{
  $arr = explode(" ", $input);
  return strtolower(implode('-', $arr));
}