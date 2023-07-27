<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * login
*/
$lang['login'] = array (
	'not_authorized'			=> 'Vous n\'êtes pas autorisé à accéder à cette partie du site',
	'connect'					=> 'Connexion',
	'connect_acp'				=> 'Connexion au panneau d\'administration',
	'page_description'			=> 'Vous pouvez choisir de créer un cookie pour activer la connexion automatique afin de ne pas devoir vous connecter à nouveau lors de votre prochaine visite.',
	'page_description_acp'		=> 'Bienvenue dans la page de connexion au panneau d\'administration. Ici vous pouvez vous connecter pour effectuer les tâches d\'administration de votre forum. Une fois connecté, vous serez redirigé vers l\'accueil du panneau d\'administration.',
	'username'					=> 'Pseudo',
	'password'					=> 'Mot de passe',
	'validate'					=> 'Valider',
	'already_connected'			=> 'Vous êtes déjà connecté.',
	'already_connected_acp'		=> 'Vous êtes déjà connecté à l\'administration.',
	'copy_code'					=> 'Recopier le code',
	'ask_new_code'				=> 'Demander un nouveau code',
	'enter_username'			=> 'Entrer le pseudo',
	'errors_occurred'			=> 'Une ou plusieurs erreurs est/sont survenue(s) ',
	'automatic_connection'		=> 'Connexion automatique',
	'account'					=> 'Mon compte',
	
	// side menu
	'users_connected'			=> 'Utilisateurs connectés',
);

/*
 * form errors
*/
$lang['form_errors'] = array(
	'enter_password'			=> 'Vous devez entrer un mot de passe.',
	'incorrect_username'		=> 'Le pseudo est incorrect.',
	'incorrect_captcha'			=> 'Le code de confirmation n\'est pas correctement rempli/est incorrect.',
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
);

/*
 * login errors
*/
$lang['login_errors'] = array(
	'invalid_username'			=> 'Le pseudo est invalide.',
	'username_not_exists'		=> 'Ce pseudo n\'existe pas.',
	'cant_connect_guest'		=> 'Vous ne pouvez pas vous connecter à un compte invité.',
	'too_many_attempts'			=> 'Vous avez fait trop de tentatives de connexion, vous devez encore attendre %d seconde(s) avant de tenter de vous connecter à nouveau.',
	'incorrect_password'		=> 'Le mot de passe du compte est incorrect.',
	'permanently_banned'		=> 'Le pseudo est banni pour le motif « %s » pour une durée définitive.',
	'temporarily_banned'		=> 'Le pseudo est banni pour le motif « %s » pour une durée de %d jour(s).',
	'session_error'				=> 'Session incorrecte ou inexistante, veuillez retenter ultérieurement.',
);
