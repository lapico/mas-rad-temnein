<?php
require('../inc/Lead.php');

session_start();

require("../inc/NewTome.php");

if (isset($_POST['tome']) && is_scalar($_POST['tome'])) {
	$user_id = $_SESSION['user_id'];
	$text = $_POST['tome'];
	$postlines = array_reverse(explode("\n", $text));

	//var_dump($postlines);

	$count = 0;

	foreach ($postlines as $key) {
		if (strlen($key) > 0 && strlen(trim($key)) > 0) {
			$tome = new NewTome(trim($key, "\n"), $user_id);
			$tome->insert_db();
			
			$count++;
		}
	}

	for ($k = 0; $k < $count; $k++) {
		$sql = 'SELECT * FROM tomes ORDER BY id DESC LIMIT '. intval($k) .',1';
		displayTomes($sql);
	}

	//unset($tome);
	unset($GLOBALS['tome']);
}
?>