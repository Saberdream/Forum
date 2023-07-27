<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * overall template
*/
$lang['bl'] = array (
	'not_logged_in'				=> 'Vous devez être inscrit et connecté pour accéder à cette partie du site.',
	'no_blacklisted_user'		=> 'Il n\'y a aucun utilisateur dans votre liste noire.',
	'date'						=> 'Date',
	'rows'						=> 'Lignes',
	'total'						=> 'Total',
	'username'					=> 'Utilisateur',
	'token_expired'				=> 'Le jeton est expiré ou incorrect.',
	'add_new_users'				=> 'Ajouter des utilisateurs à votre liste noire',
	'add'						=> 'Ajouter',
	'delete'					=> 'Supprimer',
	'delete_selection'			=> 'Supprimer la sélection',
	'incorrect_ids'				=> 'Les ids sont invalides.',
	'usernames'					=> 'Utilisateurs',
	'expired_form'				=> 'Le formulaire est expiré ou incorrect.',
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'error_occurred'			=> 'Une ou plusieurs erreurs est/sont survenue(s) ',
	
	'invalid_username'			=> 'L\'utilisateur « %s » est invalide.',
	'banned_user'				=> 'L\'utilisateur « %s » est banni.',
	'user_not_exists'			=> 'L\'utilisateur « %s » n\'existe pas.',
	'cant_add_user'				=> 'Vous ne pouvez pas ajouter l\'utilisateur « %s ».',
	'user_duplicate'			=> 'L\'utilisateur « %s » est présent deux fois ou plus dans la liste.',
	'users_not_exists'			=> 'Les utilisateurs n\'existent pas.',
	'self_username'				=> 'Vous ne pouvez pas vous ajouter vous-même à votre liste noire.',
	'already_blacklisted'		=> 'L\'utilisateur « %s »  est déjà dans votre liste noire.',
	'no_user_too_long'			=> 'Vous n\'avez pas entré d\'utilisateur ou votre liste d\'utilisateurs est trop longue.',
	'user_successful_added'		=> 'Le(s) utilisateur(s) ont bien été ajouté(s) à votre liste noire.',
	'too_many_users'			=> 'Vous avez ajouté trop d\'utilisateurs dans votre liste noire, retirez-en pour pouvoir en ajouter de nouveaux.',

	// side menu
	'mailbox'					=> 'Boite de réception',
	'blacklist'					=> 'Liste noire',
	'new_message'				=> 'Nouveau message',
	
	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'action_success'			=> 'L\'action a bien été effectuée sur les éléments sélectionnés.',
	'confirm_delete'			=> 'Êtes-vous sûr(e) de vouloir supprimer cet élément ?',
	'users_deleted'				=> 'Les utilisateurs ont bien été supprimés.',
);
