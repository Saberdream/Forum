<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * forum
*/
$lang['forum'] = array (
	// template interface
	'page'						=> 'Page',
	'forum'						=> 'Forum',
	'forums'					=> 'Forums',
	'back'						=> 'Retour',
	'new'						=> 'Nouveau',
	'exact'						=> 'Exact',
	'search'					=> 'Rechercher',
	'refresh'					=> 'Rafraichir',
	'click_to_enlarge'			=> 'Cliquez sur l\'image pour l\'agrandir',
	'access_last_page'			=> 'Accéder à la dernière page',
	
	// moderation actions
	'action'					=> 'Action',
	'delete'					=> 'Supprimer',
	'lock'						=> 'Bloquer',
	'unlock'					=> 'Débloquer',
	'stick'						=> 'Marquer',
	'unstick'					=> 'Démarquer',
	'restore'					=> 'Restaurer',
	'ban'						=> 'Bannir',
	'ban_temporarily'			=> 'Bannir temporairement',
	'validate'					=> 'Valider',
	'alert'						=> 'Alerte',
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'cancel'					=> 'Annuler',
	'show'						=> 'Afficher',
	'hide'						=> 'Masquer',
	'preview'					=> 'Aperçu',
	
	// topics list
	'author'					=> 'Auteur',
	'number'					=> 'Nb.',
	'last'						=> 'Dernier',
	
	// moderation buttons
	'restore_topic'				=> 'Restaurer ce sujet',
	'delete_topic'				=> 'Supprimer ce sujet',
	'ban_user'					=> 'Bannir cet utilisateur',
	'ban_user_temporarily'		=> 'Bannir cet utilisateur temporairement',
	
	// posting form
	'create_new_topic'			=> 'Créer un nouveau sujet',
	'subject'					=> 'Sujet',
	'message'					=> 'Message',
	'type_subject'				=> 'Entrer le sujet',
	'message_rules'				=> 'Ne postez pas d\'insultes, évitez les majuscules, faites une recherche avant de poster pour voir si la question n\'a pas déjà été posée... Tout message d\'incitation au piratage est strictement interdit et sera puni d\'un bannissement.',
	'request_new_code'			=> 'Demander un nouveau code',
	'copy_code'					=> 'Recopier le code',
	'post'						=> 'Poster',
	'smileys_list'				=> 'Liste des smileys',
	'login_required'			=> 'Vous devez être inscrit et connecté pour pouvoir poster un nouveau sujet.',
	'not_authorized_new_topic'	=> 'Vous ne pouvez pas poster un nouveau sujet sur ce forum.',
	'not_authorized_access'		=> 'Vous n\'avez pas l\'autorisation nécéssaire pour accéder à ce forum.',
	
	// searching results
	'search_results'			=> 'Résultats de la recherche pour « %s ».',
	'search_nb_results'			=> '%d résultat(s) pour la recherche de « %s ».',
	'search_no_results'			=> 'Aucun résultat pour la recherche de « %s ».',
	'no_topic'					=> 'Il n\'y a aucun sujet sur ce forum.',
	
	// side menu
	'users_connected'			=> 'Utilisateurs connectés',
	'all_forums'				=> 'Tous les forums',
	'followed_topics'			=> 'Sujets suivis',
);

/*
 * search options
*/
$lang['search_options'] = array (
	'topic_name'				=> 'Topic',
	'username'					=> 'Auteur'
);
