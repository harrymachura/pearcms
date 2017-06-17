<?php
function event($event, $value = NULL, $callback = NULL)
{
    static $events;

    if($callback !== NULL)
    {
        if($callback)
        {
            $events[$event][] = $callback;
        }
        else
        {
            unset($events[$event]);
        }
    }
    elseif(isset($events[$event]))
    {
        foreach($events[$event] as $function)
        {
            $value = call_user_func($function, $value);
        }
        return $value;
    }
}
include('events.php');
$dirHandle = dir("plugins");
 
// Verzeichnis Datei für Datei lesen
while (($f = $dirHandle->read()) != false) {
   // Nur ausgeben, wenn nicht . oder ..
    if ($f != "." && $f != ".."){
        // Wenn es sich um ein Verzeichnis handelt
        if (!is_dir("files/".$f)){
            //Überprüfe ob das Plugin aktiviert ist
            $check_plugin = $db->query("SELECT * FROM plugins WHERE name = '$f'");
            $check_arr = $check_plugin->fetchArray();
                //Wenn das Plugin aktiviert ist dann schließe es mit ein.
            if ($check_arr['active'] == 0) {
                include('plugins/'.$f."/plugin.php");
            }
            
        }
    }
}
// Verzeichnis wieder schließen
$dirHandle->close();
?>