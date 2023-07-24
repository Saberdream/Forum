<?php
require '../includes/functions.php';

function random($n) {
	$voyelles = array('a', 'e', 'i', 'o', 'u', 'ou', 'io','ou','ai');
	$consonnes = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm','n', 'p', 'r', 's', 't', 'v', 'w',
			'br','bl', 'cr','ch', 'dr', 'fr', 'dr', 'fr', 'fl', 'gr','gl','pr','pl','ps','st','tr','vr');
	
	$mot = '';
	$nv = count($voyelles)-1;
	$nc = count($consonnes)-1;
	for($i = 0; $i < round($n/2); ++$i)
	{
		$mot .= $voyelles[mt_rand(0,$nv)];
		$mot .= $consonnes[mt_rand(0,$nc)];
	}

	return substr($mot,0,$n);
}

echo 'Generating word...<br>';

$random = random(6);
echo 'Random word generated : '.$random.'<br>Encrypting...<br>Crypted word : '.encrypt($random).'<br>Generating cookie...<br>';
$login = random(8);
$c = 'login:'.$login.'|'.encrypt($random);
echo '<input type="text" value="'.$c.'" size="100" onclick="this.select();" readonly /><br>Cookie matched success : ';

if(isset($_GET['cookie']) && preg_match('/^login:([a-zA-Z0-9\-]{3,15})\|(.*)$/', $_GET['cookie'], $logs)) {
	echo '<b>true</b><br>Username : <b>'.$logs[1].'</b><br>Password : <b>'.$logs[2].'</b>';
}
else echo '<b>false</b>';