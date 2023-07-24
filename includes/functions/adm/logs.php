<?php
function get_logs() {
	global $root_path;

	$rd = scandir($root_path.'logs/');
	$logs = array();
	$i = 0;

	foreach($rd as $filename) {
		if(!is_dir($root_path.'logs/'.$filename) && $filename != '.' && $filename != '..')
			if(preg_match('/^(.+)\.txt$/', $filename)) {
				$logs[] = array('file_id' => $i, 'file_name' => $filename);
				$i++;
			}
	}

	unset($filename);

	return $logs;
}

function delete_logs($files) {
	global $root_path;
	
	if(count(array_filter($files, 'file_exists')) > 0)
		array_map('unlink', array_filter($files, 'file_exists'));

	if(count(array_filter($files, 'file_exists')) > 0)
		return false;
	
	return true;
}