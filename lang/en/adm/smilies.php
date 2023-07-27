<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * config
*/
$lang['smilies'] = array (
	'page_description'			=> 'Sur cette page vous pouvez supprimer des smileys et paramétrer l\'ordre dans lequel ils s\'afficheront.',
	'smiley'					=> 'Smiley',
	'code'						=> 'Code',
	'name'						=> 'Nom',
	'organise'					=> 'Organiser',
	'order'						=> 'Ordre',
	'edit_code'					=> 'Editer le code',
	'action'					=> 'Action',
	'validate'					=> 'Valider',
	'modify_order'				=> 'Modifier l\'ordre',
	'remove'					=> 'Supprimer',
	'no_smiley'					=> 'Il n\'y a aucun smiley à afficher.',

	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'cancel'					=> 'Annuler',
	'alert'						=> 'Alerte',
	'smiley_deleted'			=> 'Le smiley a bien été supprimée.',
	'action_success'			=> 'L\'action a bien été effectuée sur les éléments sélectionnés.',

	// left menu and breadcrumb
	'smilies'					=> 'Smileys',
	'add_smilies'				=> 'Ajouter des smileys',
	'manage_smilies'			=> 'Gestion des smileys',
	'manage_forums'				=> 'Gestion des forums',

	// errors
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_id'				=> 'Id incorrect.',
	'incorrect_ids'				=> 'Ids incorrects.',
	'incorrect_ids_number'		=> 'Le nombre d\'ids est incorrect.',
	'smiley_not_exists'			=> 'Ce smiley n\'existe pas',
	'incorrect_name'			=> '<span class="text-danger">Le code est vide ou trop long</span>',
	'cache_error'				=> 'Une erreur est survenue pendant la mise en cache des fichiers.',
	'error_occured'				=> 'Une erreur est survenue',
);
