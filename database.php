<?php

//to fake the database. Be between classes and JSON Files


	// for BOOKMARK
	function databaseBookmarkNameFile() {
		require 'config.php';
		return $bookmarks_file;
	}

	function databaseBookmarkFullFile() {
		require 'config.php';
		return $folder_json_files .  databaseBookmarkNameFile();
	}

	function saveBookmarkList($bookmarks) {
		$file = fopen(databaseBookmarkFullFile(), "w");
		fwrite($file, json_encode($bookmarks));
		fclose($file);
	}

	function readBookmarkFile() {
		return json_decode(haveBookmarkJSONfile(), true);
	}

	function haveBookmarkJSONfile() {
		return file_get_contents(databaseBookmarkFullFile());
	}


	// for BOT
	function databaseBotNameFile() {
		require 'config.php'; //else require_once do nothing
		return $bot_file;
	}

	function databaseBotFullFile() {
		require 'config.php';
		return $folder_json_files .  databaseBotNameFile();
	}

	function saveBotList($bots) {
		$file = fopen(databaseBotFullFile(), "w");
		fwrite($file, json_encode($bots));
		fclose($file);
	}

	function readBotFile() {
		return json_decode(haveBotJSONfile(), true);
	}

	function haveBotJSONfile() {
		return file_get_contents(databaseBotFullFile());
	}
?>