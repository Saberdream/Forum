<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * overall template
*/
$lang['notifications'] = array (
	'not_logged_in'				=> 'Vous devez être inscrit et connecté pour accéder à cette partie du site.',
	'no_new_notification'		=> 'Vous n\'avez aucune nouvelle notification.',
	'reset_notifications'		=> 'Réinitialiser les notifications',
	'no_notification'			=> 'Il n\'y a aucune notification à afficher.',
	'date'						=> 'Date',
	'rows'						=> 'Lignes',
	'total'						=> 'Total',
	'notification'				=> 'Notification',
	'token_expired'				=> 'Le jeton est expiré ou incorrect.',
	
	// side menu
	'notifications'				=> 'Notifications',
	'account'					=> 'Compte',
	'subscriptions'				=> 'Abonnements',
	'avatars'					=> 'Avatars'
);
