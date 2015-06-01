<?php
require_once('workflows.php');
$w = new Workflows();
$workspaces = explode(';', $w->get('workspace', 'settings.plist'));

if ($query === 'clear') {
	$w->set('workspace', '', 'settings.plist' );
	print ' clear';
} else {
	$value = '';
	$rmPath = null;
	if (strpos($query, 'add:') === 0) {
		$path = substr($query, 4);
		if (!in_array($path, $workspaces)) {
			array_push($workspaces, $path);
		}
		print ' add '.'"'.$path.'"';
	} else if (strpos($query, 'rm:') === 0) {
		$path = substr($query, 3);
		$rmPath = $path;
		print ' remove '.'"'.$path.'"';
	} else {
		print $query;
	}
	foreach($workspaces as $p) {
		if ($p != '' && $p != $rmPath) {
			$value = $value.$p.';';
		}
	}
	$w->set('workspace', $value, 'settings.plist');
}

?>