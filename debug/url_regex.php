<?php
function bbcode_url($match) {
	return '<a href="'.$match[1].'" target="_blank">'.$match[2].(mb_strlen($match[4], 'UTF-8')>40 ? substr($match[4], 0, 19).$match[4][19].'<span style="left:-9999em;position:absolute;letter-spacing:-1em;">'.substr($match[4], 20, -20).'</span>'.substr($match[4], -20) : $match[4]).'</a>';
}

function bbcode($str) {
	// $str = htmlspecialchars($str);
	
	// $str = preg_replace_callback('`(?<=^|\s|<|>)(((f|ht){1}tps?://)([^\s<>"]+))`i', 'bbcode_url', $str);
	
	$str = preg_replace_callback('`(?<=^|\s|>)(((f|ht){1}tps?://)([^\s<>"]+))`i', 'bbcode_url', $str);
	
	// return nl2br($str);

	return $str;
}

$text = 'https://www.duckduckgo.com/<span>https://www.google.fr/<a href="https://www.jeuxvideo.fr/<https://www.gamekult.fr/';


echo bbcode($text);