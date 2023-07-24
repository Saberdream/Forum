<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * viewpm
*/
$lang['viewpm'] = array (
	// template interface
	'page'						=> 'Page',
	'refresh'					=> 'Rafraichir',
	'reply'						=> 'Répondre',
	'avatar'					=> 'Avatar',
	'click_to_enlarge'			=> 'Cliquez sur l\'image pour l\'agrandir',
	'show'						=> 'Afficher',
	'hide'						=> 'Masquer',
	'preview'					=> 'Aperçu',
	'read_message'				=> 'Lire un message',
	'read_private_message'		=> 'Lire un message privé',
	'reply_to_message'			=> 'Répondre à un message',
	'participants'				=> 'Participants',
	'participants_list'			=> '%d participants ',
	'message_author'			=> 'Auteur de la discussion ',
	'add_participants'			=> 'Ajouter des participants',
	'add'						=> 'Ajouter',

	// errors etc...
	'no_post'					=> 'Il n\'y a aucun message dans cette discussion.',
	'login_required'			=> 'Vous devez être inscrit et connecté pour répondre aux sujets.',
	'not_own_message'			=> 'Vous ne pouvez modifier que vos propres messages.',
	'not_authorized_edit'		=> 'Vous n\'avez pas l\'autorisation de modifier un message sur ce forum.',
	'expired_token'				=> 'Le jeton est expiré ou incorrect.',
	'not_logged_in'				=> 'Vous n\'êtes pas connecté.',
	'poster_banned'				=> 'Vous ne pouvez pas envoyer de message car vous êtes banni.',
	'code_not_filled'			=> 'Vous devez remplir le code de confirmation.',
	'incorrect_code'			=> 'Le code de confirmation est incorrect.',

	// moderation actions
	'alert'						=> 'Alerte',
	'action'					=> 'Action',
	'delete'					=> 'Supprimer',
	'close_discussion'			=> 'Fermer la discussion',
	'validate'					=> 'Valider',
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'cancel'					=> 'Annuler',
	'check_all'					=> 'Tout cocher',
	'successful_closed'			=> 'La discussion a bien été fermée.',

	// moderation buttons
	'exclude'					=> 'Exclure',
	'exclude_user'				=> 'Exclure cet utilisateur',
	'user_correctly_excluded'	=> 'L\'utilisateur a bien été exclu de la discussion.',
	'action_success'			=> 'L\'action a bien été effectuée sur les éléments sélectionnés.',
	'error_occurred'			=> 'Une erreur est survenue.',

	// posting form
	'reply_to_subject'			=> 'Répondre à ce sujet',
	'subject'					=> 'Sujet',
	'message'					=> 'Message',
	'type_subject'				=> 'Entrer le sujet',
	'type_message'				=> 'Entrez le message',
	'request_new_code'			=> 'Demander un nouveau code',
	'copy_code'					=> 'Recopier le code',
	'post'						=> 'Poster',
	'smileys_list'				=> 'Liste des smileys',
	'login_required'			=> 'Vous devez être inscrit et connecté pour répondre aux sujets.',
	'not_authorized_reply'		=> 'Vous ne pouvez pas répondre aux sujets sur ce forum.',
	'not_authorized_access'		=> 'Vous n\'avez pas l\'autorisation nécéssaire pour accéder à cette partie du site.',
	'pm_closed'					=> 'Cette discussion est fermée.',
	'incorrect_code'			=> 'Le code de confirmation est incorrect.',
	'message_not_filled'		=> 'Vous devez entrer un message.',
	'message_too_long'			=> 'Votre message est trop long, il doit comporter %d caractères au maximum.',
	'flood_time_message'		=> 'Vous avez posté un message il y a moins de %d secondes, veuillez patienter.',
	'expired_form'				=> 'Le formulaire est expiré ou incorrect.',
	'errors_detected'			=> 'Une ou plusieurs erreurs ont été détectées ',
	'message_not_posted'		=> 'Le message n\'a pas été envoyé, veuillez retenter.',

	// add new users form
	'invalid_username'			=> 'Le pseudo « %s » est invalide.',
	'banned_user'				=> 'L\'utilisateur « %s » est banni.',
	'user_not_exists'			=> 'L\'utilisateur « %s » n\'existe pas.',
	'blacklisted_user'			=> 'Vous êtes dans la liste noire de l\'utilisateur « %s ».',
	'cant_add_user'				=> 'Vous ne pouvez pas ajouter l\'utilisateur « %s ».',
	'user_already_in'			=> 'L\'utilisateur « %s » est déjà présent dans la discussion.',
	'user_duplicate'			=> 'L\'utilisateur « %s » est présent deux fois ou plus dans la liste entrée.',
	'no_user_too_long'			=> 'Vous n\'avez pas entré d\'utilisateur ou votre liste d\'utilisateurs est trop longue.',
	'self_username'				=> 'Vous ne pouvez pas vous envoyer un message à vous même (non mais).',
	'users_successful_added'	=> 'Les utilisateurs ont bien été ajoutés à la discussion.',

	// side menu
	'mailbox'					=> 'Boite de réception',
	'blacklist'					=> 'Liste noire',
	'new_message'				=> 'Nouveau message',
);

/*
 * date
*/
$lang['date'] = array(
	'format'					=> 'j F Y à H:i:s'
);

$lang['days'] = array(
	'January'					=> 'janvier',
	'February'					=> 'février',
	'March'						=> 'mars',
	'April'						=> 'avril',
	'May'						=> 'mai',
	'June'						=> 'juin',
	'July'						=> 'juillet',
	'August'					=> 'août',
	'September'					=> 'septembre',
	'October'					=> 'octobre',
	'November'					=> 'novembre',
	'December'					=> 'décembre'
);
