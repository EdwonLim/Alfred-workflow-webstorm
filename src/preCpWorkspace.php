<?php
require_once('workflows.php');
$w = new Workflows();
$workspaces = explode(';', $w->get('workspace', 'settings.plist'));

if ($query === 'clear') {
	print '';
} else if (strpos($query, 'add:') === 0) {
	$path = substr($query, 4);
	print $path;
} else if (strpos($query, 'rm:') === 0) {
	$path = substr($query, 3);
	print $path;
} else {
	print $query;
}

?>