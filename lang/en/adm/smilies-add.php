<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * config
*/
$lang['smilies'] = array (
	'page_description'			=> 'Vous pouvez ajouter plusieurs smileys simultanément en cochant ceux que vous souhaitez ajouter.',
	'smiley'					=> 'Smiley',
	'code'						=> 'Code',
	'name'						=> 'Nom',
	'order'						=> 'Ordre',
	'save'						=> 'Sauvegarder',
	'no_file'					=> 'Il n\'y a aucun fichier à afficher.',

	// left menu and breadcrumb
	'smilies'					=> 'Smileys',
	'add_smilies'				=> 'Ajouter des smileys',
	'manage_smilies'			=> 'Gestion des smileys',
	'manage_forums'				=> 'Gestion des forums',

	// errors
	'error_occurred'			=> 'Une erreur est survenue',
	'errors_occurred'			=> 'Une ou plusieurs erreurs est/sont survenue(s) ',
	
	// form success messages
	'smilies_success_added'		=> 'Les smileys %s ont bien été ajoutés.',
	'smiley_success_added'		=> 'Le smiley a bien été ajouté.',

	// form errors
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'cache_error'				=> 'Une erreur est survenue pendant la mise en cache des fichiers.',
	'incorrect_order'			=> 'Le fichier %s n\'a pas pu être ajouté car l\'ordre indiqué est incorrect.',
	'no_code'					=> 'Le fichier %s n\'a pas pu être ajouté car il n\'y a aucun code associé.',
	'code_already_exists'		=> 'Le fichier %s n\'a pas pu être ajouté car le code existe déjà.',
	'file_not_exists'			=> 'Le fichier %s n\'existe pas.',
);
