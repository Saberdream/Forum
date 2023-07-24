<?php
function get_files() {
	global $root_path;

	$extensions = array('gif', 'jpg', 'png');
	$files = array();

	if($handle = opendir($root_path.'gallery/smilies/')) {
		while(($entry = readdir($handle)) !== false) {
			if(!is_dir($entry) && in_array(strtolower(substr(strrchr($entry, '.'), 1)), $extensions))
				$files[] = $entry;
		}
		
		closedir($handle);
	}

	return $files;
}

function insert_smilies($values) {
	global $dbh, $config, $lang;

	$sth = $dbh->prepare('INSERT INTO '.$config['table_prefix'].'smilies (smiley_code, smiley_filename, smiley_order) VALUES '.placeholders_multi('?', count($values), 3));
	$sth->execute(array_values($values));
	unset($sth);

	return true;
}