<?php
$root_path = '../';
$in_admin = true;
include $root_path.'core.php';
include $root_path.'includes/functions/adm/configuration.php';
include $root_path.'includes/timezones.php';
include $root_path.$lang_path.'adm/configuration.php';

$styles = get_styles();
$langs = get_langs();

$auth_ranks = array(
	GUEST => !empty($lang['config']['visitors']) ? $lang['config']['visitors'] : 'Visitors',
	USER => !empty($lang['config']['members']) ? $lang['config']['members'] : 'Members',
	MODERATOR => !empty($lang['config']['moderators']) ? $lang['config']['moderators'] : 'Moderators',
	ADMIN => !empty($lang['config']['administrators']) ? $lang['config']['administrators'] : 'Administrators'
);

$options = array(
	'default_style'	=> $styles,
	'default_lang'	=> $langs,
	'default_timezone' => $timezones,
	'articles_auth_read' => $auth_ranks,
	'articles_auth_new' => $auth_ranks,
	'articles_auth_edit' => $auth_ranks,
	'articles_auth_delete' => $auth_ranks
);

$data = get_config();

// replace config categories keys and config keys by their translated names, and put config options to the config fields
foreach($data as $key => $value) {
	$data[$key]['cat_key'] = $data[$key]['cat_name'];
	$data[$key]['cat_name'] = !empty($lang['cat_names'][$value['cat_name']]) ? $lang['cat_names'][$value['cat_name']] : $value['cat_name'];
	$data[$key]['config_name'] = !empty($lang['config_names'][$key]) ? $lang['config_names'][$key] : $key;
	
	if(isset($lang['config_descriptions'][$key]))
	$data[$key]['config_description'] = $lang['config_descriptions'][$key];
	
	if(isset($options[$key]))
		$data[$key]['config_options'] = $options[$key];
}

unset($key, $value);

if(!empty($_POST['config']) && is_array($_POST['config'])) {
	$error = array();
	$post_data = $_POST['config'];
	
	if(!token::verify('adm_config', $config['form_expiration_time'], 'post', $config['server_protocol'].$config['domain_name'].'/adm/configuration.php'))
		$error[] = $lang['config']['invalid_form'];
	else {
		$values = array();

		foreach($_POST['config'] as $key => $value) {
			if(isset($data[$key])) {
				if($value == $data[$key]['config_value'])
					unset($_POST['config'][$key]);
				else {
					switch($data[$key]['config_type']) {
						case 'b':
							if($value == 1 || $value == 0)
								$values = array_merge($values, array($key => intval($value)));

							break;

						case 'd':
							if(ctype_digit($value))
								$values = array_merge($values, array($key => $value));
							
							break;

						case 's':
							if(mb_strlen($value, 'UTF-8') < 60000)
								$values = array_merge($values, array($key => $value));
							
							break;

						default:
							unset($_POST['config'][$key]);
					}
					
					if(!isset($values[$key]))
						$error[] = !empty($lang['config_errors'][$key]) ? $lang['config_errors'][$key] : 'Error with the key "'.$key.'"';
				}
			}
		}

		unset($key, $value);

		if(count($values) > 0) {
			if(isset($_POST['config']['avatar_allowed_types']) && !preg_match('/^[a-z;]+$/', $_POST['config']['avatar_allowed_types']))
				$error[] = $lang['config_errors']['avatar_allowed_types'];
			
			if(isset($_POST['config']['domain_name']) && (empty($_POST['config']['domain_name']) || !preg_match('/^[a-z0-9\/\.-]{1,100}\.[a-z]{2,15}$/', $_POST['config']['domain_name'])))
				$error[] = $lang['config_errors']['domain_name'];
			
			if(isset($_POST['config']['default_style']) && (empty($_POST['config']['default_style']) || !in_array($_POST['config']['default_style'], $styles)))
				$error[] = $lang['config_errors']['default_style'];
			
			if(isset($_POST['config']['default_lang']) && (empty($_POST['config']['default_lang']) || !in_array($_POST['config']['default_lang'], $langs)))
				$error[] = $lang['config_errors']['default_lang'];
			
			if(isset($_POST['config']['default_timezone']) && !isset($timezones[$_POST['config']['default_timezone']]))
				$error[] = $lang['config_errors']['default_timezone'];
			
			if(isset($_POST['config']['server_protocol']) && !preg_match('#^https?://$#', $_POST['config']['server_protocol']))
				$error[] = $lang['config_errors']['server_protocol'];
			
			if(isset($_POST['config']['site_closed_reason']) && mb_strlen($_POST['config']['site_closed_reason'], 'UTF-8') > 1000)
				$error[] = $lang['config_errors']['site_closed_reason'];
			
			if(isset($_POST['config']['site_mail']) && (empty($_POST['config']['site_mail']) || !preg_match('/^[a-zA-Z0-9._-]{1,64}@[a-zA-Z0-9.-]{3,63}\.[a-zA-Z]{2,15}$/', $_POST['config']['site_mail'])))
				$error[] = $lang['config_errors']['site_mail'];
			
			if(isset($_POST['config']['site_name']) && (empty($_POST['config']['site_name']) || mb_strlen($_POST['config']['site_name'], 'UTF-8') > 100))
				$error[] = $lang['config_errors']['site_name'];
			
			if(isset($_POST['config']['site_description']) && !empty($_POST['config']['site_description']) && mb_strlen($_POST['config']['site_description'], 'UTF-8') > 1000)
				$error[] = $lang['config_errors']['site_description'];
			
			if(isset($_POST['config']['cookies_name']) && !preg_match('/^\w{1,1000}$/', $_POST['config']['cookies_name']))
				$error[] = $lang['config_errors']['cookies_name'];
			
			if(isset($_POST['config']['upload_allowed_types']) && !preg_match('/^[a-z;]+$/', $_POST['config']['upload_allowed_types']))
				$error[] = $lang['config_errors']['upload_allowed_types'];
			
			if(isset($_POST['config']['welcome_message']) && mb_strlen($_POST['config']['welcome_message'], 'UTF-8') > 10000)
				$error[] = $lang['config_errors']['welcome_message'];
			
			if(isset($_POST['config']['smtp_server']) && !preg_match('/^[a-zA-Z0-9.-]{3,63}\.[a-zA-Z]{2,15}$/', $_POST['config']['smtp_server']))
				$error[] = $lang['config_errors']['smtp_server'];
			
			if(isset($_POST['config']['sendmail_from']) && (empty($_POST['config']['sendmail_from']) || !preg_match('/^[a-zA-Z0-9._-]{1,64}@[a-zA-Z0-9.-]{3,63}\.[a-zA-Z]{2,15}$/', $_POST['config']['sendmail_from'])))
				$error[] = $lang['config_errors']['sendmail_from'];

			if(isset($_POST['config']['articles_auth_read']) && !isset($auth_ranks[$_POST['config']['articles_auth_read']]))
				$error[] = $lang['config_errors']['articles_auth_read'];
			
			if(isset($_POST['config']['articles_auth_new']) && !isset($auth_ranks[$_POST['config']['articles_auth_new']]))
				$error[] = $lang['config_errors']['articles_auth_new'];
			
			if(isset($_POST['config']['articles_auth_edit']) && !isset($auth_ranks[$_POST['config']['articles_auth_edit']]))
				$error[] = $lang['config_errors']['articles_auth_edit'];
			
			if(isset($_POST['config']['articles_auth_delete']) && !isset($auth_ranks[$_POST['config']['articles_auth_delete']]))
				$error[] = $lang['config_errors']['articles_auth_delete'];
			
			if(count($error) == 0) {
				if(update_config($values, $data)) {
					foreach($values as $key => $value)
						$data[$key]['config_value'] = $value;
					
					unset($key, $value);
					
					if(write_config_file($data))
						$ok = $lang['config']['settings_saved'];
					else
						$error[] = $lang['config']['writing_error'];
				}
				else
					$error[] = $lang['config']['update_error'];
			}
		}
	}
	
	token::destroy('adm_config');
}

if(isset($post_data)) {
	foreach($post_data as $key => $value) {
		if(!empty($key) && isset($data[$key]))
			$data[$key]['config_value'] = $value;
	}

	unset($key, $value);
}

$tpl->assign(array(
	'title' => $lang['config']['site_configuration'],
	'config' => $data,
	'lang_config' => $lang['config']
));

$token = new token('adm_config');

$tpl->assign('form', array(
	'ok' => !empty($ok) ? $ok : null,
	'error' => !empty($error) ? $error : null,
	'token' => $token->token
));

$tpl->draw('configuration');