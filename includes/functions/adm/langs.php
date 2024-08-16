<?php
function get_langs_dir() {
	$root_dir = dirname(dirname(dirname(__DIR__))).'/lang/';
	
	$rd = scandir($root_dir);
	$langs = array();
	
	foreach($rd as $dir) {
		if(is_dir($root_dir.$dir) && $dir != '.' && $dir != '..')
			$langs[] = $dir;
	}
	
	unset($dir);
	
	return $langs;
}

function create_langs() {
	$root_dir = dirname(dirname(dirname(__DIR__))).'/lang/';

	if(file_put_contents($root_dir.'langs.dat', serialize(get_langs_dir())))
		return true;
	
	return false;
}