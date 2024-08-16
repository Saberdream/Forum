<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * site styles
*/
$lang['styles'] = array (
	'site_styles'				=> 'Liste des styles du site',
	'delete'					=> 'Supprimer',
	'empty_styles_cache'		=> 'Vider le cache des styles',
	'refresh_styles'			=> 'Rafraichir les styles',
	'name'						=> 'Nom',
	'directory'					=> 'Répertoire',
	'version'					=> 'Version',
	'parent_style'				=> 'Style parent',
	'author'					=> 'Auteur',
	'size'						=> 'Taille',
	'cache_size'				=> 'Taille du cache ',
	
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
	'files_not_deleted'			=> 'Les fichiers n\'ont pas pu être supprimés.',
	'styles_not_updated'		=> 'Une erreur est survenue pendant la mise à jour des styles.',
	'no_styles'					=> 'Il n\'y a aucun style.',
	'files_not_exists'			=> 'Les fichiers n\'existent pas.',
);
