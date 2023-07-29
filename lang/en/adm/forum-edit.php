<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * forum-edit.php
*/
$lang['forum_edit'] = array(
	'page_description'			=> 'You can create forums on this page using the form. ',
	'category'			=> 'Category',
	'forum'			=> 'Forum',
	'categories'			=> 'Categories',
	'edit_forum'			=> 'Edit forum',
	'save'			=> 'To safeguard',
	'no_category_created'			=> 'You have not created any categories.',
	'invalid_form'			=> 'The form is invalid, please try again.',
	'incorrect_id'			=> 'The id is incorrect.',
	'incorrect_category_id'			=> 'The category id is incorrect.',
	'category_not_exists'			=> 'Forum category does not exist or is invalid.',
	'forum_not_exists'			=> 'This forum does not exist.',
	'error_occurred'			=> 'One or more errors occurred',
	'smilies'			=> 'smilies',
	'add_smilies'			=> 'Add smilies',
	'manage_smilies'			=> 'Management of smileys',
	'manage_forums'			=> 'Forum management',
	'forum_successful_edited'			=> 'The forum settings have been successfully updated.',
	'forum_name'			=> 'Forum name',
	'icon'			=> 'Forum icon',
	'description'			=> 'Forum Description',
	'rules'			=> 'Forum Rules',
	'alerts'			=> 'Alerts',
	'moderators'			=> 'List of moderators',
	'auths'			=> 'Permissions',
	'auth_guests'			=> 'Visitors',
	'auth_users'			=> 'Members',
	'auth_moderators'			=> 'Moderators',
	'auth_admins'			=> 'Administrators',
	'auth_view'			=> 'Read the forum',
	'auth_topic'			=> 'Create a new topic',
	'auth_reply'			=> 'Reply to topics',
	'auth_edit'			=> 'Edit a message',
	'auth_alert'			=> 'Report a message',
	'auth_lock_topic'			=> 'Block a topic',
	'auth_stick_topic'			=> 'Mark a topic',
	'auth_delete_topic'			=> 'Delete topic',
	'auth_delete_post'			=> 'Delete a message',
	'auth_restore_topic'			=> 'Restore a topic',
	'auth_restore_post'			=> 'Restore a message',
	'auth_ban'			=> 'Ban a user',
	'closed'			=> 'Forum closed',
	'icon_desc'			=> 'The icon should be placed in the "forum root/images/forum/" directory, then provide the relative link of the image (in the form "images/forum/example.png")',
	'description_desc'			=> 'Briefly describe the forum in one line',
	'rules_desc'			=> 'Forum rules located on a page external to the forum which will be accessible via a link, html tags not recognized (but the bbcode yes)',
	'auth_desc'			=> 'Important note: the "restore topic" and "restore post" permissions give the user the ability to see deleted topics and/or posts, which are normally invisible to visitors.',
	'invalid_forum_name'			=> 'The forum name is invalid (it must be between 1 and 100 characters).',
	'incorrect_category'			=> 'The forum category is incorrect.',
	'invalid_icon'			=> 'The forum icon is invalid.',
	'invalid_description'			=> 'The forum description must be less than 1000 characters.',
	'invalid_rules'			=> 'Forum rules must be less than 15,000 characters.',
	'chose_if_alerts'			=> 'You have to choose if you want to enable alerts or not.',
	'chose_if_closed'			=> 'You must choose whether you want to close the forum or not.',
	'invalid_moderator_name'			=> 'The moderator nickname "%s" is invalid.',
	'error_auth_view'			=> 'Only visitors, members, moderators or administrators can read the forum.',
	'error_auth_topic'			=> 'Only members, moderators or administrators can create a new topic.',
	'error_auth_reply'			=> 'Only members, moderators or administrators can reply to topics.',
	'error_auth_edit'			=> 'Only members, moderators or administrators can edit their topics/posts.',
	'error_auth_alert'			=> 'Only members, moderators or administrators can report a message.',
	'error_auth_lock_topic'			=> 'Only moderators or administrators can block a topic.',
	'error_auth_stick_topic'			=> 'Only moderators or administrators can tag a topic.',
	'error_auth_delete_topic'			=> 'Only moderators or administrators can delete a topic or post.',
	'error_auth_delete_post'			=> 'Only moderators or administrators can delete a topic or post.',
	'error_auth_restore_topic'			=> 'Only moderators or administrators can restore a topic or message.',
	'error_auth_restore_post'			=> 'Only moderators or administrators can restore a topic or message.',
	'error_auth_ban'			=> 'Only moderators or administrators can ban a user.',
	'update_error'			=> 'An error occurred while updating the information.',
);
