<?php
function search($query) {
		class MyDBsearch extends SQLite3
	{
	    function __construct()
	    {
	        $this->open('database/db.sqlite');
	    }
	}

	echo '<p style="font-size: 26px; text-align: center;">'.language::youhave.' „<b>'.$query.'</b>“ '.language::searched.'.</p>';
	$db = new MyDBsearch();
	$result = $db->query("SELECT * FROM posts WHERE keywords LIKE '%$query%' OR title LIKE '%$query%' OR content LIKE '%$query%' OR author LIKE '%$query%' OR date LIKE '%$query%'  ORDER BY id DESC");
  	while ($row = $result->fetchArray()) {
    echo '<div class="note_list">
  <table>
    <tr><td style="font-size: 26px; padding: 5px; background-color: rgba(255,255,255,0.4); border-top-left-radius: 5px; border-top-right-radius: 5px;"><a href="posts?id='. $row['id'] .'"><b>'. $row['title'] .'</b></a></td></tr>
    <tr><td style="background-color: rgba(255,255,255,0.3); text-align: center;">Author '. $row['author'] .' / '. $row['date'] .'</td></tr>
    <tr><td style="background-color: rgba(255,255,255,0.1); padding: 15px;">'. nl2br(strip_tags(codesnippet(substr($row['content'], 0, 500))))  .'...</td></tr>
    <tr><td style="text-align: center; font-size: 12px; background-color: rgba(255,255,255,0.3);">Keywords: '. $row['keywords'] .'</td></tr>
  </table>
</div><br>';
}
	
	echo '<a href="'. $_SERVER['HTTP_REFERER'] .'">'.language::back.'</a>';
}
?>