<?php
function get_config() {
	global $dbh, $config;

	$sth = $dbh->prepare('SELECT config_name, config_value, config_type, config_form_type, config_catid, config_order, cat_name, cat_order
	FROM '.$config['table_prefix'].'config
	LEFT JOIN '.$config['table_prefix'].'config_categories ON '.$config['table_prefix'].'config_categories.cat_id = '.$config['table_prefix'].'config.config_catid
	ORDER BY '.$config['table_prefix'].'config_categories.cat_order ASC, '.$config['table_prefix'].'config.config_order ASC');
	$sth->execute();
	$data = $sth->fetchAll(PDO::FETCH_UNIQUE|PDO::FETCH_ASSOC);
	unset($sth);

	return $data;
}

function update_config($values) {
	global $dbh, $config;

	$sth = $dbh->prepare('UPDATE '.$config['table_prefix'].'config SET config_value = ? WHERE config_name = ?');

	foreach($values as $key => $value)
		$sth->execute(array($value, $key));

	unset($key, $value, $sth);

	return true;
}

function write_config_file($data_config) {
	global $root_path;
	
	$data = array();
	
	foreach($data_config as $key => $value) {
		if(!isset($config_category) || (isset($config_category) && $config_category != $value['cat_key'])) {
			$data[] = '['.$value['cat_key'].']';
			$config_category = $value['cat_key'];
		}
		
		switch($value['config_type']) {
			case 'b':
				$data[] = $key.'='.intval($value['config_value']);

				break;

			case 'd':
				$data[] = $key.'='.intval($value['config_value']);

				break;

			case 's':
				$data[] = $key.'="'.str_replace('"', '\"', $value['config_value']).'"';
		}
	}
	
	unset($key, $value);

	if(file_put_contents($root_path.'cache/config.dat.ini', implode("\n", $data)))
		return true;

	return false;
}

function get_styles() {
	global $root_path;
	
	$rd = scandir($root_path.'styles/');
	$styles = array();
	
	foreach($rd as $dir) {
		if(is_dir($root_path.'styles/'.$dir) && $dir != '.' && $dir != '..')
			$styles[$dir] = $dir;
	}
	
	unset($dir);
	
	return $styles;
}

function get_langs() {
	global $root_path;
	
	$rd = scandir($root_path.'lang/');
	$langs = array();
	
	foreach($rd as $dir) {
		if(is_dir($root_path.'lang/'.$dir) && $dir != '.' && $dir != '..')
			$langs[$dir] = $dir;
	}
	
	unset($dir);
	
	return $langs;
}