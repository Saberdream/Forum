<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * categories
*/
$lang['categories'] = array (
	'page_description'			=> 'Vous pouvez créer des catégories pour classer et regrouper vos forums. Vous pouvez paramétrer l\'ordre dans lequel les catégories s\'afficheront.',
	'categories'				=> 'Catégories',
	'add'						=> 'Ajouter',
	'new_category_name'			=> 'Nom de la nouvelle catégorie',
	'add_new_category'			=> 'Ajouter une nouvelle catégorie',
	'no_category'				=> 'Il n\'y a aucune catégorie à afficher.',
	'name'						=> 'Nom',
	'order'						=> 'Ordre',
	'action'					=> 'Action',
	'modify_title'				=> 'Modifier le titre',
	'enter_newforum_name'		=> 'Entrez le nom du nouveau forum ici',
	'enter_newcategory_name'	=> 'Entrez le nom de la nouvelle catégorie ici',
	'manage_categories'			=> 'Gestion des catégories',
	'edit_category'				=> 'Editer la catégorie',
	'delete_category'			=> 'Supprimer la catégorie',

	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'confirm_delete'			=> 'Êtes-vous sûr(e) de vouloir supprimer cet élément ?',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'category_deleted'			=> 'La catégorie a bien été supprimée.',

	// errors
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_id'				=> 'L\'id est incorrect.',
	'incorrect_category_id'		=> 'L\'id de la catégorie est incorrect.',
	'category_not_exists'		=> 'Cette catégorie n\'existe pas.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'incorrect_name'			=> '<span class="text-danger">Le nom est vide ou trop long.</p>',
	'invalid_category_name'		=> 'Le nom de la catégorie est invalide.',
	'error_occured'				=> 'Une erreur est survenue',
	'errors_occurred'			=> 'Une ou plusieurs erreurs est/sont survenue(s) ',

	// left menu and breadcrumb
	'smilies'					=> 'Smileys',
	'add_smilies'				=> 'Ajouter des smileys',
	'manage_smilies'			=> 'Gestion des smileys',
	'manage_forums'				=> 'Gestion des forums',

	// form success messages
	'category_success_added'	=> 'La catégorie a bien été ajoutée.',
);
