<?php
$in_admin = true;
include dirname(__DIR__).'/core.php';
include dirname(__DIR__).'/includes/functions/adm/user-edit.php';
include dirname(__DIR__).'/includes/timezones.php';
include dirname(__DIR__).'/includes/languages.php';
include dirname(__DIR__).'/'.$lang_path.'adm/user-edit.php';

header('Content-Type: text/html; charset=utf-8');

if(!isset($_GET['id']) || !ctype_digit($_GET['id']))
	die($lang['user_edit']['incorrect_user_id']);

$data = get_user((int) $_GET['id']);

if(isset($data['user_id'])) {
	$array_data = array('password', 'email', 'ip', 'time', 'last', 'rank', 'sex', 'birthday', 'sign', 'desc', 'posts', 'country', 'style', 'lang', 'timezone');
	$ranks = array(USER => 'user', MODERATOR => 'moderator', ADMIN => 'administrator');
	$sexes = array('m' => 'Male', 'f' => 'Female');
	$langs = array();
	$styles = get_styles();
	
	foreach($ranks as $key => $value)
		$ranks[$key] = isset($lang['user_edit_ranks'][$key]) ? $lang['user_edit_ranks'][$key] : $value;
	
	unset($key, $value);
	
	foreach($sexes as $key => $value)
		$sexes[$key] = isset($lang['user_edit_sexes'][$key]) ? $lang['user_edit_sexes'][$key] : $value;

	unset($key, $value);

	foreach($accepted_langs as $value)
		$langs[$value] = isset($languages[$value]) ? $languages[$value] : $value;

	unset($value);

	if(!empty($_POST['data']) && is_array($_POST['data'])) {
		$error = array();
		$post_data = $_POST['data'];

		if(token::verify('adm_user_edit', $config['form_expiration_time'])) {
			$values = array();

			foreach($_POST['data'] as $key => $value) {
				if(!empty($key) && in_array($key, $array_data)) {
					if($value == $data['user_'.$key])
						unset($_POST['data'][$key]);
					else
						$values['user_'.$key] = $value;
				}
			}

			unset($key, $value);

			if(count($values) > 0) {
				if(($data['user_rank'] == FOUNDER || ($data['user_rank'] == ADMIN && $user->data['user_id'] != $data['user_id'])) && $user->data['user_rank'] < FOUNDER)
					$error[] = $lang['user_edit']['not_authorized_to_modify'];

				if(isset($_POST['data']['password']) && (empty($_POST['data']['password']) || mb_strlen($_POST['data']['password'], 'UTF-8') > 30))
					$error[] = $lang['user_edit']['invalid_password'];

				if(isset($_POST['data']['email']) && !preg_match('/^[a-zA-Z0-9._-]{1,64}@[a-zA-Z0-9.-]{3,63}\.[a-zA-Z]{2,15}$/', $_POST['data']['email']))
					$error[] = $lang['user_edit']['invalid_email'];

				if(isset($_POST['data']['ip']) && !filter_var($_POST['data']['ip'], FILTER_VALIDATE_IP))
					$error[] = $lang['user_edit']['invalid_ip'];

				if(isset($_POST['data']['time']) && !ctype_digit($_POST['data']['time']))
					$error[] = $lang['user_edit']['invalid_registration_date'];

				if(isset($_POST['data']['last']) && !ctype_digit($_POST['data']['last']))
					$error[] = $lang['user_edit']['invalid_last_connection'];

				if(isset($_POST['data']['rank'])) {
					if(!isset($ranks[$_POST['data']['rank']]))
						$error[] = $lang['user_edit']['invalid_rank'];

					if($data['user_rank'] == FOUNDER || ($data['user_rank'] == ADMIN && $user->data['user_rank'] < FOUNDER))
						$error[] = $lang['user_edit']['not_allowed_modify_rank'];
				}

				if(!empty($_POST['data']['sex']) && !isset($sexes[$_POST['data']['sex']]))
					$error[] = $lang['user_edit']['incorrect_gender'];

				if(!empty($_POST['data']['birthday']) && !preg_match('#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#', $_POST['data']['birthday']))
					$error[] = $lang['user_edit']['invalid_birthday'];

				if(isset($_POST['data']['country']) && mb_strlen($_POST['data']['country'], 'UTF-8') > 50)
					$error[] = $lang['user_edit']['invalid_country'];

				if(isset($_POST['data']['style']) && !empty($_POST['data']['style']) && !isset($styles[$_POST['data']['style']]))
					$error[] = $lang['user_edit']['invalid_style'];

				if(isset($_POST['data']['lang']) && !empty($_POST['data']['lang']) && !isset($langs[$_POST['data']['lang']]))
					$error[] = $lang['user_edit']['invalid_lang'];
				
				if(isset($_POST['data']['timezone']) && !empty($_POST['data']['timezone']) && !isset($timezones[$_POST['data']['timezone']]))
					$error[] = $lang['user_edit']['invalid_timezone'];

				if(count($error) == 0) {
					if(update_user($data['user_id'], $values))
						$ok = $lang['user_edit']['user_informations_updated'];
					else
						$error[] = $lang['user_edit']['update_error'];
				}
			}
		}
		else
			$error[] = $lang['user_edit']['invalid_form'];

		token::destroy('adm_user_edit');
	}

	$token = new token('adm_user_edit');

	$tpl->assign('form', array(
		'error' => !empty($error) ? $error : null,
		'ok' => !empty($ok) ? $ok : null,
		'token' => $token->token,
		'ranks' => $ranks,
		'langs' => $langs,
		'styles' => $styles,
		'timezones' => $timezones,
		'sexes' => $sexes
	));

	if(isset($post_data)) {
		foreach($post_data as $key => $value) {
			if(!empty($key) && in_array($key, $array_data))
				$data['user_'.$key] = $value;
		}

		unset($key, $value);
	}

	$tpl->assign(array(
		'data' => $data
	));
}

$tpl->assign(array(
	'title' => $lang['user_edit']['edit_user'].' - '.$lang['user_edit']['manage_users'],
	'lang_user_edit' => $lang['user_edit']
));

$tpl->draw('user-edit');