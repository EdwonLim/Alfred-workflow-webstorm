<?php

$path = exec('osascript getPath.applescript 2>&1 &');

if ($path) {
	$path = substr($path, 1, strlen($path) - 3);
	$query = $path;
	print $path;
}

?>