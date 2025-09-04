<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * posting
*/
$lang['posting'] = array (
	'incorrect_forum_id'		=> 'Id du forum incorrect.',
	'forum_not_found'			=> 'Forum non trouvé.',
	'not_authorized_access'		=> 'Vous n\'avez pas l\'autorisation nécéssaire pour accéder à ce forum.',
	'error_occured'				=> 'Une erreur est survenue',
	'replied_followed_topic'	=> '« %s » a répondu à un sujet auquel vous êtes abonné',
	
	// template interface
	'forum'						=> 'Forum',
	'forums'					=> 'Forums',
	
	// posting form
	'create_new_topic'			=> 'Créer un nouveau sujet',
	'reply_topic'				=> 'Répondre à un sujet',
	'subject'					=> 'Sujet',
	'message'					=> 'Message',
	'type_subject'				=> 'Entrer le sujet',
	'message_rules'				=> 'Ne postez pas d\'insultes, évitez les majuscules, faites une recherche avant de poster pour voir si la question n\'a pas déjà été posée... Tout message d\'incitation au piratage est strictement interdit et sera puni d\'un bannissement.',
	'request_new_code'			=> 'Demander un nouveau code',
	'copy_code'					=> 'Recopier le code',
	'post'						=> 'Poster',
	'preview'					=> 'Aperçu',
	'back'						=> 'Retour',
	'smileys_list'				=> 'Liste des smileys',
	'not_authorized_newtopic'	=> 'Vous ne pouvez pas poster un nouveau sujet sur ce forum.',
	'not_authorized_reply'		=> 'Vous ne pouvez pas répondre aux sujets sur ce forum.',
	'not_authorized_access'		=> 'Vous n\'avez pas l\'autorisation nécéssaire pour accéder à ce forum.',
	'errors_detected'			=> 'Une ou plusieurs erreurs ont été détectées ',
	
	// posting form errors
	'not_logged_in'				=> 'Vous n\'êtes pas connecté.',
	'not_authorized_new_topic'	=> 'Vous n\'avez pas l\'autorisation nécessaire pour créer un sujet sur ce forum.',
	'code_not_filled'			=> 'Vous devez remplir le code de confirmation.',
	'incorrect_code'			=> 'Le code de confirmation est incorrect.',
	'topic_not_filled'			=> 'Vous devez entrer un sujet.',
	'topic_too_long'			=> 'Votre sujet est trop long, il doit comporter %d caractères au maximum.',
	'message_not_filled'		=> 'Vous devez entrer un message.',
	'message_too_long'			=> 'Votre message est trop long, il doit comporter %d caractères au maximum.',
	'flood_time_topic'			=> 'Vous avez posté un sujet il y a moins de %d secondes, veuillez patienter.',
	'flood_time_message'		=> 'Vous avez posté un message il y a moins de %d secondes, veuillez patienter.',
	'not_authorized_reply'		=> 'Vous n\'avez pas l\'autorisation nécessaire pour répondre aux sujets sur ce forum.',
	'invalid_topic_id'			=> 'L\'id du sujet est invalide.',
	'invalid_post_id'			=> 'L\'id du message est invalide.',
	'expired_form'				=> 'Le formulaire est expiré ou incorrect.',
	'topic_not_found'			=> 'Ce sujet n\'existe pas ou plus.',
	'topic_deleted'				=> 'Ce sujet n\'existe pas ou a été supprimé.',
	'not_authorized_edit'		=> 'Vous n\'avez pas l\'autorisation nécessaire pour modifier un message.',
	'topic_locked'				=> 'Ce sujet est bloqué.',
	'message_not_found'			=> 'Ce message n\'existe pas ou plus.',
	'edit_own_message'			=> 'Vous ne pouvez modifier que vos propres messages.',
	'flood_time_edit'			=> 'Vous devez attendre %d seconde(s) avant de pouvoir éditer à nouveau un message.',
	'topic_not_posted'			=> 'Une erreur est survenue, le sujet n\'a pas été envoyé.',
	'message_not_posted'		=> 'Une erreur est survenue, le message n\'a pas été envoyé.',
	'poster_banned'				=> 'Vous ne pouvez pas envoyer de message car vous êtes banni.',
	'forum_closed'				=> 'Ce forum est fermé.',
	
	// side menu
	'users_connected'			=> 'Utilisateurs connectés',
	'all_forums'				=> 'Tous les forums',
	'followed_topics'			=> 'Sujets suivis',
	
	// redirection
	'topic_posted_successful'	=> 'Le sujet a bien été posté, vous allez être redirigé dans %d secondes, ou <a href="%s">cliquez ici</a> pour être redirigé immédiatement.',
	'message_posted_successful'	=> 'Le message a bien été posté, vous allez être redirigé dans %d secondes, ou <a href="%s">cliquez ici</a> pour être redirigé immédiatement.',
);
