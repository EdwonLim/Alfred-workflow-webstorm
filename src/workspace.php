<?php
require_once('workflows.php');
$w = new Workflows();
$workspaces = explode(';', $w->get('workspace', 'settings.plist'));

if (!isset($query)) {
	$query = '';
}

if (strpos($query, 'add:') === 0 || strpos($query, 'rm:') === 0 || $query === 'clear' || $query === 'list') {
	if (strpos($query, 'add:') === 0) {
		$path = substr($query, 4);
		$w->result('workspace', $query, 'Add path "'.$path.'" to workspaces' , '', "icon.png");
	} else if (strpos($query, 'rm:') === 0) {
		$path = substr($query, 3);
		$w->result('workspace', $query, 'Remove path "'.$path.'" from workspaces' , '', "icon.png");
	} else if ($query === 'clear') {
		$w->result('workspace', $query, 'Clear workspaces' , '', "icon.png");
	} else if ($query === 'list'){
		foreach($workspaces as $path) {
			if ($path && file_exists($path)) {
				$w->result('workspace', $path, 'Workspace: '.$path, '', "icon.png");
			}
		}
		
	}
}

echo $w->toxml();

?>