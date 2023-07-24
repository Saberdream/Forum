<?php
$files = array(
	'./images/217.gif',
	'./images/blit.png',
	'./images/soral1.jpg',
	'./images/soral2.jpg',

);

$exists = array_filter($files, 'file_exists');

print 'files that exists: ';
print_r($exists);

if(count($exists) != count($files))
	print '<p>not the same number of files!</p>';

if(isset($_GET['unlink']))
	array_map('unlink', $files);