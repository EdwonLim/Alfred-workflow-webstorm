<?php
require_once('workflows.php');

$w = new Workflows();

$workspaces = explode(';', $w->get('workspace', 'settings.plist'));
$recents = explode(';', $w->get('recents', 'settings.plist'));
$binPath = '/usr/local/bin/wstorm';
$doSearch = false;

if (!isset($query)) {
	$query = '';
}

if (!file_exists($binPath)) {
	$w->result('error', '', 'Not Found Command "wstorm"', 'WebStorm -> Tools -> Create Command-line Launcher', "icon.png", false);
	echo $w->toxml();
	return;
}

if (strpos($query, 'add:') === 0 || strpos($query, 'rm:') === 0 || $query == 'clear' || $query == 'list') {
	return;
}

if ($query == '' || $query == ' ') {
	foreach($recents as $recent) {
		if ($recent != '') {
			$w->result($recent, $recent, substr($recent, strrpos($recent, '/') + 1), $recent, "icon.png");
		}
	}
	echo $w->toxml();
	return;
}

if ($workspaces && count($workspaces) > 0) {

	foreach($workspaces as $path) {

		if ($path && file_exists($path)) {

			$doSearch = true;

			$dir = opendir($path);

			while(($file = readdir($dir)) !== false) {
				if ($file != '.' && $file != '..' && is_dir($path.'/'.$file)) {
					if (stripos($file, $query) !== false && strpos($file, '.') !== 0) {
						$w->result($file, $path.'/'.$file, $file, $path.'/'.$file, "icon.png");
					}
				}
			}

			closedir($dir);
		}
	}

}

if (!$doSearch) {
	$w->result('workspace', '', 'Set you workspaces', 'Use "ws add:" to set your workspaces', "icon.png", false);
}

echo $w->toxml();

?>
