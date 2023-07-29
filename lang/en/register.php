<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * register.php
*/
$lang['register'] = array(
	'notifications'			=> 'Notifications',
	'account'			=> 'Account',
	'subscriptions'			=> 'Subscriptions',
	'avatars'			=> 'Avatars',
	'registration'			=> 'Registration',
	'error_occured'			=> 'An error has occurred',
	'errors_occured'			=> 'One or more errors must be corrected',
	'informations_updated'			=> 'Your information has been successfully updated.',
	'incorrect_captcha'			=> 'The confirmation code is not filled in correctly/is incorrect.',
	'invalid_form'			=> 'The form is invalid, please try again.',
	'incorrect_password'			=> 'The account password is incorrect.',
	'enter_password'			=> 'Enter Password',
	'invalid_birthday'			=> 'Your date of birth must be in dd/mm/yyyy format.',
	'invalid_sex'			=> 'Gender is invalid.',
	'invalid_username'			=> 'The nickname is invalid, it must have 3 to 15 characters and consist only of numbers, letters and/or dashes.',
	'username_already_taken'			=> 'This nickname is already reserved, please choose another one.',
	'passwords_not_identical'			=> 'Password and confirmation must be the same.',
	'email_already_taken'			=> 'This email address is already linked to another account.',
	'ip_banned'			=> 'Your IP address is banned.',
	'email_banned'			=> 'This email address is banned.',
	'registration_closed'			=> 'Registrations are closed for the moment, please come back later.',
	'invalid_password'			=> 'The password must have a maximum of 30 characters.',
	'invalid_email'			=> 'Email is invalid.',
	'must_accept_terms'			=> 'You must read and agree to the Terms of Service.',
	'account_created'			=> 'Your account has been created, you are connected. ',
	'username'			=> 'Pseudo',
	'password'			=> 'Password',
	'email'			=> 'E-mail',
	'ask_new_code'			=> 'Request a new code',
	'validate'			=> 'To validate',
	'copy_code'			=> 'Copy the code',
	'enter_email'			=> 'Enter email address',
	'enter_username'			=> 'Enter nickname',
	'password_confirmation'			=> 'Password Confirmation',
	'confirm_password'			=> 'Confirm the password',
	'accept_terms'			=> 'I have read and accept the <a href="%s">Terms of Service</a>',
	'terms_of_use'			=> 'General conditions of use of the site',
	'terms_text'			=> '<p><strong>The purpose of this charter is to detail the conditions of use of the site as well as its rules.</strong></p>
',
);
