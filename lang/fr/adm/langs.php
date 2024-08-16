<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * site langs list
*/
$lang['langs'] = array (
	'site_langs'				=> 'Liste des langues du site',
	'delete'					=> 'Supprimer',
	'refresh_langs'				=> 'Rafraichir les langues',
	'lang'						=> 'Langue',
	'directory'					=> 'Répertoire',
	'size'						=> 'Taille',
	
	// left menu
	'site_configuration'		=> 'Configuration du site',
	'styles'					=> 'Styles',
	'error_logs'				=> 'Logs des erreurs',
	'langs'						=> 'Langues',
	
	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action ?',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'action_success'			=> 'L\'action a bien été effectuée.',
	
	// errors and form messages
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_ids'				=> 'Les ids sont incorrects.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'error_occurred'			=> 'Une erreur est survenue',
	'langs_not_updated'			=> 'Une erreur est survenue pendant la mise à jour des langues.',
	'langs_not_created'			=> 'Une erreur est survenue: le fichier des langues n\'a pas pu être créé.',
	'no_styles'					=> 'Il n\'y a aucune langue.',
	'files_not_exists'			=> 'Les fichiers n\'existent pas.',
);
