<?php
// 1. copy the file from cache/xp2_bookmarks to the near this file
$cached = file_get_contents("xp2_bookmarks");
// 2. and show using your web browser this file to see the content in json!


echo cache2json(unserialize($cached));


function cache2json ($data) {
	$tmp = "[";
	for($i=1; $i < (count($data) + 1); $i++) {
		$tmp .= "{";
		$tmp .= "\"name\":\"{$data[$i][0]}\",\"search\":\"{$data[$i][1]}\",\"bot\":\"\"";
		$tmp .= "}";
		if ($i !== count($data))
			$tmp .= ",";
	}
	$tmp .= "]";
	return $tmp;
}
?>