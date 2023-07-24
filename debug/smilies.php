<?php
$root_path = '../';
require $root_path.'config.php';
require $root_path.'includes/functions.php';
require $root_path.'includes/autoload.php';

spl_autoload_register('autoload');

$db = Db::getInstance();
$dbh = $db->getConnection();

$domain_name = 'forum.prog';

function strtoregex($str) {
	return '/('.preg_quote($str).')/Us';
}

$str = 'Test aaaaaaaa!!!!!!!! :) :mac: :) :Mac: :) :o)) :-(( :-))) ^^';

$search = array(
	':)' => '<img src="http://'.$domain_name.'/gallery/smilies/1.gif" />',
	':o))' => '<img src="http://'.$domain_name.'/gallery/smilies/12.gif" />',
	':-)' => '<img src="http://'.$domain_name.'/gallery/smilies/46.gif" />',
	':-)))' => '<img src="http://'.$domain_name.'/gallery/smilies/23.gif" />',
	':(' => '<img src="http://'.$domain_name.'/gallery/smilies/45.gif" />',
	':-((' => '<img src="http://'.$domain_name.'/gallery/smilies/15.gif" />',
	':mac:' => '<img src="http://'.$domain_name.'/gallery/smilies/16.gif" />',
);

$patterns = array_map('strtoregex', array_keys($search));

$replace = array(
	'<img src="http://'.$domain_name.'/gallery/smilies/1.gif" />',
	'<img src="http://'.$domain_name.'/gallery/smilies/12.gif" />',
	'<img src="http://'.$domain_name.'/gallery/smilies/46.gif" />',
	'<img src="http://'.$domain_name.'/gallery/smilies/23.gif" />',
	'<img src="http://'.$domain_name.'/gallery/smilies/45.gif" />',
	'<img src="http://'.$domain_name.'/gallery/smilies/15.gif" />',
	'<img src="http://'.$domain_name.'/gallery/smilies/16.gif" />',
);

$i = 0;

$str = preg_replace_callback($patterns,
	function($matches) use($search) {
		global $i;
		$i++;
		print $i.$matches[0];
		return $search[$matches[0]];
	},
	$str,
	-1,
	$count);

print $str;

print '<p>'.$count.'</p>';
print $i;