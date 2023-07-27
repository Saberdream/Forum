<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * forums
*/
$lang['forums'] = array (
	'page_description'			=> 'Vous pouvez créer des forums sur cette page à l\'aide du formulaire. Par la suite vous pourrez paramétrer l\'ordre dans lequel les forums s\'afficheront.',
	'category'					=> 'Catégorie',
	'categories'				=> 'Catégories',
	'add'						=> 'Ajouter',
	'forum_name'				=> 'Nom du forum',
	'add_new_forum'				=> 'Ajouter un forum',
	'no_forum'					=> 'Il n\'y a aucun forum à afficher.',
	'name'						=> 'Nom',
	'order'						=> 'Ordre',
	'action'					=> 'Action',
	'topics'					=> 'Topics',
	'posts'						=> 'Posts',
	'modify_title'				=> 'Modifier le titre',
	'sync_forum'				=> 'Synchroniser le forum',
	'modify_parameters'			=> 'Modifier les paramètres du forum',
	'delete_forum'				=> 'Supprimer le forum',
	'enter_newforum_name'		=> 'Entrez le nom du nouveau forum ici',

	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action ?',
	'confirm_delete'			=> 'Êtes-vous sûr(e) de vouloir supprimer cet élément ?',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'forum_deleted'				=> 'Le forum a bien été supprimé.',
	'forum_synchronized'		=> 'Le forum a bien été synchronisé.',

	// errors
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_id'				=> 'L\'id est incorrect.',
	'incorrect_category_id'		=> 'L\'id de la catégorie est incorrect.',
	'category_not_exists'		=> 'Cette catégorie n\'existe pas.',
	'forum_not_exists'			=> 'Ce forum n\'existe pas.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'incorrect_name'			=> '<span class="text-danger">Le nom est vide ou trop long.</p>',
	'invalid_forum_name'		=> 'Le nom du forum est invalide.',
	'error_occured'				=> 'Une erreur est survenue',
	'errors_occurred'			=> 'Une ou plusieurs erreurs est/sont survenue(s) ',

	// left menu and breadcrumb
	'smilies'					=> 'Smileys',
	'add_smilies'				=> 'Ajouter des smileys',
	'manage_smilies'			=> 'Gestion des smileys',
	'manage_forums'				=> 'Gestion des forums',

	// form success messages
	'forum_success_added'		=> 'Le forum a bien été ajouté.',
);
