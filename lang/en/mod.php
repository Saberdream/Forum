<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * errors messages
*/
$lang['mod_errors'] = array (
	'not_authorized_access'		=> 'Vous ne pouvez pas accéder à cette section.',
	'incorrect_forum_id'		=> 'Id du forum incorrect.',
	'forum_not_found'			=> 'Forum non trouvé.',
	'not_moderator'				=> 'Vous n\'êtes pas modérateur de ce forum.',
	'expired_token'				=> 'Le jeton est expiré ou incorrect.',
	'no_topic_selected'			=> 'Aucun sujet n\'a été sélectionné.',
	'incorrect_ids'				=> 'Les ID sont incorrects.',
	'incorrect_action'			=> 'Cette action est incorrecte.',
	'not_authorized_action'		=> 'Vous n\'avez pas l\'autorisation requise pour effectuer cette action.',
	'max_sticky_reached'		=> 'Le nombre maximal de topics épinglés est atteint (%d).',
	'topic_not_found'			=> 'Sujet effacé ou id incorrect.',
	'no_topic_affected'			=> 'Aucun sujet/message n\'a été affecté par la requête.',
	'action_success'			=> 'L\'action a bien été effectuée, %d messages/sujets affectés.',
	'incorrect_topic_id'		=> 'Id du sujet incorrect.',
	'incorrect_post_id'			=> 'Id du message incorrect.',
	'incorrect_user_id'			=> 'Id de l\'utilisateur incorrect.',
	'error_occurred'			=> 'Une erreur est survenue',
);
