<?php
$verbs = explode("\r\n", file_get_contents('../verbs.txt'));
$tab = array();
foreach($verbs as $str) {
	array_push($tab, '"'.(($str[strlen($str)-1] == 'e' && strlen($str) > 3)?substr($str, 0, -1):$str).'ing"');
}
echo '[ '.implode(', ', $tab).' ]';