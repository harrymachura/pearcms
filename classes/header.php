

<?php

class HeadDB extends SQLite3
{

    function __construct()
    {
      include("config.php");
        $this->open($database_path);
    }
}

function get_header($str){
  $db_head = new HeadDB();
  $get_theme = $db_head->query("SELECT * FROM options WHERE id='1'");
  $theme_arr = $get_theme->fetchArray();
  $theme = $theme_arr['theme'];
  include('config.php');
  switch ($str) {
    case 'meta_tags':
      echo '<link rel="stylesheet" href="themes/'.$theme.'/css/style.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/audioplayer.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="css/videoplayer.css" type="text/css" media="screen" />
  <link rel="shortcut icon" href="themes/'.$theme.'/favicon.gif">
  <link rel="icon" type="image/png" href="themes/'.$theme.'/favicon.png" sizes="32x32">
  <link rel="apple-touch-icon" sizes="180x180" href="themes/'.$theme.'/apple-touch-icon.png">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="themes/'.$theme.'/mstile-144x144.png">
  <meta name="viewport" content="width=device-width, user-scalable=no" />';
      break;
    case 'title':
    try {
      $get_title = $db_head->query("SELECT * FROM options");
      $title = $get_title->fetchArray();
      echo $title['site_name'];
    } catch (Exception $e) {
      echo $e;
    }
      break;

    case 'description':
    try {
      $get_desc = $db_head->query("SELECT * FROM options");
      $description = $get_desc->fetchArray();
      echo $description['site_description'];
    } catch (Exception $e) {
      echo $e;
    }
      break;
    
    case 'admin_mail':
    try {
      $get_admin_mail = $db_head->query("SELECT * FROM options");
      $admin_mail = $get_admin_mail->fetchArray();
      echo $admin_mail['admin_mail'];
    } catch (Exception $e) {
      echo $e;
    }
      break;
    default:
      # code...
      break;
  }
	
	
}
?>
