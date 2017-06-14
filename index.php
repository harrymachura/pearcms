<?php
session_start();
require_once('include.php');
include("config.php");

set_error_handler(function($errno, $errstr, $errfile, $errline, array $errcontext) {
    // error was suppressed with the @-operator
    if (0 === error_reporting()) {
        return false;
    }

    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
});

try {
      $url = "themes/". $theme . $_SERVER['PATH_INFO'].".php";
    	include($url);
} catch (ErrorException $e) {
		if (!empty($_SERVER['PATH_INFO'])) {
			$site_name = str_replace("/", "", $_SERVER['PATH_INFO']);
			$site_arr = $db->query("SELECT * FROM pages WHERE title = '$site_name'");
			$site_= $site_arr->fetchArray();

			if ($site_['title'] = "") {
				
				echo $site_name;
				include("themes/" . $theme . "/admin.php");
			} else {
				$site = $site_['id'];
				include('page.php');
			}
		} else {
			//Show Startsite	
			$startsite_arr = $db->query("SELECT * FROM options WHERE id ='1'");
			$startsite = $startsite_arr->fetchArray();
			$site = $startsite['start_site'];		
			include('page.php');
		}
		
}

?>