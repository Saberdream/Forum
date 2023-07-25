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

	if(file_put_contents(dirname(dirname(dirname(__DIR__))).'/cache/config.dat.ini', implode("\n", $data)))
		return true;

	return false;
}

function get_styles() {
	$root_dir = dirname(dirname(dirname(__DIR__))).'/styles/';
	
	$rd = scandir($root_dir);
	$styles = array();
	
	foreach($rd as $dir) {
		if(is_dir($root_dir.$dir) && $dir != '.' && $dir != '..')
			$styles[$dir] = $dir;
	}
	
	unset($dir);
	
	return $styles;
}

function get_langs() {
	$root_dir = dirname(dirname(dirname(__DIR__))).'/lang/';
	
	$rd = scandir($root_dir);
	$langs = array();
	
	foreach($rd as $dir) {
		if(is_dir($root_dir.$dir) && $dir != '.' && $dir != '..')
			$langs[$dir] = $dir;
	}
	
	unset($dir);
	
	return $langs;
}