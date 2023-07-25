<?php
function get_logs() {
	$root_dir = dirname(dirname(dirname(__DIR__))).'/logs/';
	$rd = scandir($root_dir);
	$logs = array();
	$i = 0;

	foreach($rd as $filename) {
		if(!is_dir($root_dir.$filename) && $filename != '.' && $filename != '..')
			if(preg_match('/^(.+)\.txt$/', $filename)) {
				$logs[] = array('file_id' => $i, 'file_name' => $filename);
				$i++;
			}
	}

	unset($filename);

	return $logs;
}

function delete_logs($files) {
	if(count(array_filter($files, 'file_exists')) > 0)
		array_map('unlink', array_filter($files, 'file_exists'));

	if(count(array_filter($files, 'file_exists')) > 0)
		return false;
	
	return true;
}