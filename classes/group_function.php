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
?>