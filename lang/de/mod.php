<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * mod.php
*/
$lang['mod_errors'] = array(
	'not_authorized_access'	=> 'Sie können auf diesen Abschnitt nicht zugreifen.',
	'incorrect_forum_id'	=> 'Ungültige Forum-ID.',
	'forum_not_found'	=> 'Forum nicht gefunden.',
	'not_moderator'	=> 'Sie sind kein Moderator dieses Forums.',
	'expired_token'	=> 'Der Token ist abgelaufen oder ungültig.',
	'no_topic_selected'	=> 'Es wurde kein Thema ausgewählt.',
	'incorrect_ids'	=> 'Die IDs sind falsch.',
	'incorrect_action'	=> 'Diese Aktion ist falsch.',
	'not_authorized_action'	=> 'Sie verfügen nicht über die erforderliche Berechtigung, um diese Aktion auszuführen.',
	'max_sticky_reached'	=> 'Die maximale Anzahl angehefteter Themen wurde erreicht (%d).',
	'topic_not_found'	=> 'Betreff gelöscht oder falsche ID.',
	'no_topic_affected'	=> 'Von der Anfrage waren keine Themen/Beiträge betroffen.',
	'action_success'	=> 'Aktion erfolgreich abgeschlossen, %d Beiträge/Themen betroffen.',
	'incorrect_topic_id'	=> 'Ungültige Betreff-ID.',
	'incorrect_post_id'	=> 'Falsche Nachrichten-ID.',
	'incorrect_user_id'	=> 'Falsche Benutzer-ID.',
	'error_occurred'	=> 'Ein Fehler ist aufgetreten',
);
