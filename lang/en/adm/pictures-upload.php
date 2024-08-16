<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * pictures-upload.php
*/
$lang['pictures'] = array(
	'manage_pictures'	=> 'Image management',
	'manage_files'	=> 'File management',
	'send'	=> 'Send',
	'send_pictures'	=> 'Send images',
	'delete_selection'	=> 'Remove selection',
	'select_files'	=> 'Select files',
	'reset'	=> 'Reset',
	'confirm_action'	=> 'Are you sure you want to perform this action on the selected elements?',
	'select_action'	=> 'You must select an action.',
	'select_element'	=> 'You must select at least one item.',
	'alert'	=> 'Alert',
	'cancel'	=> 'Cancel',
	'user_deleted'	=> 'The user has been deleted.',
	'action_success'	=> 'The action was successfully performed on the selected elements.',
	'invalid_form'	=> 'The form is invalid, please try again.',
	'incorrect_token'	=> 'The token is expired or incorrect.',
	'error_occurred'	=> 'An error has occurred',
	'files_not_deleted'	=> 'The files could not be deleted.',
	'error_loading_file'	=> 'Error loading file.',
	'file_already_exists'	=> 'The file already exists.',
	'type_not_allowed'	=> 'Unauthorized file type.',
	'invalid_picture'	=> 'The file is not a valid image.',
	'weight_limit_exceeded'	=> 'The size of the image (%d MB) exceeds the maximum allowed weight (%d MB).',
	'size_too_big'	=> 'The image dimensions are too large (max %dx%dpx).',
	'file_limit_exceeded'	=> 'You have already sent %d files, you must wait before sending them again.',
	'files_not_sent'	=> 'The files could not be sent.',
	'directory_not_exists'	=> 'The upload folder does not exist.',
	'confirm_delete'	=> 'Are you sure you want to delete this item?',
	'validate'	=> 'To validate',
	'modify'	=> 'To modify',
	'check_all'	=> 'Check all',
	'click_to_enlarge'	=> 'Click on the image to enlarge it',
);
