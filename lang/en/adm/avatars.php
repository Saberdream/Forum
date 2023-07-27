<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * pictures
*/
$lang['avatars'] = array (
	'manage_avatars'			=> 'Gestion des avatars',
	'avatars'					=> 'Avatars',
	'exact'						=> 'Exact',
	'search'					=> 'Rechercher',
	'back'						=> 'Retour',
	'total'						=> 'Total ',
	'rows'						=> 'Lignes',
	'delete'					=> 'Supprimer',
	'id'						=> 'Id',
	'username'					=> 'Pseudo',
	'thumbnail'					=> 'Miniature',
	'size'						=> 'Taille',
	'weight'					=> 'Poids',
	'date'						=> 'Date',
	'search_results'			=> '%d résultat(s) pour la recherche de « <strong>%s</strong> »',
	'search_no_result'			=> 'Aucun résultat pour la recherche de « <strong>%s</strong> », essayez une nouvelle fois avec des mot-clés plus précis.',
	'no_data'					=> 'Il n\'y a aucune donnée à afficher !',
	'delete_selection'			=> 'Supprimer la sélection',

	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'action_success'			=> 'L\'action a bien été effectuée sur les éléments sélectionnés.',
	'confirm_delete'			=> 'Êtes-vous sûr(e) de vouloir supprimer cet élément ?',
	'click_to_enlarge'			=> 'Cliquez sur l\'image pour l\'agrandir',

	// errors and form messages
	'incorrect_ids'				=> 'Les ids sont incorrects.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'error_occurred'			=> 'Une erreur est survenue',
	'files_not_deleted'			=> 'Les fichiers n\'ont pas pu être supprimés.',

	// left menu and breadcrumb
	'banlist'					=> 'Bannissements',
);

/*
 * search options
*/
$lang['search_options'] = array (
	'username'					=> 'Pseudo',
);
