<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * mod.php
*/
$lang['mod_errors'] = array(
	'not_authorized_access'			=> 'You cannot access this section.',
	'incorrect_forum_id'			=> 'Invalid forum id.',
	'forum_not_found'			=> 'Forum not found.',
	'not_moderator'			=> 'You are not a moderator of this forum.',
	'expired_token'			=> 'The token is expired or invalid.',
	'no_topic_selected'			=> 'No topic has been selected.',
	'incorrect_ids'			=> 'The IDs are incorrect.',
	'incorrect_action'			=> 'This action is incorrect.',
	'not_authorized_action'			=> 'You do not have the required permission to perform this action.',
	'max_sticky_reached'			=> 'The maximum number of pinned topics has been reached (%d).',
	'topic_not_found'			=> 'Subject deleted or incorrect id.',
	'no_topic_affected'			=> 'No topics/posts were affected by the request.',
	'action_success'			=> 'Action completed successfully, %d posts/topics affected.',
	'incorrect_topic_id'			=> 'Invalid subject id.',
	'incorrect_post_id'			=> 'Incorrect message id.',
	'incorrect_user_id'			=> 'Incorrect user id.',
	'error_occurred'			=> 'An error has occurred',
);
