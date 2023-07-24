<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * date
*/
// $lang['days'] = array();
$lang['date'] = array(
	'format'					=> 'j F Y à H:i:s'
);

$lang['days'] = array(
	'January'					=> 'janvier',
	'February'					=> 'février',
	'March'						=> 'mars',
	'April'						=> 'avril',
	'May'						=> 'mai',
	'June'						=> 'juin',
	'July'						=> 'juillet',
	'August'					=> 'août',
	'September'					=> 'septembre',
	'October'					=> 'octobre',
	'November'					=> 'novembre',
	'December'					=> 'décembre'
);

function date_formatted($time) {
	global $lang;
	
	$date = date($lang['date']['format'], $time);
	$date = str_replace(array_keys($lang['days']), $lang['days'], $date);
	
	return $date;
}

$date = date('j F Y à H:i:s', time());

echo date_formatted(time());
