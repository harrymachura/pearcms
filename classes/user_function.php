<?php
class sqlite_db extends SQLite3
{
    public function __construct()
    {
        $this->open('../database/db.sqlite');
    }
}
$db = new sqlite_db();
if(isset($_POST['create_user'])){

	$username = $_POST['username'];
	$display_name = $_POST['display_name'];
	$mail = $_POST['mail'];
	$password = $_POST['password'];
	$group = $_POST['group'];
	if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		if (strlen($username) > 3) {
			if ($display_name == "") {
				$display_name = $username;
			}
			$check_exist = $db->query("SELECT EXISTS(SELECT * FROM users WHERE username = '$username')");
			$check_arr = $check_exist->fetchArray();
			if ($check_arr[0] == 0){
				$add_user = $db->exec("INSERT INTO users (username, display_name, mail, password, 'group') VALUES ('$username', '$display_name', '$mail', '$password', $group)");
				echo "0";
			} else {
				echo "3";
			}
			
		} else {
			echo "2";
		}
		
		
	} else {
		echo "1";
	}
	
}

if (isset($_POST['delete_user'])) {
	$username = $_POST['delete_user'];
	$check_exist = $db->query("SELECT EXISTS(SELECT * FROM users WHERE username = '$username')");
	$check_arr = $check_exist->fetchArray();
			if ($check_arr[0] == 1){
				$db->exec("DELETE FROM users WHERE username = '$username'");
				echo "0";
			} else {
				echo "1";
			}
}

?>