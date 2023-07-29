<?php
function get_styles() {
	$root_dir = dirname(dirname(dirname(__DIR__))).'/styles/';
	$rd = scandir($root_dir);
	$styles = array();

	foreach($rd as $dir) {
		if(is_dir($root_dir.$dir) && $dir != '.' && $dir != '..') {
			if(file_exists($root_dir.$dir.'/style.cfg')) {
				$styles[$dir] = parse_ini_file($root_dir.$dir.'/style.cfg');
				$styles[$dir]['size'] = getFolderSize($root_dir.$dir);
			}
		}
	}

	unset($dir);

	return $styles;
}

function getFolderSize($dir) {
    $size = 0;

    foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each)
        $size += is_file($each) ? filesize($each) : getFolderSize($each);

	unset($each);

    return $size;
}

function getSize($size) {
	if($size < 1024) {
		$size = $size.' Bytes';
	}
	elseif($size < 1048576 && $size > 1023) {
		$size = round($size/1024, 1).' KB';
	}
	elseif($size < 1073741824 && $size > 1048575) {
		$size = round($size/1048576, 1).' MB';
	}
	else {
		$size = round($size/1073741824, 1).' GB';
	}

	return $size;
}