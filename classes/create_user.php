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
			$add_user = $db->exec("INSERT INTO users (username, display_name, mail, password, 'group') VALUES ('$username', '$display_name', '$mail', '$password', $group)");
			echo "0";
		} else {
			echo "2";
		}
		
		
	} else {
		echo "1";
	}
	
}

?>