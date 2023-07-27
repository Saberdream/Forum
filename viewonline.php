<?php
include __DIR__.'/core.php';
include __DIR__.'/includes/functions/viewonline.php';
include __DIR__.'/'.$lang_path.'viewonline.php';

header('Content-Type: text/html; charset=utf-8');

$limit = 25;
$clauses = array();
$nb = count_rows($clauses);
$page = 1;

if($nb > 0) {
	$nbpages = ceil($nb/$limit);
	$page = (isset($_GET['page']) && ctype_digit($_GET['page']) && $_GET['page'] > 1 && $_GET['page'] <= $nbpages) ? $_GET['page'] : 1;
	$offset	= ($page-1)*$limit;
	$pagination = pagination($page, $nbpages, $config['server_protocol'].$config['domain_name'].'/viewonline?page=%d');
	$rows = get_rows($offset, $limit, $clauses);

	$clauses[] = 'connected_userid <> 2 AND connected_userid <> 3';
	$nb_users = count_rows($clauses);
	$nb_guests = $nb-$nb_users;

	$tpl->assign(array(
		'rows' => $rows,
		'pagination' => $pagination,
		'offset' => $offset,
		'end' => $page*$limit>sizeof($rows) ? (($page-1)*$limit)+sizeof($rows) : $page*$limit,
	));

	$lang['viewonline']['number_users_connected'] = sprintf($lang['viewonline']['number_users_connected'], $nb, $nb_users, $nb_guests);
}

$tpl->assign(array(
	'nb' => $nb,
	'lang_viewonline' => $lang['viewonline']
));

$tpl->draw('viewonline');