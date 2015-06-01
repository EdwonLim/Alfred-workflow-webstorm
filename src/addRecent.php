<?php
	
require_once('workflows.php');

$w = new Workflows();

$recents = explode(';', $w->get('recents', 'settings.plist'));

$data = $query.';';

$index = 0;

foreach($recents as $recent) {
	if ($index < 10 && $recent != '' && $recent != $query) {
		$data = $data.$recent.';';
	}
	$index += 1;
}

$w->set('recents', $data, 'settings.plist');
