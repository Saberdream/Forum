<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * alerts.php
*/
$lang['alerts'] = array(
	'manage_alerts'	=> 'Alert management',
	'exact'	=> 'Exact',
	'search'	=> 'To research',
	'back'	=> 'Back',
	'total'	=> 'Total',
	'rows'	=> 'Lines',
	'ban'	=> 'Ban',
	'unban'	=> 'Unban',
	'delete'	=> 'DELETE',
	'validate'	=> 'To validate',
	'id'	=> 'ID',
	'username'	=> 'Pseudo',
	'ip'	=> 'IP',
	'date'	=> 'Date',
	'last'	=> 'Last',
	'author'	=> 'Author',
	'reason'	=> 'Pattern',
	'action'	=> 'Action',
	'edit_user_informations'	=> 'Edit user information',
	'search_results'	=> '%d result(s) for search of “<strong>%s</strong>”',
	'search_no_result'	=> 'No results for the search for “<strong>%s</strong>”, try again with more specific keywords.',
	'no_data'	=> 'There is no data to display!',
	'mark_as_treated'	=> 'Mark as processed',
	'go_to_alert_page'	=> 'Go to the alert page',
	'view'	=> 'See',
	'confirm_action'	=> 'Are you sure you want to perform this action on the selected elements?',
	'select_action'	=> 'You must select an action.',
	'select_element'	=> 'You must select at least one item.',
	'alert'	=> 'Alert',
	'cancel'	=> 'Cancel',
	'user_deleted'	=> 'The user has been deleted.',
	'action_success'	=> 'The action was successfully performed on the selected elements.',
	'invalid_form'	=> 'The form is invalid, please try again.',
	'incorrect_ids'	=> 'The IDs are incorrect.',
	'incorrect_category_id'	=> 'The category id is incorrect.',
	'incorrect_token'	=> 'The token is expired or incorrect.',
	'error_occurred'	=> 'An error has occurred',
	'files_not_deleted'	=> 'The files could not be deleted.',
	'alerts_treated'	=> 'Alerts processed',
	'banlist'	=> 'Bans',
);

$lang['search_options'] = array(
	'id'	=> 'ID',
	'username'	=> 'Pseudo',
	'ip'	=> 'IP',
	'reason'	=> 'Pattern',
);
