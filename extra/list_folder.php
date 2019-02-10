<!DOCTYPE html>
<html>
	<head>
		<title>Index of XDCC List</title>
	</head>
	<body>
	<h1>Index XDCC List</h1>
	<?php
	$path = ".";

	$dir = new DirectoryIterator($path);
	echo "<ul>";
	foreach ($dir as $fileinfo) {
		if ($fileinfo->isDir() && !$fileinfo->isDot()) {
			echo "<li><a href=\"" . urlencode($fileinfo->getFilename()) . "/\">{$fileinfo->getFilename()}/</a></li>";
		}
	}
	echo "</ul>";
	?>
	</body>
</html>