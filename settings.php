<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/settings.php';
include __DIR__.'/includes/timezones.php';
include __DIR__.'/includes/languages.php';
include __DIR__.'/'.$lang_path.'settings.php';

header('Content-Type: text/html; charset=utf-8');

if($user->data['user_rank'] < USER)
	die(header('Location: ./login'));

$data = get_user($user->data['user_id']);
$sexes = array('m' => 'Male', 'f' => 'Female');
$styles = get_styles();
$langs = array();

$days = $months = $years = array();
for($i = 1; $i <= 31; $i++) $days[] = $i<10 ? (string) '0'.$i : $i;
for($i = 1; $i <= 12; $i++) $months[] = $i<10 ? (string) '0'.$i : $i;
for($i = 1950; $i <= (date('Y', time())-5); $i++) $years[] = (string) $i;

foreach($sexes as $key => $value)
	$sexes[$key] = isset($lang['settings_sexes'][$key]) ? $lang['settings_sexes'][$key] : $value;

unset($key, $value);

foreach($accepted_langs as $value)
	$langs[$value] = isset($languages[$value]) ? $languages[$value] : $value;

unset($value);

$lang['settings']['invalid_signature'] = sprintf($lang['settings']['invalid_signature'], (int) $config['sign_max_size']);
$lang['settings']['invalid_description'] = sprintf($lang['settings']['invalid_description'], (int) $config['desc_max_size']);
$lang['settings']['invalid_password'] = sprintf($lang['settings']['invalid_password'], 30);
$lang['settings']['country_desc'] = sprintf($lang['settings']['country_desc'], 50);

$array_data = array('password', 'email', 'sex', 'birthday', 'sign', 'desc', 'posts', 'country', 'style', 'lang', 'timezone');

if(!empty($_POST['data']) && is_array($_POST['data'])) {
	$error = array();
	$post_data = $_POST['data'];

	if(!token::verify('form_settings', $config['form_expiration_time'], 'post', $config['server_protocol'].$config['domain_name'].'/settings'))
		$error[] = $lang['settings']['invalid_form'];
	else {
		if(isset($_POST['data']['birth_d']) && isset($_POST['data']['birth_m']) && isset($_POST['data']['birth_y'])) {
			if(!empty($_POST['data']['birth_d']) || !empty($_POST['data']['birth_m']) || !empty($_POST['data']['birth_y']))
				$birthday = $_POST['data']['birth_d'].'/'.$_POST['data']['birth_m'].'/'.$_POST['data']['birth_y'];
			else
				$birthday = '';
		}

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

		if(isset($values['user_password']) && empty($values['user_password']))
			unset($values['user_password']);

		if(isset($birthday) && $birthday != $data['user_birthday'])
			$values['user_birthday'] = $birthday;

		if(count($values) > 0) {
			if(!captcha::check())
				$error[] = $lang['settings']['incorrect_captcha'];

			if(isset($birthday) && !empty($birthday)) {
				if(!preg_match('#^[0-9]{2}/[0-9]{2}/[0-9]{4}$#', $birthday))
					$error[] = $lang['settings']['invalid_birthday_format'];
				else {
					$array_birth = explode('/', $birthday);
					
					if(!in_array($array_birth[0], $days) || !in_array($array_birth[1], $months) || !in_array($array_birth[2], $years))
						$error[] = $lang['settings']['invalid_birthday'];
				}
			}
			
			if(!empty($_POST['data']['sex']) && !isset($sexes[$_POST['data']['sex']]))
				$error[] = $lang['settings']['invalid_sex'];
			
			if(!empty($_POST['data']['password']) && mb_strlen($_POST['data']['password'], 'UTF-8') > 30)
				$error[] = $lang['settings']['invalid_password'];
			
			if(!empty($_POST['data']['email']) && !preg_match('/^[a-zA-Z0-9._-]{1,64}@[a-zA-Z0-9.-]{3,63}\.[a-zA-Z]{2,15}$/', $_POST['data']['email']))
				$error[] = $lang['settings']['invalid_email'].': '.$_POST['data']['email'];
			elseif(!empty($values['user_email']))
				$values['user_email'] = strtolower($values['user_email']);
			
			if(!empty($_POST['data']['sign']) && mb_strlen($_POST['data']['sign'], 'UTF-8') > $config['sign_max_size'])
				$error[] = $lang['settings']['invalid_signature'];
			
			if(!empty($_POST['data']['desc']) && mb_strlen($_POST['data']['desc'], 'UTF-8') > $config['desc_max_size'])
				$error[] = $lang['settings']['invalid_description'];
			
			if(isset($_POST['data']['country']) && mb_strlen($_POST['data']['country'], 'UTF-8') > 50)
				$error[] = $lang['settings']['invalid_country'];

			if(isset($_POST['data']['style']) && !empty($_POST['data']['style']) && !isset($styles[$_POST['data']['style']]))
				$error[] = $lang['settings']['invalid_style'];

			if(isset($_POST['data']['lang']) && !empty($_POST['data']['lang']) && !isset($langs[$_POST['data']['lang']]))
				$error[] = $lang['settings']['invalid_lang'];
			
			if(isset($_POST['data']['timezone']) && !empty($_POST['data']['timezone']) && !isset($timezones[$_POST['data']['timezone']]))
				$error[] = $lang['settings']['invalid_timezone'];
			
			if(count($error) == 0) {
				if(update_user($user->data['user_id'], $values)) {
					$userid = $user->data['user_id'];
					$admin = $user->data['admin'] == 1 ? true : false;

					$user->session_create($userid, $admin);

					$ok = $lang['settings']['informations_updated'];
				}
				else
					$error[] = $lang['settings']['update_error'];
			}
		}
	}

	token::destroy('form_settings');
}

if(!empty($data['user_birthday'])) {
	$birth = explode('/', $data['user_birthday']);
	$data['user_birth_d'] = !empty($birth[0]) ? $birth[0] : '';
	$data['user_birth_m'] = !empty($birth[1]) ? $birth[1] : '';
	$data['user_birth_y'] = !empty($birth[2]) ? $birth[2] : '';
}

$token = new token('form_settings');

$tpl->assign('form', array(
	'error' => !empty($error) ? $error : null,
	'ok' => !empty($ok) ? $ok : null,
	'token' => $token->token,
	'styles' => $styles,
	'langs' => $langs,
	'timezones' => $timezones,
	'sexes' => $sexes,
	'birth_days' => $days,
	'birth_months' => $months,
	'birth_years' => $years
));

if(isset($post_data)) {
	foreach($post_data as $key => $value) {
		if(!empty($key) && in_array($key, $array_data))
			$data['user_'.$key] = $value;
		elseif($key == 'birth_d' || $key == 'birth_m' || $key == 'birth_y')
			$data['user_'.$key] = $value;
	}

	unset($key, $value);
}

$tpl->assign(array(
	'data' => $data,
	'lang_settings' => $lang['settings']
));

$tpl->draw('settings');