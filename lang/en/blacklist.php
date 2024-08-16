<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * blacklist.php
*/
$lang['bl'] = array(
	'not_logged_in'	=> 'You must be registered and logged in to access this part of the site.',
	'no_blacklisted_user'	=> 'There are no users in your blacklist.',
	'date'	=> 'Date',
	'rows'	=> 'Lines',
	'total'	=> 'Total',
	'username'	=> 'User',
	'token_expired'	=> 'The token is expired or incorrect.',
	'add_new_users'	=> 'Add users to your blacklist',
	'add'	=> 'Add',
	'delete'	=> 'DELETE',
	'delete_selection'	=> 'Remove selection',
	'incorrect_ids'	=> 'The ids are invalid.',
	'usernames'	=> 'Users',
	'expired_form'	=> 'The form is expired or incorrect.',
	'invalid_form'	=> 'The form is invalid, please try again.',
	'error_occurred'	=> 'One or more errors have occurred',
	'invalid_username'	=> 'The user “%s” is invalid.',
	'banned_user'	=> 'User “%s” is banned.',
	'user_not_exists'	=> 'User “%s” does not exist.',
	'cant_add_user'	=> 'You cannot add user “%s”.',
	'user_duplicate'	=> 'The user “%s” is present two or more times in the list.',
	'users_not_exists'	=> 'Users do not exist.',
	'self_username'	=> 'You cannot add yourself to your blacklist.',
	'already_blacklisted'	=> 'User “%s” is already in your blacklist.',
	'no_user_too_long'	=> 'You have not entered a user or your user list is too long.',
	'user_successful_added'	=> 'The user(s) have been added to your blacklist.',
	'too_many_users'	=> 'You have added too many users to your blacklist, remove some so you can add new ones.',
	'mailbox'	=> 'Inbox',
	'blacklist'	=> 'Blacklist',
	'new_message'	=> 'New message',
	'confirm_action'	=> 'Are you sure you want to perform this action on the selected elements?',
	'select_action'	=> 'You must select an action.',
	'select_element'	=> 'You must select at least one item.',
	'alert'	=> 'Alert',
	'cancel'	=> 'Cancel',
	'action_success'	=> 'The action was successfully performed on the selected elements.',
	'confirm_delete'	=> 'Are you sure you want to delete this item?',
	'users_deleted'	=> 'The users have been deleted.',
);
