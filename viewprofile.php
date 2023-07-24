<?php
$root_path = './';
include $root_path.'core.php';
include $root_path.'includes/functions/viewprofile.php';
include $root_path.'includes/functions/bbcode.php';
include $root_path.$lang_path.'viewprofile.php';

header('Content-Type: text/html; charset=utf-8');

$error_invalid_user = $error_user_not_exists = false;

if(isset($_GET['user']) && preg_match('/^[a-z0-9-]{3,15}$/', $_GET['user'])) {
	$profile_user = get_user($_GET['user']);

	if($profile_user) {
		$ban = count_ban($profile_user['user_id']);
		
		$tpl->assign('ban', $ban);

		if($ban == 0) {
			$tpl->assign(array(
				'profile_user' => $profile_user,
				'posts_width' => posts_bar($profile_user['user_posts'])
			));
		}
	}
	else
		$error_user_not_exists = true;
}
else
	$error_invalid_user = true;

$tpl->assign(array(
	'error_invalid_user' => $error_invalid_user,
	'error_user_not_exists' => $error_user_not_exists,
	'lang_profile' => $lang['profile']
));

$tpl->draw('viewprofile');