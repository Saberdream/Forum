<?php
$in_admin = true;
include dirname(__DIR__).'/core.php';
include dirname(__DIR__).'/includes/functions/adm/smilies.php';
include dirname(__DIR__).'/'.$lang_path.'adm/smilies.php';

header('Content-Type: text/html; charset=utf-8');

$nb = count_rows();

if($nb > 0 && isset($_GET['action']) && isset($_GET['id'])) {
	if(!token::verify('adm_smilies_action', $config['form_expiration_time'], 'get'))
		die($lang['smilies']['invalid_form']);
	
	if(!ctype_digit($_GET['id']))
		die($lang['smilies']['incorrect_id']);
	
	$data = get_order((int) $_GET['id']);
	
	if(!$data)
		die($lang['smilies']['smiley_not_exists']);
	
	switch($_GET['action']) {
		case 'order_down' :
			if($data['smiley_order'] < $nb) {
				set_order((int) $_GET['id'], $data['smiley_order'], $data['smiley_order']+1);
				
				if(!create_json() || !create_pattern())
					die($lang['smilies']['cache_error']);
			}
			
			break;
		
		case 'order_up' :
			if($data['smiley_order'] > 1) {
				set_order((int) $_GET['id'], $data['smiley_order'], $data['smiley_order']-1);
				
				if(!create_json() || !create_pattern())
					die($lang['smilies']['cache_error']);
			}
			
			break;
		
		case 'edit' :
			if(empty($_POST['value']) || mb_strlen($_POST['value'], 'UTF-8') > 100)
				die($lang['smilies']['incorrect_name']);
			
			update_code($_POST['value'], (int) $_GET['id']);
			
			if(!create_json() || !create_pattern())
				die($lang['smilies']['cache_error']);
			
			die(display($_POST['value']));
	}

	token::destroy('adm_smilies_action');

	die(header('Location: ./'.basename(__FILE__)));
}

if(!empty($_POST['sup']) && is_array($_POST['sup']) && isset($_POST['action'])) {
	if(!token::verify('adm_smilies', $config['form_expiration_time']))
		die($lang['smilies']['invalid_form']);
	
	$ids = array_filter($_POST['sup'], 'is_numeric');
	$ids = array_unique($ids, SORT_NUMERIC);
	
	if(count($ids) == 0 || count($ids) > $nb)
		die($lang['smilies']['incorrect_ids']);
	
	switch($_POST['action']) {
		case 'set_order' :
			if(!empty($_POST['order']) && is_array($_POST['order'])) {
				$order = array_filter($_POST['order'], 'is_numeric');
				
				if(count($order) == 0 || count($order) > $nb)
					die($lang['smilies']['incorrect_ids_number']);

				foreach($order as $key => $value) {
					if(!in_array($key, $ids))
						unset($order[$key]);
				}

				unset($key, $value);

				if(count($order) > 0) {
					set_order_multiple($order);

					if(!create_json() || !create_pattern())
						die($lang['smilies']['cache_error']);
				}
			}

			break;

		case 'delete' :
			delete_rows($ids);
			
			if(!create_json() || !create_pattern())
				die($lang['smilies']['cache_error']);
	}
	
	token::destroy('adm_smilies');

	die($lang['smilies']['action_success']);
}

$tpl->assign(array(
	'title' => $lang['smilies']['manage_smilies'],
	'nb' => $nb
));

$token = new token('adm_smilies');
$token_action = new token('adm_smilies_action');

if($nb > 0) {
	$tpl->assign(array(
		'rows' => get_rows(),
		'token' => $token_action->token,
		'token2' => $token->token,
		'lang_smilies' => $lang['smilies'],
	));
}

$tpl->draw('smilies');