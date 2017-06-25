<?php
	function permission($str_query){
	$db = new SQLite3('database/db.sqlite');
	if (isset($_SESSION['userid'])){
	$userid = $_SESSION['userid'];
	$get_nam = $db->query("SELECT * FROM users WHERE id='".$userid."'");
	$arr = $get_nam->fetchArray();
	$check_per = $db->query("SELECT * FROM groups WHERE id='".$arr['group']."'");
	$per_arr = $check_per->fetchArray();
	return $per_arr[$str_query];
	}
	}
?>