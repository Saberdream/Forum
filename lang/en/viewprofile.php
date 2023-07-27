<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * topic
*/
$lang['profile'] = array (
	// template interface
	'page'						=> 'Page',
	'forum'						=> 'Forum',
	'forums'					=> 'Forums',
	'back'						=> 'Retour',
	'new'						=> 'Nouveau',
	'exact'						=> 'Exact',
	'search'					=> 'Rechercher',
	'refresh'					=> 'Rafraichir',
	'reply'						=> 'Répondre',
	'new_topic'					=> 'Nouveau sujet',
	'list_topics'				=> 'Liste des sujets',
	'alert'						=> 'Signaler',
	'alert_admin'				=> 'Avertir un administrateur',
	'modify_message'			=> 'Modifier ce message',
	'modify'					=> 'Modifier',
	'avatar'					=> 'Avatar',
	'last_modification'			=> 'Dernière modification le',
	'click_to_enlarge'			=> 'Cliquez sur l\'image pour l\'agrandir',

	// errors etc...
	'no_post'					=> 'Il n\'y a aucun message sur ce sujet.',
	'read_subject'				=> 'Lire un sujet sur le forum',
	'subject_locked'			=> 'Ce sujet est bloqué.',
	'subject_deleted'			=> 'Ce sujet est supprimé.',
	'login_required'			=> 'Vous devez être inscrit et connecté pour répondre aux sujets.',
	'not_own_message'			=> 'Vous ne pouvez modifier que vos propres messages.',
	'not_authorized_edit'		=> 'Vous n\'avez pas l\'autorisation de modifier un message sur ce forum.',
	'expired_token'				=> 'Le jeton est expiré ou incorrect.',

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
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'cancel'					=> 'Annuler',
	'check_all'					=> 'Tout cocher',

	// moderation buttons
	'restore_topic'				=> 'Restaurer ce sujet',
	'delete_topic'				=> 'Supprimer ce sujet',
	'restore_message'			=> 'Restaurer ce message',
	'delete_message'			=> 'Supprimer ce message',
	'ban_user'					=> 'Bannir cet utilisateur',
	'ban_user_temporarily'		=> 'Bannir cet utilisateur temporairement',
	'exclude'					=> 'Exclure',
	'exclude_user'				=> 'Exclure cet utilisateur',

	// posting form
	'reply_to_subject'			=> 'Répondre à ce sujet',
	'subject'					=> 'Sujet',
	'message'					=> 'Message',
	'type_subject'				=> 'Entrer le sujet',
	'message_rules'				=> 'Ne postez pas d\'insultes, évitez les majuscules, faites une recherche avant de poster pour voir si la question n\'a pas déjà été posée... Tout message d\'incitation au piratage est strictement interdit et sera puni d\'un bannissement.',
	'request_new_code'			=> 'Demander un nouveau code',
	'copy_code'					=> 'Recopier le code',
	'post'						=> 'Poster',
	'smileys_list'				=> 'Liste des smileys',
	'login_required'			=> 'Vous devez être inscrit et connecté pour répondre aux sujets.',
	'not_authorized_reply'		=> 'Vous ne pouvez pas répondre aux sujets sur ce forum.',
	'not_authorized_access'		=> 'Vous n\'avez pas l\'autorisation nécéssaire pour accéder à ce forum.',

	// subscriptions
	'already_subscribed'		=> 'Vous êtes déjà abonné à ce sujet.',
	'max_subscriptions_reached'	=> 'Vous avez atteint la limite d\'abonnements (%d), supprimez-en pour pouvoir vous abonner à nouveau.',
	'successful_subscribed'		=> 'Vous avez bien été abonné, vous serez notifié en cas de nouvelle réponse à ce sujet.',

	// side menu
	'users_connected'			=> 'Utilisateurs connectés',
);

