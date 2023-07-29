<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * newpm.php
*/
$lang['newpm'] = array(
	'error_occured'	=> 'Ein Fehler ist aufgetreten',
	'mailbox'	=> 'Briefkasten',
	'blacklist'	=> 'Schwarze Liste',
	'new_message'	=> 'Neue Nachricht',
	'send_new_pm'	=> 'Senden Sie eine neue Nachricht',
	'subject'	=> 'Thema',
	'message'	=> 'Nachricht',
	'type_subject'	=> 'Betreff eingeben',
	'message_rules'	=> 'Posten Sie keine Beleidigungen, vermeiden Sie Großbuchstaben, führen Sie vor dem Posten eine Suche durch, um zu sehen, ob die Frage nicht bereits gestellt wurde ... Jede Nachricht, die zur Piraterie aufstachelt, ist strengstens verboten und wird mit Verbannung bestraft.',
	'request_new_code'	=> 'Fordern Sie einen neuen Code',
	'copy_code'	=> 'Kopieren Sie den Code',
	'post'	=> 'Zum Posten',
	'preview'	=> 'Einblick',
	'back'	=> 'Rückmeldung',
	'smileys_list'	=> 'Liste der Smileys',
	'errors_detected'	=> 'Es wurden ein oder mehrere Fehler festgestellt',
	'recipients'	=> 'Empfänger',
	'not_logged_in'	=> 'Sie sind nicht verbunden.',
	'poster_banned'	=> 'Sie können keine Nachricht senden, da Sie gesperrt sind.',
	'code_not_filled'	=> 'Sie müssen den Bestätigungscode eingeben.',
	'incorrect_code'	=> 'Der Bestätigungscode ist falsch.',
	'topic_not_filled'	=> 'Sie müssen einen Betreff eingeben.',
	'topic_too_long'	=> 'Ihr Betreff ist zu lang, er darf höchstens %d Zeichen enthalten.',
	'message_not_filled'	=> 'Sie müssen eine Nachricht eingeben.',
	'message_too_long'	=> 'Ihre Nachricht ist zu lang, sie darf maximal %d Zeichen enthalten.',
	'flood_time_pm'	=> 'Sie haben vor weniger als %d Sekunden ein Thema gepostet. Bitte warten Sie.',
	'expired_form'	=> 'Das Formular ist abgelaufen oder falsch.',
	'topic_not_posted'	=> 'Es ist ein Fehler aufgetreten, der Betreff wurde nicht gesendet.',
	'invalid_recipient_name'	=> 'Der Spitzname des Empfängers „%s“ ist ungültig.',
	'banned_recipient'	=> 'Empfänger „%s“ ist gesperrt.',
	'recipient_not_exists'	=> 'Der Empfänger „%s“ existiert nicht.',
	'blacklisted_recipient'	=> 'Sie stehen für den Empfänger „%s“ auf der schwarzen Liste.',
	'cant_send_message'	=> 'Sie können keine Nachricht an den Empfänger „%s“ senden.',
	'recipient_duplicate'	=> 'Der Empfänger „%s“ ist mindestens zwei Mal in der Empfängerliste vorhanden.',
	'no_recipient_too_long'	=> 'Sie haben keinen Empfänger eingegeben oder Ihre Empfängerliste ist zu lang.',
	'recipients_not_exists'	=> 'Empfänger existieren nicht.',
	'self_username'	=> 'Sie können keine Nachricht an sich selbst senden (nein, aber).',
);
