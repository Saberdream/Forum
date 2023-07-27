<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * pictures
*/
$lang['pictures'] = array (
	'manage_pictures'			=> 'Gestion des images',
	'manage_files'				=> 'Gestion des fichiers',
	'send'						=> 'Envoyer',
	'send_pictures'				=> 'Envoyer des images',
	'delete_selection'			=> 'Supprimer la sélection',
	'select_files'				=> 'Sélectionner les fichiers',
	'reset'						=> 'Remettre à zéro',

	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'user_deleted'				=> 'L\'utilisateur a bien été supprimé.',
	'action_success'			=> 'L\'action a bien été effectuée sur les éléments sélectionnés.',

	// errors and form messages
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'error_occurred'			=> 'Une erreur est survenue',
	'files_not_deleted'			=> 'Les fichiers n\'ont pas pu être supprimés.',
	'error_loading_file'		=> 'Erreur dans le chargement du fichier.',
	'file_already_exists'		=> 'Le fichier existe déjà.',
	'type_not_allowed'			=> 'Type de fichier non autorisé.',
	'invalid_picture'			=> 'Le fichier n\'est pas une image valide.',
	'weight_limit_exceeded'		=> 'Le poids de l\'image (%d Mo) dépasse le poids maximum autorisé (%d Mo).',
	'size_too_big'				=> 'Les dimensions de l\'image sont trop grandes (max %dx%dpx).',
	'file_limit_exceeded'		=> 'Vous avez déjà envoyé %d fichiers, vous devez patienter avant d\'en envoyer à nouveau.',
	'files_not_sent'			=> 'Les fichiers n\'ont pas pu être envoyés.',
	'directory_not_exists'		=> 'Le dossier d\'upload n\'existe pas.',

	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'confirm_delete'			=> 'Êtes-vous sûr(e) de vouloir supprimer cet élément ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'validate'					=> 'Valider',
	'cancel'					=> 'Annuler',
	'modify'					=> 'Modifier',
	'check_all'					=> 'Tout cocher',
	'click_to_enlarge'			=> 'Cliquez sur l\'image pour l\'agrandir',
);
