<?php
$root_path = '../';
$in_admin = true;
include $root_path.'core.php';
include $root_path.'includes/functions/adm/smilies.php';
include $root_path.'includes/functions/adm/smilies-add.php';
include $root_path.$lang_path.'adm/smilies-add.php';

header('Content-Type: text/html; charset=utf-8');

$data = get_rows();
$files = get_files();
$smileys = array();

foreach($data as $key => $value)
	$smileys[$value['smiley_filename']] = $value['smiley_code'];

unset($key, $value, $data);

foreach($files as $key => $value) {
	if(!isset($smileys[$value]))
		$files[$value] = !empty($_POST['data'][$value]['code']) ? $_POST['data'][$value]['code'] : '';

	unset($files[$key]);
}

unset($key, $value);

if(!empty($_POST['data']) && is_array($_POST['data'])) {
	$error = array();

	if(token::verify('adm_smilies_add', $config['form_expiration_time'])) {
		$values = array();
		$codes = array();

		foreach($_POST['data'] as $key => $value) {
			if(isset($value['add'])) {
				if(isset($files[$key])) {
					if(!empty($value['code'])) {
						if(!in_array($value['code'], $smileys)) {
							if(isset($value['order']) && ctype_digit($value['order']) && $value['order'] > count($smileys)) {
								$values = array_merge($values, array($value['code'], $key, $value['order']));
								$codes[] = $value['code'];
							}
							else
								$error[] = sprintf($lang['smilies']['incorrect_order'], $key);
						}
						else
							$error[] = sprintf($lang['smilies']['code_already_exists'], $key);
					}
					else
						$error[] = sprintf($lang['smilies']['no_code'], $key);
				}
				else
					$error[] = sprintf($lang['smilies']['file_not_exists'], $key);
			}
		}

		unset($key, $value);

		if(count($values) > 0) {
			if(!create_json() || !create_pattern())
				$error[] = $lang['smilies']['cache_error'];
			
			if(count($error) == 0) {
				insert_smilies($values);
				
				$values = array_chunk($values, 3);
				
				foreach($values as $key => $value)
					unset($files[$value[1]]);
				
				unset($key, $value);
				
				$ok = count($codes) > 1 ? sprintf($lang['smilies']['smilies_success_added'], display(implode(', ', $codes))) : $lang['smilies']['smiley_success_added'];
				
				unset($error);
			}
		}
	}
	else
		$error[] = $lang['smilies']['invalid_form'];

	token::destroy('adm_smilies_add');
}

$tpl->assign(array(
	'title' => $lang['smilies']['manage_smilies'].' - '.$lang['smilies']['add_smilies'],
	'rows' => $files,
	'nb' => count($smileys),
	'lang_smilies' => $lang['smilies'],
));

$token = new token('adm_smilies_add');

$tpl->assign('form', array(
	'token' => $token->token,
	'ok' => !empty($ok) ? $ok : null,
	'error' => !empty($error) ? $error : null,
));

$tpl->draw('smilies-add');