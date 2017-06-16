<?php
class sqlite_db extends SQLite3
{
    public function __construct()
    {
    	include("config.php");
        $this->open($database_path);
    }
}
$db = new sqlite_db();
//Load standard Theme
$get_theme = $db->query("SELECT * FROM options WHERE id = '1'");
$theme_arr = $get_theme->fetchArray();
$theme = $theme_arr['theme'];
?>