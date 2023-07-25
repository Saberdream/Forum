<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * site errors logs
*/
$lang['logs'] = array (
	'site_errors'				=> 'Liste des erreurs du site',
	'total'						=> 'Total ',
	'rows'						=> 'Lignes',
	'delete'					=> 'Supprimer',
	'delete_selection'			=> 'Supprimer la sélection',
	'name'						=> 'Nom',
	'date'						=> 'Date',
	'text'						=> 'Texte',
	'size'						=> 'Taille',
	
	// left menu
	'site_configuration'		=> 'Configuration du site',
	'styles'					=> 'Styles',
	'error_logs'				=> 'Logs des erreurs',
	
	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'action_success'			=> 'L\'action a bien été effectuée sur les éléments sélectionnés.',
	
	// errors and form messages
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_ids'				=> 'Les ids sont incorrects.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'error_occurred'			=> 'Une erreur est survenue',
	'files_not_deleted'			=> 'Les fichiers n\'ont pas pu être supprimés.',
	'no_files'					=> 'Il n\'y a aucun fichier à afficher.',
	'files_not_exists'			=> 'Les fichiers n\'existent pas.',
);
