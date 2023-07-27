<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * banlist
*/
$lang['banlist'] = array (
	'manage_banlist'			=> 'Gestion des bannissements',
	'exact'						=> 'Exact',
	'search'					=> 'Rechercher',
	'back'						=> 'Retour',
	'total'						=> 'Total ',
	'rows'						=> 'Lignes',
	'ban'						=> 'Bannir',
	'unban'						=> 'Débannir',
	'delete'					=> 'Supprimer',
	'validate'					=> 'Valider',
	'username'					=> 'Pseudo',
	'ip'						=> 'IP',
	'date'						=> 'Date',
	'last'						=> 'Dernier',
	'email'						=> 'Email',
	'reason'					=> 'Motif',
	'action'					=> 'Action',
	'start'						=> 'Début',
	'end'						=> 'Fin',
	'edit_user_informations'	=> 'Editer les informations de l\'utilisateur',
	'search_results'			=> '%d résultat(s) pour la recherche de « <strong>%s</strong> »',
	'search_no_result'			=> 'Aucun résultat pour la recherche de « <strong>%s</strong> », essayez une nouvelle fois avec des mot-clés plus précis.',
	'no_data'					=> 'Il n\'y a aucune donnée à afficher !',
	'unban_selection'			=> 'Débannir la sélection',
	'definitive'				=> 'Définitif',
	'days'						=> 'jours',
	'remaining'					=> 'restants',
	'ended'						=> 'Terminé',

	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'ban_deleted'				=> 'Le bannissement a bien été supprimé.',
	'action_success'			=> 'L\'action a bien été effectuée sur les éléments sélectionnés.',

	// errors and form messages
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_ids'				=> 'Les ids sont incorrects.',
	'incorrect_category_id'		=> 'L\'id de la catégorie est incorrect.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'error_occurred'			=> 'Une erreur est survenue',

	// left menu and breadcrumb
	'banlist'					=> 'Bannissements',
	'avatars'					=> 'Avatars',
);

/*
 * search options
*/
$lang['search_options'] = array (
	'username'					=> 'Pseudo',
	'ip'						=> 'IP',
	'email'						=> 'Email'
);
