<?php
session_start();

echo '<!DOCTYPE html>
<html>
	<body>';

	// remove all session variables
	session_unset();

	// destroy the session
	session_destroy();

	header ('location: index.php');

	echo'</body>
</html>';

?>