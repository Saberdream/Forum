<?php
$in_admin = true;
include dirname(__DIR__).'/core.php';
include dirname(__DIR__).'/includes/functions/adm/pictures-upload.php';
include dirname(__DIR__).'/includes/functions/imagethumb.php';
include dirname(__DIR__).'/'.$lang_path.'adm/pictures-upload.php';

header('Content-Type: text/html; charset=utf-8');

$root_dir		= dirname(__DIR__).'/';
$uploadDir		= 'gallery/uploads/';
$typesAllowed	= explode(';', $config['upload_allowed_types']);
$maxWidth		= (int) $config['upload_max_width'];
$maxHeight		= (int) $config['upload_max_height'];
$maxSize		= (int) $config['upload_max_size'];
$maxFiles		= (int) $config['upload_max_files'];
$waitTime		= (int) $config['upload_wait_time'];

if(!empty($_FILES)) {
	if(!token::verify('adm_pictures_upload', $config['form_expiration_time']))
		die($lang['pictures']['invalid_form']);

	$time = time();

	if($_FILES['Filedata']['error'] != 0)
		die($lang['pictures']['error_loading_file']);

	$tempFile	= $_FILES['Filedata']['tmp_name'];
	$nameFile	= mb_strtolower(substr($_FILES['Filedata']['name'], 0, strrpos($_FILES['Filedata']['name'], '.')), 'UTF-8');
	$extension	= strtolower(substr(strrchr($_FILES['Filedata']['name'], '.'), 1));
	$newName	= remove_spec((strlen($nameFile)>30 ? substr($nameFile, 0, 30):$nameFile), '_').'_'.$time.'_'.random_int(10).'.'.$extension;

	if(!is_dir($root_dir.$uploadDir) || !is_dir($root_dir.$uploadDir.'thumbnails/'))
		die($lang['pictures']['directory_not_exists']);

	if(file_exists($root_dir.$uploadDir.$newName))
		die($lang['pictures']['file_already_exists']);

	if(!in_array($extension, $typesAllowed))
		die($lang['pictures']['type_not_allowed']);

	$size = getimagesize($tempFile);
	$filesize = filesize($_FILES['Filedata']['tmp_name']);

	if(!$size)
		die($lang['pictures']['invalid_picture']);

	if($filesize > $maxSize*1024*1024)
		die(sprintf($lang['pictures']['weight_limit_exceeded'], round($filesize/1048576, 1), $maxSize));

	list($width, $height) = $size;

	if($width > $maxWidth || $height > $maxHeight)
		die(sprintf($lang['pictures']['size_too_big'], $maxWidth, $maxHeight));

	if($waitTime > 0 && $maxFiles > 0) {
		$nb = count_files($waitTime, $time);

		if($nb > $maxFiles)
			die(sprintf($lang['pictures']['file_limit_exceeded'], $nb));
	}

	if(imagethumb($tempFile, $root_dir.$uploadDir.'thumbnails/'.$newName, 100, true) && move_uploaded_file($tempFile, $root_dir.$uploadDir.$newName))
		if(insert_rows($newName, $width, $height, $filesize, $size['mime'], $time))
			die('1');

	die($lang['pictures']['files_not_sent']);
}

$token = new token('adm_pictures_upload');

$tpl->assign(array(
	'title' => $lang['pictures']['send_pictures'],
	'token' => $token->token,
	'lang_pictures' => $lang['pictures']
));

$tpl->draw('pictures-upload');