<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * alerts
*/
$lang['alerts'] = array (
	'manage_alerts'				=> 'Gestion des alertes',
	'exact'						=> 'Exact',
	'search'					=> 'Rechercher',
	'back'						=> 'Retour',
	'total'						=> 'Total ',
	'rows'						=> 'Lignes',
	'ban'						=> 'Bannir',
	'unban'						=> 'Débannir',
	'delete'					=> 'Supprimer',
	'validate'					=> 'Valider',
	'id'						=> 'Id',
	'username'					=> 'Pseudo',
	'ip'						=> 'IP',
	'date'						=> 'Date',
	'last'						=> 'Dernier',
	'author'					=> 'Auteur',
	'reason'					=> 'Motif',
	'action'					=> 'Action',
	'edit_user_informations'	=> 'Editer les informations de l\'utilisateur',
	'search_results'			=> '%d résultat(s) pour la recherche de « <strong>%s</strong> »',
	'search_no_result'			=> 'Aucun résultat pour la recherche de « <strong>%s</strong> », essayez une nouvelle fois avec des mot-clés plus précis.',
	'no_data'					=> 'Il n\'y a aucune donnée à afficher !',
	'mark_as_treated'			=> 'Marquer comme traitées',
	'go_to_alert_page'			=> 'Aller sur la page de l\'alerte',
	'view'						=> 'Voir',

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
	'incorrect_ids'				=> 'Les ids sont incorrects.',
	'incorrect_category_id'		=> 'L\'id de la catégorie est incorrect.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'error_occurred'			=> 'Une erreur est survenue',
	'files_not_deleted'			=> 'Les fichiers n\'ont pas pu être supprimés.',

	// left menu and breadcrumb
	'alerts_treated'			=> 'Alertes traitées',
	'banlist'					=> 'Bannissements',
);

/*
 * search options
*/
$lang['search_options'] = array (
	'id'						=> 'Id',
	'username'					=> 'Pseudo',
	'ip'						=> 'IP',
	'reason'					=> 'Motif'
);
