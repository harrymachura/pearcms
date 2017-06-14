<?php
/** Erstelle alle standard Events */


//Das Plugin Event für den Seiteninhalt
event('post_content', NULL, function($text) { return $text; });

//Das Plugin Event für den Seitentitel
event('post_title', NULL, function($text) { return $text; });

//Das Plugin Event für die Beitrags Schlüsselwörter
event('post_keywords', NULL, function($text) { return $text; });

//Das Plugin Event für den footer
event('footer', NULL, function($text) { return $text; });

//Das Plugin Event für den Titel
event('title', NULL, function($text) { return $text; });

//Das Plugin Event für die Meta Daten
event('meta', NULL, function($text) { return $text; });

//Das Plugin Event für die Header Attributen
event('head_attributes', NULL, function($text) { return $text; });

//Das Plugin Event für die Header Attributen
event('meta_keywords', NULL, function($text) { return $text; });

//Das Plugin Event für die Header Attributen
event('meta_description', NULL, function($text) { return $text; });

//Das Plugin Event für die Header Attributen
event('meta_language', NULL, function($text) { return $text; });

//Das Plugin Event für das Admin Panel der Gruppe Seiten.
event('admin_panel_site_button', NULL, function($text) { return $text; });

//Das Plugin Event für das Admin Panel der Gruppe Beiträge.
event('admin_panel_post_button', NULL, function($text) { return $text; });

//Das Plugin Event für das Admin Panel der Gruppe Plugin.
event('admin_panel_plugin_button', NULL, function($text) { return $text; });

//Das Plugin Event für das Admin Panel der Gruppe Einstellungen.
event('admin_panel_setting_button', NULL, function($text) { return $text; });
?>