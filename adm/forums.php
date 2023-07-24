<?php
$root_path = '../';
$in_admin = true;
include $root_path.'core.php';
include $root_path.'includes/functions/adm/forums.php';
include $root_path.$lang_path.'adm/forums.php';

header('Content-Type: text/html; charset=utf-8');

if(!isset($_GET['cat']) || !ctype_digit($_GET['cat']))
	die($lang['forums']['incorrect_category_id']);

$cat = get_cat((int) $_GET['cat']);

if(!$cat)
	die($lang['forums']['category_not_exists']);

$nb = count_rows((int) $_GET['cat']);

if($nb > 0 && isset($_GET['action']) && isset($_GET['id'])) {
	if(!token::verify('adm_forums_action', $config['form_expiration_time'], 'get'))
		die($lang['forums']['incorrect_token']);
	
	if(!ctype_digit($_GET['id']))
		die($lang['forums']['incorrect_id']);
	
	$data = get_forum((int) $_GET['id']);

	if(!$data)
		die($lang['forums']['forum_not_exists']);
	
	switch($_GET['action']) {
		case 'order_down' :
			if($data['forum_order'] < $nb)
				set_order((int) $_GET['id'], (int) $_GET['cat'], $data['forum_order'], $data['forum_order']+1);
			
			break;
		
		case 'order_up' :
			if($data['forum_order'] > 1)
				set_order((int) $_GET['id'], (int) $_GET['cat'], $data['forum_order'], $data['forum_order']-1);
			
			break;
		
		case 'delete':
			delete_forum((int) $_GET['id']);
			
			die($lang['forums']['forum_deleted']);
			
			break;
		
		case 'synchronize' :
			synchronize((int) $_GET['id']);

			die($lang['forums']['forum_synchronized']);
	}
	
	token::destroy('adm_forums_action');
	
	die(header('Location: ./'.basename(__FILE__).'?cat='.intval($_GET['cat'])));
}

if(isset($_POST['new_forum'])) {
	$error = array();
	
	if(!token::verify('adm_forums_new', $config['form_expiration_time'], 'post', $config['server_protocol'].$config['domain_name'].'/adm/'.basename(__FILE__).'?cat='.intval($_GET['cat'])))
		$error[] = $lang['forums']['invalid_form'];
	
	if(empty($_POST['new_forum']) || mb_strlen($_POST['new_forum'], 'UTF-8') > 100)
		$error[] = $lang['forums']['invalid_forum_name'];
		
	if(count($error) == 0) {
		insert_forum((int) $_GET['cat'], $_POST['new_forum'], $nb+1);
		
		$nb++;
		$ok = $lang['forums']['forum_success_added'];
		
		unset($error);
	}
	
	token::destroy('adm_forums_new');
}

$tpl->assign(array(
	'title' => $lang['forums']['manage_forums'],
	'nb' => $nb,
	'cat' => $cat,
	'lang_forums' => $lang['forums']
));

if($nb > 0) {
	$token_action = new token('adm_forums_action');

	$tpl->assign(array(
		'rows' => get_rows((int) $_GET['cat']),
		'token' => $token_action->token
	));
}

$token_new = new token('adm_forums_new');

$tpl->assign('form', array(
	'ok' => !empty($ok) ? $ok : null,
	'error' => !empty($error) ? $error : null,
	'token' => $token_new->token
));

$tpl->draw('forums');