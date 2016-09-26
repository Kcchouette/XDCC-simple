<?php

//to fake the database. Be between classes and JSON Files
//getJson($bots);

	function saveBotList($bots) {
		$file = fopen("data.json", "w");
		fwrite($file, json_encode($bots));
		fclose($file);
	}

	function readBotFile() {
		return json_decode(haveJSONfile(), true);
	}

	function haveJSONfile() {
		return file_get_contents("data.json");
	}
	

?>
