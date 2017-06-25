<?php
session_start();
class MyDB extends SQLite3
{

    function __construct()
    {
        $this->open('../database/db.sqlite');
    }
}

$db = new MyDB();
function permission($str_query){
	$db = new MyDB();
	if (isset($_SESSION['userid'])){
	$userid = $_SESSION['userid'];
	$get_nam = $db->query("SELECT * FROM users WHERE id='".$userid."'");
	$arr = $get_nam->fetchArray();
	$check_per = $db->query("SELECT * FROM groups WHERE id='".$arr['group']."'");
	$per_arr = $check_per->fetchArray();
	return $per_arr[$str_query];
	} else {
		return "Error";
	}
	}

	if (isset($_POST['site_title'])){
		if (permission("edit_settings") == 1){
			include('../config.php');
			include('../language/'.$language.'.php');
		try {
			$site_title = $_POST['site_title'];
			$site_description = $_POST['site_description'];
			$admin_mail = $_POST['admin_mail'];
			$theme = $_POST['theme'];
			$start_page = $_POST['start_page'];
			$save_exec = $db->exec("UPDATE options SET site_name='".$site_title."', site_description='".$site_description."', admin_mail='".$admin_mail."', start_site='".$start_page."', theme='".$theme."'");
			echo language::saved;
		} catch (Exception $e) {
			echo $e;
		}
		} else {
			echo "Zugriff verweigert!";
		}
	}
?>