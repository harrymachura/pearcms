<?php
class sqlite_db extends SQLite3
{
    public function __construct()
    {
        $this->open('../database/db.sqlite');
    }
}
$db = new sqlite_db();
if (isset($_POST['group_data'])){
	$group_id = $_POST['group_data'];
	$get_group_data = $db->query("SELECT * FROM groups WHERE id ='$group_id'");
	$data_arr = $get_group_data->fetchArray();
	//$arrayName = array('create_post' => '0', 'create_site' => '1');

	echo json_encode($data_arr);
}
if (isset($_POST['change_data'])){
	$group_id = $_POST['change_data'];
	$state = parse_state($_POST['state']);
	$id_name = $_POST['id'];
	switch ($id_name) {
		case 'create_post_cb':
			$db->exec("UPDATE groups SET create_post='$state' WHERE id = '$group_id'");
			break;

		case 'create_site_cb':
			$db->exec("UPDATE groups SET create_site='$state' WHERE id = '$group_id'");
			break;

		case 'edit_post_cb':
			$db->exec("UPDATE groups SET edit_post='$state' WHERE id = '$group_id'");
			break;

		case 'edit_site_cb':
			$db->exec("UPDATE groups SET edit_site='$state' WHERE id = '$group_id'");
			break;

		case 'edit_other_post_cb':
			$db->exec("UPDATE groups SET edit_other_posts='$state' WHERE id = '$group_id'");
			break;

		case 'edit_other_site_cb':
			$db->exec("UPDATE groups SET edit_other_sites='$state' WHERE id = '$group_id'");
			break;

		case 'change_settings_cb':
			$db->exec("UPDATE groups SET edit_settings='$state' WHERE id = '$group_id'");
			break;

		case 'show_plugins_cb':
			$db->exec("UPDATE groups SET show_plugins='$state' WHERE id = '$group_id'");
			break;

		case 'install_plugins_cb':
			$db->exec("UPDATE groups SET install_plugins='$state' WHERE id = '$group_id'");
			break;

		case 'remove_plugins_cb':
			$db->exec("UPDATE groups SET remove_plugins='$state' WHERE id = '$group_id'");
			break;

		case 'plugins_visibility_cb':
			$db->exec("UPDATE groups SET visibility_plugins='$state' WHERE id = '$group_id'");
			break;

		case 'show_users_cb':
			$db->exec("UPDATE groups SET show_users='$state' WHERE id = '$group_id'");
			break;

		case 'create_users_cb':
			$db->exec("UPDATE groups SET create_users='$state' WHERE id = '$group_id'");
			break;

		case 'remove_users_cb':
			$db->exec("UPDATE groups SET remove_users='$state' WHERE id = '$group_id'");
			break;

		case 'edit_users_cb':
			$db->exec("UPDATE groups SET edit_users='$state' WHERE id = '$group_id'");
			break;

		case 'show_groups_cb':
			$db->exec("UPDATE groups SET show_groups='$state' WHERE id = '$group_id'");
			break;

		case 'create_groups_cb':
			$db->exec("UPDATE groups SET create_groups='$state' WHERE id = '$group_id'");
			break;

		case 'remove_groups_cb':
			$db->exec("UPDATE groups SET remove_groups='$state' WHERE id = '$group_id'");
			break;

		case 'edit_groups_cb':
			$db->exec("UPDATE groups SET edit_groups='$state' WHERE id = '$group_id'");
			break;

		default:
			# code...
			break;
	}

}
function parse_state($state){
	if ($state == "true") {
		return '1';
	} else {
		return '0';
	}
}
?>