<?php
class MyDB extends SQLite3
{

    function __construct()
    {
        $this->open('../database/db.sqlite');
    }
}
$db = new MyDB();
if (isset($_POST['site_title'])){
	try {
		$site_title = $_POST['site_title'];
		$site_description = $_POST['site_description'];
		$admin_mail = $_POST['admin_mail'];
		$theme = $_POST['theme'];
		$start_page = $_POST['start_page'];
		$save_exec = $db->exec("UPDATE options SET site_name='".$site_title."', site_description='".$site_description."', admin_mail='".$admin_mail."', start_site='".$start_page."', theme='".$theme."'");
		echo "Gespeichert!";
	} catch (Exception $e) {
		echo $e;
	}
	
}
?>