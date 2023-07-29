<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * settings.php
*/
$lang['settings'] = array(
	'notifications'			=> 'Notifications',
	'account'			=> 'Account',
	'subscriptions'			=> 'Subscriptions',
	'avatars'			=> 'Avatars',
	'edit_settings'			=> 'Modify your information',
	'errors_occured'			=> 'One or more errors must be corrected',
	'informations_updated'			=> 'Your information has been successfully updated.',
	'incorrect_captcha'			=> 'The confirmation code is not filled in correctly/is incorrect.',
	'invalid_form'			=> 'The form is invalid, please try again.',
	'incorrect_password'			=> 'The account password is incorrect.',
	'enter_password'			=> 'Enter Password',
	'invalid_birthday'			=> 'Your date of birth is invalid.',
	'invalid_birthday_format'			=> 'Your date of birth must be in dd/mm/yyyy format.',
	'invalid_sex'			=> 'Gender is invalid.',
	'invalid_password'			=> 'The password must contain at most %d characters.',
	'invalid_email'			=> 'Email is invalid.',
	'invalid_signature'			=> 'Your signature must contain a maximum of %d characters.',
	'invalid_description'			=> 'Your personal description must contain a maximum of %d characters.',
	'invalid_country'			=> 'The country must be a maximum of 50 characters.',
	'invalid_style'			=> 'The style is invalid.',
	'invalid_lang'			=> 'The language is invalid.',
	'invalid_timezone'			=> 'The time zone is invalid.',
	'invalid_avatar'			=> 'The avatar is invalid.',
	'update_error'			=> 'An error occurred while updating the information.',
	'password'			=> 'Password',
	'password_desc'			=> 'Only to change it.',
	'email'			=> 'E-mail',
	'birthday'			=> 'Date of birth',
	'day'			=> 'Day',
	'month'			=> 'Month',
	'year'			=> 'Year',
	'sex'			=> 'Sex',
	'country'			=> 'Country',
	'country_desc'			=> 'Maximum %d characters',
	'lang'			=> 'Site language',
	'style'			=> 'Website styling',
	'not_specified'			=> 'Unspecified',
	'no_avatar'			=> 'no avatar',
	'no_avatar_uploaded'			=> 'You have not sent any avatars.',
	'forum_signature'			=> 'Signature on the forums',
	'forum_signature_desc'			=> 'Your signature will be visible on the forums under each of your posts.',
	'description'			=> 'Personal description',
	'description_desc'			=> 'Your description will be visible from your profile',
	'avatar'			=> 'Avatar',
	'send_avatar'			=> 'Submit avatar',
	'ask_new_code'			=> 'Request a new code',
	'validate'			=> 'To validate',
	'copy_code'			=> 'Copy the code',
	'enter_email'			=> 'Enter email address',
	'timezone'			=> 'Time zone',
);

$lang['settings_sexes'] = array(
	'm'			=> 'Male',
	'f'			=> 'Feminine',
);
