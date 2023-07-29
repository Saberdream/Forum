<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * login.php
*/
$lang['login'] = array(
	'not_authorized'	=> 'Sie sind nicht berechtigt, auf diesen Teil der Website zuzugreifen',
	'connect'	=> 'Anmeldung',
	'connect_acp'	=> 'Anmeldung im Admin-Panel',
	'page_description'	=> 'Sie können ein Cookie setzen, um die automatische Anmeldung zu ermöglichen, sodass Sie sich bei Ihrem nächsten Besuch nicht erneut anmelden müssen.',
	'page_description_acp'	=> 'Willkommen auf der Anmeldeseite des Admin-Panels. ',
	'username'	=> 'Pseudo',
	'password'	=> 'Passwort',
	'validate'	=> 'Bestätigen',
	'already_connected'	=> 'Du bist schon verbunden.',
	'already_connected_acp'	=> 'Sie sind bereits in der Verwaltung angemeldet.',
	'copy_code'	=> 'Kopieren Sie den Code',
	'ask_new_code'	=> 'Fordern Sie einen neuen Code',
	'enter_username'	=> 'Spitznamen eingeben',
	'errors_occurred'	=> 'Es sind ein oder mehrere Fehler aufgetreten',
	'automatic_connection'	=> 'Automatische Verbindung',
	'account'	=> 'Mein Konto',
	'users_connected'	=> 'Verbundene Benutzer',
);

$lang['form_errors'] = array(
	'enter_password'	=> 'Sie müssen ein Passwort eingeben.',
	'incorrect_username'	=> 'Der Spitzname ist falsch.',
	'incorrect_captcha'	=> 'Der Bestätigungscode ist nicht korrekt ausgefüllt bzw. falsch.',
	'invalid_form'	=> 'Das Formular ist ungültig. Bitte versuchen Sie es erneut.',
);

$lang['login_errors'] = array(
	'invalid_username'	=> 'Der Spitzname ist ungültig.',
	'username_not_exists'	=> 'Dieser Spitzname existiert nicht.',
	'cant_connect_guest'	=> 'Sie können sich nicht mit einem Gastkonto anmelden.',
	'too_many_attempts'	=> 'Sie haben zu viele Anmeldeversuche unternommen. Sie müssen noch %d Sekunde(n) warten, bevor Sie erneut versuchen, sich anzumelden.',
	'incorrect_password'	=> 'Das Kontopasswort ist falsch.',
	'permanently_banned'	=> 'Der Spitzname ist aus dem Grund „%s“ für einen dauerhaften Zeitraum gesperrt.',
	'temporarily_banned'	=> 'Der Spitzname ist aus dem Grund „%s“ für die Dauer von %d Tag(en) gesperrt.',
	'session_error'	=> 'Ungültige oder nicht vorhandene Sitzung. Bitte versuchen Sie es später erneut.',
);
