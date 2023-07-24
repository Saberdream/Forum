<?php
$root_path = '../';
$in_admin = true;
include $root_path.'core.php';
include $root_path.'includes/functions/adm/categories.php';
include $root_path.$lang_path.'adm/categories.php';

header('Content-Type: text/html; charset=utf-8');

$nb = count_rows();

if($nb > 0 && isset($_GET['action']) && isset($_GET['id'])) {
	if(!token::verify('adm_cats_action', $config['form_expiration_time'], 'get'))
		die($lang['categories']['incorrect_token']);
	
	if(!ctype_digit($_GET['id']))
		die($lang['categories']['incorrect_id']);
	
	$data = get_cat((int) $_GET['id']);
	
	if(!$data)
		die($lang['categories']['category_not_exists']);
	
	switch($_GET['action']) {
		case 'order_down' :
			if($data['cat_order'] < $nb)
				set_order((int) $_GET['id'], $data['cat_order'], $data['cat_order']+1);
			
			break;
		
		case 'order_up' :
			if($data['cat_order'] > 1)
				set_order((int) $_GET['id'], $data['cat_order'], $data['cat_order']-1);
			
			break;
		
		case 'delete':
			delete_cat((int) $_GET['id']);
			
			die($lang['categories']['category_deleted']);
			
			break;
		
		case 'get-name':
			die(display($data['cat_name']));
			
			break;
		
		case 'edit':
			if(empty($_POST['value']) || mb_strlen($_POST['value'], 'UTF-8') > 100)
				die($lang['categories']['incorrect_name']);
			
			update_name($_POST['value'], (int) $_GET['id']);
			
			die('<a href="'.$config['server_protocol'].$config['domain_name'].'/adm/forums.php?cat='.intval($_GET['id']).'">'.display($_POST['value']).'</a>');
	}
	
	token::destroy('adm_cats_action');
	
	die(header('Location: ./'.basename(__FILE__)));
}

if(isset($_POST['new_category'])) {
	$error = array();

	if(!token::verify('adm_cats_new', $config['form_expiration_time'], 'post', $config['server_protocol'].$config['domain_name'].'/adm/'.basename(__FILE__)))
		$error[] = $lang['categories']['invalid_form'];

	if(empty($_POST['new_category']) || mb_strlen($_POST['new_category'], 'UTF-8') > 100)
		$error[] = $lang['categories']['invalid_category_name'];

	if(count($error) == 0) {
		insert_cat($_POST['new_category'], $nb+1);

		$nb++;
		$ok = $lang['categories']['category_success_added'];

		unset($error);
	}
	
	token::destroy('adm_cats_new');
}

$tpl->assign(array(
	'title' => $lang['categories']['manage_categories'],
	'nb' => $nb,
	'lang_categories' => $lang['categories']
));

if($nb > 0) {
	$token_action = new token('adm_cats_action');

	$tpl->assign(array(
		'rows' => get_rows(),
		'token' => $token_action->token
	));
}

$token_new = new token('adm_cats_new');

$tpl->assign('form', array(
	'ok' => !empty($ok) ? $ok : null,
	'error' => !empty($error) ? $error : null,
	'token' => $token_new->token
));

$tpl->draw('categories');