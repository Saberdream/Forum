<?php
function bbcode($str) {
	$str = htmlspecialchars($str);

	$patterns = array(
		'`\[b\](.*)\[/b\]`Usi',
		'`\[i\](.*)\[/i\]`Usi',
		'`\[u\](.*)\[/u\]`Usi',
		'`\[s\](.*)\[/s\]`Usi',
		'`\[img\](https?:\/\/(.*)\.(jpg|jpeg|gif|png))\[/img\]`Usi',
		'`\[url=(.*)\](.*)\[/url\]`Usi',
		'`\[url\](.*)\[/url\]`Usi',
		'`\[email\](.*)\[/email\]`Usi',
		'`\[email=(.*)\](.*)\[/email\]`Usi',
		'`\[left\](.*)\[/left\]`Usi',
		'`\[center\](.*)\[/center\]`Usi',
		'`\[right\](.*)\[/right\]`Usi',
		'`\[justify\](.*)\[/justify\]`Usi',
		'`\[list\](.+)\[/list\]`Usi',
		'`\[list=1\](.+)\[/list\]`Usi',
		'`\[list=I\](.+)\[/list\]`Usi',
		'`\[list=disc\](.+)\[/list\]`Usi',
		'`\[list=square\](.+)\[/list\]`Usi',
		// '`\[\*\](.+)(?=(\[\*\]|\[/list\]|</ul>|</ol>))`Usi',
		'`\[\*\](.+)(\s)?(?=(\[\*\]|\[/list\]|</ul>|</ol>))`Usi',
		'`\[color=(.*)\](.*)\[/color\]`Usi',
		'`\[size=(.*)\](.*)\[/size\]`Usi',
		'`\[h1\](.*)\[/h1\]`Usi',
		'`\[h2\](.*)\[/h2\]`Usi',
		'`\[h3\](.*)\[/h3\]`Usi',
		'`\[h4\](.*)\[/h4\]`Usi',
		'`\[h5\](.*)\[/h5\]`Usi',
		'`\[kbd\](.*)\[/kbd\]`Usi',
		'`\[spoiler\](.*)\[/spoiler\]`Usi'
	);

	$output = array(
		'<strong>$1</strong>',
		'<em>$1</em>',
		'<u>$1</u>',
		'<s>$1</s>',
		'<img src="$1" class="post-image" />',
		'<a href="$1">$2</a>',
		'<a href="$1">$1</a>',
		'<a href="mailto:$1">$1</a>',
		'<a href="mailto:$1">$2</a>',
		'<span class="text-left">$1</span>',
		'<span class="text-center">$1</span>',
		'<span class="text-right">$1</span>',
		'<span class="text-justify">$1</span>',
		'<ul class="list-unstyled">$1</ul>',
		'<ol>$1</ol>',
		'<ol style="list-style-type:upper-roman;">$1</ol>',
		'<ul>$1</ul>',
		'<ul style="list-style-type:square;">$1</ul>',
		'<li>$1</li>',		
		'<span style="color:$1;">$2</span>',
		'<span style="font-size:$1;">$2</span>',
		'<h1>$1</h1>',
		'<h2>$1</h2>',
		'<h3>$1</h3>',
		'<h4>$1</h4>',
		'<h5>$1</h5>',
		'<kbd>$1</kbd>',
		'<div class="spoiler"><div class="spoiler-top"><a href="#" onclick="return(spoilerToggle(this));"></a></div><div class="spoiler-box spoiler-hidden">$1</div></div>'
	);

	$str = preg_replace($patterns, $output, $str);
	$str = preg_replace_callback('`\[code\](.*)\[/code\]`Usi', 'bbcode_code', $str);
	$str = preg_replace('`\[quote]`Usi', '<blockquote>', $str, -1, $quotes);
	$str = preg_replace('`\[/quote\]`Usi', '</blockquote>', $str, $quotes);
	$str = preg_replace_callback('`(?<=^|\s|>)(((f|ht){1}tps?://)([^\s<>"]+))`i', 'bbcode_url', $str);

	return nl2br($str);
}

function bbcode_url($match) {
	// return '<a href="'.$match[1].'" target="_blank">'.$match[1].'</a>';
	return '<a href="'.$match[1].'" target="_blank">'.$match[2].(mb_strlen($match[4], 'UTF-8')>40 ? substr($match[4], 0, 19).$match[4][19].'<span style="left:-9999em;position:absolute;letter-spacing:-1em;">'.substr($match[4], 20, -20).'</span>'.substr($match[4], -20) : $match[4]).'</a>';
}

function bbcode_code($match) {
	$matches = explode("\n", $match[1]);
	$code = array();

	foreach($matches as $line)
		$code[] = '<li>'.str_replace(array("\r", "\n"), '', $line).'</li>';

	unset($line);

	return '<pre><ol>'.implode($code).'</ol></pre>';
}

function smileys($str) {
	global $dbh, $config;
	
	$pattern = file_get_contents(dirname(dirname(__DIR__)).'/cache/smilies-pattern.dat');
	$json = json_decode(file_get_contents(dirname(dirname(__DIR__)).'/gallery/smilies/smilies.json'), true);
	$list = array();

	foreach($json as $key => $value)
		$list[$value] = $key;

	unset($key, $value);

	$str = preg_replace_callback(
		'/('.$pattern.')/Us',
		function($match) use($list, $config) {
			return '<img src="'.$config['server_protocol'].$config['domain_name'].'/gallery/smilies/'.$list[$match[0]].'" alt="'.$match[0].'" />';
		},
		$str,
		$config['post_max_smilies']);
	
	return $str;
}

/*
function parse_smilies($file) {
	if(file_exists($file))
		return parse_ini_file($file);
	
	return false;
}
*/
