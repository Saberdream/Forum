<?php
function autoload($class) {
	switch($class) {
		case 'RainTPL':
			include dirname(__DIR__).'/includes/classes/rain.tpl.class.php';

			break;

		default:
			include __DIR__.'/../includes/classes/'.$class.'.class.php';
	}
}