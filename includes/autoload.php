<?php
function autoload($class) {
	global $root_path;
	
	switch($class) {
		case 'RainTPL':
			include $root_path.'includes/classes/rain.tpl.class.php';
		break;
		default:
			include $root_path.'includes/classes/'.$class.'.class.php';
	}
}