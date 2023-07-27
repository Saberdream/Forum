<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * new pm form
*/
$lang['newpm'] = array (
	'error_occured'				=> 'Une erreur est survenue',
	'mailbox'					=> 'Boite de réception',
	'blacklist'					=> 'Liste noire',
	'new_message'				=> 'Nouveau message',
	'send_new_pm'				=> 'Envoyer un nouveau message',
	
	// posting form
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
	'errors_detected'			=> 'Une ou plusieurs erreurs ont été détectées ',
	'recipients'				=> 'Destinataires',
	
	// posting form errors
	'not_logged_in'				=> 'Vous n\'êtes pas connecté.',
	'poster_banned'				=> 'Vous ne pouvez pas envoyer de message car vous êtes banni.',
	'code_not_filled'			=> 'Vous devez remplir le code de confirmation.',
	'incorrect_code'			=> 'Le code de confirmation est incorrect.',
	'topic_not_filled'			=> 'Vous devez entrer un sujet.',
	'topic_too_long'			=> 'Votre sujet est trop long, il doit comporter %d caractères au maximum.',
	'message_not_filled'		=> 'Vous devez entrer un message.',
	'message_too_long'			=> 'Votre message est trop long, il doit comporter %d caractères au maximum.',
	'flood_time_pm'				=> 'Vous avez posté un sujet il y a moins de %d secondes, veuillez patienter.',
	'expired_form'				=> 'Le formulaire est expiré ou incorrect.',
	'topic_not_posted'			=> 'Une erreur est survenue, le sujet n\'a pas été envoyé.',
	'invalid_recipient_name'	=> 'Le pseudo du destinataire « %s » est invalide.',
	'banned_recipient'			=> 'Le destinataire « %s » est banni.',
	'recipient_not_exists'		=> 'Le destinataire « %s » n\'existe pas.',
	'blacklisted_recipient'		=> 'Vous êtes dans la liste noire du destinataire « %s ».',
	'cant_send_message'			=> 'Vous ne pouvez pas envoyer un message au destinataire « %s ».',
	'recipient_duplicate'		=> 'Le destinataire « %s » est présent deux fois ou plus dans la liste des destinataires.',
	'no_recipient_too_long'		=> 'Vous n\'avez pas entré de destinataire ou votre liste de destinataires est trop longue.',
	'recipients_not_exists'		=> 'Les destinataires n\'existent pas.',
	'self_username'				=> 'Vous ne pouvez pas vous envoyer un message à vous même (non mais).',
);
