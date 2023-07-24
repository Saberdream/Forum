<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * users
*/
$lang['pm'] = array (
	'manage_users'				=> 'Gestion des utilisateurs',
	'exact'						=> 'Exact',
	'search'					=> 'Rechercher',
	'back'						=> 'Retour',
	'total'						=> 'Total ',
	'rows'						=> 'Lignes',
	'delete'					=> 'Supprimer',
	'validate'					=> 'Valider',
	'id'						=> 'Id',
	'username'					=> 'Pseudo',
	'date'						=> 'Date',
	'last'						=> 'Dernier',
	'action'					=> 'Action',
	'edit_user_informations'	=> 'Editer les informations de l\'utilisateur',
	'search_results'			=> '%d résultat(s) pour la recherche de « <strong>%s</strong> »',
	'search_no_result'			=> 'Aucun résultat pour la recherche de « <strong>%s</strong> », essayez une nouvelle fois avec des mot-clés plus précis.',
	'no_pm'						=> 'Vous n\'avez reçu aucun message, faites connaissance avec les autres utilisateurs !',
	'messages_list'				=> 'Liste des messages',
	'messages_received'			=> 'Messages reçus',
	'blacklist'					=> 'Liste noire',
	'participants'				=> 'Participants',
	'mark_read'					=> 'Marquer comme lu',
	'mark_unread'				=> 'Marquer comme non-lu',
	'new_message'				=> 'Nouveau message',
	'title'						=> 'Titre',
	'mailbox'					=> 'Boite de réception',
	'author'					=> 'Auteur',
	'not_logged_in'				=> 'Vous devez être inscrit et connecté pour accéder à cette partie du site.',

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
);

/*
 * search options
*/
$lang['search_options'] = array (
	'title'						=> 'Titre',
	'author'					=> 'Auteur',
);
