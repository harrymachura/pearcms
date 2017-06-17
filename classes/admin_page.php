<?php
if (empty($_GET) and empty($_POST))
    {
        // handle post data
        date_default_timezone_set("Europe/Berlin");
        $timestamp = time();
        $datum = date("d.m.Y",$timestamp);
        echo $datum;
        //Abfrage der Nutzer ID vom Login
        $userid = $_SESSION['userid'];
         
        $result = $db->query("SELECT * FROM users WHERE id = '".$userid."'");
        $row = $result->fetchArray();
        echo "<h3>".$welcome." ".$row['username']."</h3>";
    }
?>

