<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/avatars.php';
include $root_path.'includes/functions/imagethumb.php';
include $root_path.$lang_path.'avatars.php';

if($user->data['user_rank'] >= USER && $config['activate_avatar'] == 1) {
	$limit = 10;
	$uploadDir		= 'gallery/avatars/';
	$typesAllowed	= explode(';', $config['avatar_allowed_types']);
	$maxWidth		= (int) $config['avatar_max_width'];
	$maxHeight		= (int) $config['avatar_max_height'];
	$maxSize		= (int) $config['avatar_max_size'];
	$maxFiles		= (int) $config['avatar_max_files'];
	$waitTime		= (int) $config['avatar_wait_time'];

	$nb = count_rows($user->data['user_id']);

	if(!empty($_FILES)) {
		if(!token::verify('upload', $config['form_expiration_time']))
			die($lang['avatars']['invalid_form']);

		if($config['max_avatars_per_user'] > 0 && $nb >= $config['max_avatars_per_user'])
			die(sprintf($lang['avatars']['too_much_avatars_sent'], $nb, $config['max_avatars_per_user']));
		
		$time = time();
		
		if($_FILES['Filedata']['error'] != 0)
			die($lang['avatars']['error_loading_file']);
		
		$tempFile	= $_FILES['Filedata']['tmp_name'];
		$nameFile	= mb_strtolower(substr($_FILES['Filedata']['name'], 0, strrpos($_FILES['Filedata']['name'], '.')), 'UTF-8');
		$extension	= strtolower(substr(strrchr($_FILES['Filedata']['name'], '.'), 1));
		$newName	= remove_spec((strlen($nameFile)>30 ? substr($nameFile, 0, 30):$nameFile), '_').'_'.$time.'_'.random_int(10).'.'.$extension;

		if(!is_dir($root_path.$uploadDir) || !is_dir($root_path.$uploadDir.'thumbnails/'))
			die($lang['avatars']['directory_not_exists']);

		if(file_exists($root_path.$uploadDir.$newName))
			die($lang['avatars']['file_already_exists']);

		if(!in_array($extension, $typesAllowed))
			die($lang['avatars']['type_not_allowed']);

		$size = getimagesize($tempFile);
		$filesize = filesize($_FILES['Filedata']['tmp_name']);

		if(!$size)
			die($lang['avatars']['invalid_picture']);

		if($filesize > $maxSize*1024*1024)
			die(sprintf($lang['avatars']['weight_limit_exceeded'], round($filesize/1048576, 1), $maxSize));

		list($width, $height) = $size;

		if($width > $maxWidth && $height > $maxHeight)
			die(sprintf($lang['avatars']['size_too_big'], $maxWidth, $maxHeight));

		if($waitTime > 0 && $maxFiles > 0) {
			$nb2 = count_files($user->data['user_id'], $waitTime, $time);
		
			if($nb2 >= $maxFiles)
				die(sprintf($lang['avatars']['file_limit_exceeded'], $nb2, $waitTime));
		}

		if(imagethumb($tempFile, $root_path.$uploadDir.'thumbnails/'.$newName, 100, true) && move_uploaded_file($tempFile, $root_path.$uploadDir.$newName))
			if(insert_rows($user->data['user_id'], $newName, $width, $height, $filesize, $size['mime'], $time, $user->data['ip']))
				die('1');
		
		die($lang['avatars']['files_not_sent']);
	}

	if($nb > 0) {
		if(!empty($_POST['sup']) && is_array($_POST['sup'])) {
			if(!token::verify('avatars_delete', $config['form_expiration_time']))
				die($lang['avatars']['invalid_form']);

			$ids = array_filter($_POST['sup'], 'is_numeric');
			$ids = array_unique($ids, SORT_NUMERIC);

			if(count($ids) == 0 || count($ids) > $limit)
				die($lang['avatars']['incorrect_ids']);

			if(delete_avatars($user->data['user_id'], $ids, $root_path.$uploadDir)) {
				token::destroy('avatars_delete');

				die($lang['avatars']['avatars_deleted']);
			}

			die($lang['avatars']['error_occurred']);
		}

		if(isset($_GET['use']) && ctype_digit($_GET['use'])) {
			(int) $_GET['use'];

			if(!token::verify('avatars_update', $config['form_expiration_time'], 'get'))
				die($lang['avatars']['invalid_form']);
			
			if($_GET['use'] == 0)
				$filename = '';
			else {
				$avatar = get_avatar($user->data['user_id'], $_GET['use']);

				if(!$avatar)
					die($lang['avatars']['avatar_not_exists']);
				
				$filename = $avatar['file_name'];
			}
			
			if(update_avatar($user->data['user_id'], $filename, $_GET['use'])) {
				$user->session_create($user->data['user_id'], $user->data['admin'], $user->data['autologin']);

				die($lang['avatars']['avatar_updated_successful']);
			}
			
			die($lang['avatars']['error_occurred']);
		}

		$nbpages = ceil($nb/$limit);
		$page	 = (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
		$offset	 = ($page-1)*$limit;
		$rows = get_rows($user->data['user_id'], $offset, $limit);
		$token = new token('avatars_delete');
		$token_update = new token('avatars_update');

		$tpl->assign(array(
			'rows' => $rows,
			'pagination' => pagination($page, $nbpages, $config['server_protocol'].$config['domain_name'].'/avatars?page=%d'),
			'token' => $token->token,
			'token_update' => $token_update->token,
			'offset' => $offset,
			'page' => $page,
			'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit
		));
	}
	
	$token_upload = new token('upload');
	
	$tpl->assign('upload', array(
		'token' => $token_upload->token,
		'extensions' => $typesAllowed
	));
	
	$tpl->assign(array(
		'nb' => $nb,
		'upload_dir' => $uploadDir
	));
}

$tpl->assign(array(
	'title' => $lang['avatars']['manage_avatars'],
	'lang_avatars' => $lang['avatars'],
	'activate_avatar' => $config['activate_avatar']
));

$tpl->draw('avatars');