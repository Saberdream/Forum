<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * forum edition
*/
$lang['forum_edit'] = array (
	'page_description'			=> 'Vous pouvez créer des forums sur cette page à l\'aide du formulaire. Par la suite vous pourrez paramétrer l\'ordre dans lequel les forums s\'afficheront.',
	'category'					=> 'Catégorie',
	'forum'						=> 'Forum ',
	'categories'				=> 'Catégories',
	'edit_forum'				=> 'Editer un forum',
	'save'						=> 'Sauvegarder',
	'no_category_created'		=> 'Vous n\'avez créé aucune catégorie.',

	// errors
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_id'				=> 'L\'id est incorrect.',
	'incorrect_category_id'		=> 'L\'id de la catégorie est incorrect.',
	'category_not_exists'		=> 'Cette catégorie n\'existe pas.',
	'forum_not_exists'			=> 'Ce forum n\'existe pas.',
	'error_occurred'			=> 'Une ou plusieurs erreurs est/sont survenue(s) ',

	// left menu and breadcrumb
	'smilies'					=> 'Smileys',
	'add_smilies'				=> 'Ajouter des smileys',
	'manage_smilies'			=> 'Gestion des smileys',
	'manage_forums'				=> 'Gestion des forums',

	// form success messages
	'forum_successful_edited'	=> 'Les paramètres du forum ont bien été mis à jour.',

	// form fields names
	'forum_name'				=> 'Nom du forum',
	'category'					=> 'Catégorie',
	'icon'						=> 'Icône du forum',
	'description'				=> 'Description du forum',
	'rules'						=> 'Règles du forum',
	'alerts'					=> 'Alertes',
	'moderators'				=> 'Liste des modérateurs',
	'auths'						=> 'Autorisations',
	'auth_guests'				=> 'Visiteurs',
	'auth_users'				=> 'Membres',
	'auth_moderators'			=> 'Modérateurs',
	'auth_admins'				=> 'Administrateurs',
	'auth_view'					=> 'Lire le forum',
	'auth_topic'				=> 'Créer un nouveau sujet',
	'auth_reply'				=> 'Répondre aux sujets',
	'auth_edit'					=> 'Éditer un message',
	'auth_alert'				=> 'Signaler un message',
	'auth_lock_topic'			=> 'Bloquer un sujet',
	'auth_stick_topic'			=> 'Marquer un sujet',
	'auth_delete_topic'			=> 'Supprimer un sujet',
	'auth_delete_post'			=> 'Supprimer un message',
	'auth_restore_topic'		=> 'Restaurer un sujet',
	'auth_restore_post'			=> 'Restaurer un message',
	'auth_ban'					=> 'Bannir un utilisateur',
	'closed'					=> 'Forum fermé',

	// form fields descriptions
	'icon_desc'					=> 'L\'icône doit être placée dans le répertoire "racine du forum/images/forum/", puis indiquez le lien relatif de l\'image (sous la forme "images/forum/exemple.png")',
	'description_desc'			=> 'Décrivez le forum brièvement en une ligne',
	'rules_desc'				=> 'Règles du forum se trouvant sur une page externe au forum qui seront accessibles via un lien, balises html non reconnues (mais le bbcode oui)',
	'auth_desc'					=> 'Note importante : les autorisations "restaurer un sujet" et "restaurer un message" donnent la possibilité à l\'utilisateur de voir les sujets et/ou les messages supprimés, normalement invisibles aux visiteurs.',

	// form errors
	'invalid_forum_name'		=> 'Le nom du forum est invalide (il doit comporter entre 1 et 100 caractères).',
	'incorrect_category'		=> 'La catégorie du forum est incorrecte.',
	'category_not_exists'		=> 'La catégorie du forum n\'existe pas où est invalide.',
	'invalid_icon'				=> 'L\'icône du forum est invalide.',
	'invalid_description'		=> 'La description du forum doit comporter moins de 1000 caractères.',
	'invalid_rules'				=> 'Les règles du forum doivent comporter moins de 15000 caractères.',
	'chose_if_alerts'			=> 'Vous devez choisir si vous souhaitez activer les alertes ou non.',
	'chose_if_closed'			=> 'Vous devez choisir si vous souhaitez fermer le forum ou non.',
	'invalid_moderator_name'	=> 'Le pseudo du modérateur « %s » est invalide.',
	'error_auth_view'			=> 'Seuls les visiteurs, les membres, les modérateurs ou les administrateurs peuvent lire le forum.',
	'error_auth_topic'			=> 'Seuls les membres, les modérateurs ou les administrateurs peuvent créer un nouveau sujet.',
	'error_auth_reply'			=> 'Seuls les membres, les modérateurs ou les administrateurs peuvent répondre aux sujets.',
	'error_auth_edit'			=> 'Seuls les membres, les modérateurs ou les administrateurs peuvent éditer leurs sujets/messages.',
	'error_auth_alert'			=> 'Seuls les membres, les modérateurs ou les administrateurs peuvent signaler un message.',
	'error_auth_lock_topic'		=> 'Seuls les modérateurs ou les administrateurs peuvent bloquer un sujet.',
	'error_auth_stick_topic'	=> 'Seuls les modérateurs ou les administrateurs peuvent marquer un sujet.',
	'error_auth_delete_topic'	=> 'Seuls les modérateurs ou les administrateurs peuvent supprimer un sujet ou un message.',
	'error_auth_delete_post'	=> 'Seuls les modérateurs ou les administrateurs peuvent supprimer un sujet ou un message.',
	'error_auth_restore_topic'	=> 'Seuls les modérateurs ou les administrateurs peuvent restaurer un sujet ou un message.',
	'error_auth_restore_post'	=> 'Seuls les modérateurs ou les administrateurs peuvent restaurer un sujet ou un message.',
	'error_auth_ban'			=> 'Seuls les modérateurs ou les administrateurs peuvent bannir un utilisateur.',
	'update_error'				=> 'Une erreur est survenue durant la mise à jour des informations.',
);
