<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * configuration.php
*/
$lang['config'] = array(
	'site_configuration'	=> 'Site-Setup',
	'page_description'	=> 'Hier können Sie Ihre Forum-Einstellungen konfigurieren.',
	'save'	=> 'Zum Schutz',
	'yes'	=> 'Ja',
	'no'	=> 'NEIN',
	'settings_saved'	=> 'Ihre Einstellungen wurden berücksichtigt.',
	'writing_error'	=> 'Beim Schreiben der Konfigurationsdatei ist ein Fehler aufgetreten.',
	'invalid_form'	=> 'Das Formular ist ungültig. Bitte versuchen Sie es erneut.',
	'errors_occurred'	=> 'Es sind ein oder mehrere Fehler aufgetreten',
	'update_error'	=> 'Fehler beim Aktualisieren der Konfiguration.',
	'error_logs'	=> 'Fehlerprotokolle',
	'styles'	=> 'Stile',
	'visitors'	=> 'Besucher',
	'members'	=> 'Mitglieder',
	'moderators'	=> 'Moderatoren',
	'administrators'	=> 'Administrator',
);

$lang['cat_names'] = array(
	'general_configuration'	=> 'Allgemeine Einrichtung',
	'users_configuration'	=> 'Benutzer konfigurieren',
	'forums_configuration'	=> 'Foren konfigurieren',
	'avatars_configuration'	=> 'Avatare konfigurieren',
	'files_upload_configuration'	=> 'Datei-Uploads konfigurieren',
	'server_configuration'	=> 'Server-Setup',
	'pm_configuration'	=> 'Private Nachrichten einrichten',
	'articles_configuration'	=> 'Elemente konfigurieren',
);

$lang['config_names'] = array(
	'site_name'	=> 'Name der Website',
	'site_description'	=> 'Seitenbeschreibung',
	'domain_name'	=> 'Site-Domäne',
	'site_mail'	=> 'Website-E-Mail',
	'default_style'	=> 'Standardstil',
	'default_timezone'	=> 'Standardzeitzone',
	'user_style'	=> 'Benutzerstil zulassen',
	'site_open'	=> 'Website geöffnet',
	'site_closed_reason'	=> 'Grund für die Schließung',
	'allow_register'	=> 'Registrierungen zulassen',
	'desc_max_size'	=> 'Maximale Beschreibungsgröße',
	'activate_sign'	=> 'Signaturen aktivieren',
	'sign_max_size'	=> 'Maximale Größe der Signaturen',
	'form_expiration_time'	=> 'Ablaufzeit des Formulars',
	'session_expiration_time'	=> 'Sitzungszeitüberschreitungen',
	'max_autologin_time'	=> 'Maximale Dauer einer Sitzung',
	'sessions_per_ip'	=> 'Max. ',
	'max_login_attempts'	=> 'Maximale Anzahl an Anmeldeversuchen',
	'attempt_wait_time'	=> 'Zeit bis zum erneuten Versuch',
	'cookies_expiration_time'	=> 'Cookie-Ablaufzeit',
	'cookies_name'	=> 'Name des Login-Cookies',
	'max_subscribes'	=> 'Max. ',
	'load_limit'	=> 'Begrenzen Sie die Serverlast',
	'notifications_limit'	=> 'Max. ',
	'welcome_message'	=> 'Willkommensnachricht bei der Registrierung',
	'topics_per_page'	=> 'Themen pro Seite',
	'posts_per_page'	=> 'Beiträge pro Seite',
	'topic_flood_time'	=> 'Thema Hochwasserzeit',
	'post_flood_time'	=> 'Nachrichtenflutzeit',
	'captcha_newtopic'	=> 'Captcha zum Erstellen eines neuen Themas',
	'captcha_reply'	=> 'Captcha, um auf ein Thema zu antworten',
	'topic_max_size'	=> 'Maximale Themenlänge',
	'post_max_size'	=> 'Maximale Nachrichtenlänge',
	'max_sticky_topics'	=> 'Maximale Anzahl Pins',
	'post_max_smilies'	=> 'Maximale Anzahl an Smileys',
	'activate_avatar'	=> 'Avatare aktivieren',
	'avatar_max_height'	=> 'Maximale Avatar-Höhe',
	'avatar_max_width'	=> 'Maximale Avatar-Breite',
	'avatar_max_size'	=> 'Maximales Avatargewicht',
	'avatar_max_files'	=> 'NEIN. ',
	'avatar_wait_time'	=> 'Zeitlimit zwischen Uploads',
	'avatar_allowed_types'	=> 'Zulässige Dateitypen',
	'max_avatars_per_user'	=> 'Max. ',
	'activate_upload'	=> 'Datei-Upload aktivieren',
	'upload_max_height'	=> 'Maximale Dateihöhe',
	'upload_max_width'	=> 'Maximale Dateibreite',
	'upload_max_size'	=> 'Maximale Dateigröße',
	'upload_max_files'	=> 'NEIN. ',
	'upload_wait_time'	=> 'Zeitlimit zwischen Uploads',
	'upload_allowed_types'	=> 'Zulässige Dateitypen',
	'session_gc_probability'	=> 'Wahrscheinlichkeit, dass die Sitzungsauslagerung aktiviert wird',
	'table_prefix'	=> 'Tabellenpräfix',
	'default_lang'	=> 'Standardsprache der Website',
	'server_protocol'	=> 'Serverprotokoll',
	'post_redirection_time'	=> 'Richtungszeit nach dem Posten eines Themas/einer Nachricht',
	'smtp_server'	=> 'SMTP-Server',
	'smtp_port'	=> 'SMTP-Server-Port',
	'sendmail_from'	=> 'Email-Konto',
	'activate_pm'	=> 'Private Nachrichten aktivieren',
	'pm_flood_time'	=> 'Flutzeit zwischen den einzelnen Nachrichten',
	'pm_reply_flood_time'	=> 'Flutzeit zwischen den einzelnen Antworten',
	'pm_captcha'	=> 'Captcha für neue Beiträge',
	'pm_reply_captcha'	=> 'Captcha für Antworten',
	'pm_max_size'	=> 'Maximale Länge von PM-Titeln',
	'pm_reply_max_size'	=> 'Maximale Antwortlänge',
	'pm_max_smilies'	=> 'Maximale Anzahl von Smileys in Antworten',
	'pm_max_participants'	=> 'Maximale Anzahl an PM-Teilnehmern',
	'activate_articles'	=> 'Artikel aktivieren',
	'articles_flood_time'	=> 'Flutzeit zwischen Artikeln',
	'articles_captcha'	=> 'Captcha für Artikel',
	'articles_title_max_size'	=> 'Maximale Zeichenanzahl für Artikeltitel',
	'articles_text_min_size'	=> 'Mindestanzahl von Zeichen für Artikeltext',
	'articles_text_max_size'	=> 'Maximale Zeichenanzahl des Artikeltextes',
	'articles_auth_read'	=> 'Zum Lesen eines Artikels ist ein Rang erforderlich',
	'articles_auth_new'	=> 'Für die Veröffentlichung eines Artikels ist ein Rang erforderlich',
	'articles_auth_edit'	=> 'Zum Bearbeiten eines Artikels ist ein Rang erforderlich',
	'articles_auth_delete'	=> 'Zum Löschen eines Artikels ist ein Rang erforderlich',
);

$lang['config_descriptions'] = array(
	'form_expiration_time'	=> 'Anzahl der Sekunden (standardmäßig 900)',
	'session_expiration_time'	=> 'Anzahl der Sekunden (standardmäßig 3600)',
	'max_autologin_time'	=> 'Anzahl der Sekunden (standardmäßig 259200)',
	'sessions_per_ip'	=> 'Standardmäßig 10 wert',
	'max_login_attempts'	=> '5 standardmäßig',
	'attempt_wait_time'	=> 'Anzahl der Sekunden (standardmäßig 3600)',
	'cookies_expiration_time'	=> 'Anzahl der Tage',
	'cookies_name'	=> 'Um den Namen des Cookies für die automatische Anmeldung anzupassen',
	'load_limit'	=> 'Maximale Serverlast begrenzen (in %, 0 zum Deaktivieren)',
	'max_subscribes'	=> 'Maximale Anzahl an Themen, die ein Benutzer abonnieren kann (0 zum Deaktivieren)',
	'notifications_limit'	=> 'Begrenzen Sie die Anzahl der Benachrichtigungen während einer Antwort, um die Serverlast zu reduzieren (0 zum Deaktivieren).',
	'topic_flood_time'	=> 'Anzahl der Sekunden',
	'post_flood_time'	=> 'Anzahl der Sekunden',
	'topic_max_size'	=> 'Anzahl von Charakteren',
	'post_max_size'	=> 'Anzahl von Charakteren',
	'avatar_max_height'	=> 'Anzahl der Pixel',
	'avatar_max_width'	=> 'Anzahl der Pixel',
	'avatar_max_size'	=> 'Anzahl Mio',
	'avatar_max_files'	=> 'Anzahl der Dateien (0 für unbegrenzt)',
	'avatar_wait_time'	=> 'Anzahl Sekunden (0 für unbegrenzt)',
	'max_avatars_per_user'	=> '0 für unbegrenzt',
	'upload_max_height'	=> 'Anzahl der Pixel',
	'upload_max_width'	=> 'Anzahl der Pixel',
	'upload_max_size'	=> 'Anzahl Mio',
	'upload_max_files'	=> 'Anzahl der Dateien',
	'upload_wait_time'	=> 'Anzahl der Sekunden',
	'session_gc_probability'	=> 'In % (standardmäßig 1)',
	'table_prefix'	=> 'Das Ändern dieser Einstellung kann die ordnungsgemäße Funktion der Website beeinträchtigen. Ändern Sie diese Einstellung nur, wenn Sie wissen, was Sie tun',
	'server_protocol'	=> 'Ändern Sie diesen Wert nur, wenn Sie ein anderes Protokoll als das Standardprotokoll angeben möchten',
	'post_redirection_time'	=> 'Anzahl der Sekunden (standardmäßig 5)',
	'sendmail_from'	=> 'Ist nicht unbedingt dieselbe E-Mail-Adresse wie die E-Mail-Adresse der Website, sondern muss ein gültiges Konto sein, das Ihrem Host entspricht.',
	'pm_flood_time'	=> 'Anzahl der Sekunden',
	'pm_reply_flood_time'	=> 'Anzahl der Sekunden',
	'articles_flood_time'	=> 'Anzahl der Sekunden',
	'pm_max_participants'	=> '0 für unbegrenzt',
);

$lang['config_errors'] = array(
	'activate_avatar'	=> 'Die Avatar-Einstellungen sind ungültig.',
	'activate_pm'	=> 'Die Einstellungen für private Nachrichten sind ungültig.',
	'activate_sign'	=> 'Die Signatureinstellungen sind ungültig.',
	'activate_upload'	=> 'Die Upload-Parameter sind ungültig.',
	'allow_register'	=> 'Die Einstellungen für Neuanmeldungen sind ungültig.',
	'attempt_wait_time'	=> 'Die Anzahl der Anmeldeversuche ist ungültig.',
	'avatar_allowed_types'	=> 'Sie müssen gültige zulässige Erweiterungen für Avatar-Einreichungen eingeben.',
	'avatar_max_files'	=> 'Die maximale Anzahl gleichzeitiger Uploads muss eine gültige Zahl sein.',
	'avatar_max_height'	=> 'Die maximale Avatar-Höhe muss eine gültige Zahl sein.',
	'avatar_max_size'	=> 'Das maximale Avatar-Gewicht muss eine gültige Zahl sein.',
	'avatar_max_width'	=> 'Die maximale Avatar-Breite muss eine gültige Zahl sein.',
	'avatar_wait_time'	=> 'Die Wartezeit zwischen mehreren gleichzeitigen Uploads muss eine gültige Zahl sein.',
	'captcha_newtopic'	=> 'Die Einstellungen für private Nachrichten sind ungültig.',
	'captcha_reply'	=> 'Die Einstellungen für private Nachrichten sind ungültig.',
	'cookies_expiration_time'	=> 'Die Cookie-Ablaufzeit muss eine gültige Zahl sein.',
	'cookies_name'	=> 'Der Name des Login-Cookies darf nicht leer sein und darf maximal 1000 alphanumerische Zeichen oder _ enthalten.',
	'desc_max_size'	=> 'Die Zeichenbeschränkung für die Profilbeschreibung muss eine gültige Zahl sein.',
	'domain_name'	=> 'Der Domänenname ist ungültig.',
	'default_style'	=> 'Der Standardstil des Forums ist ungültig.',
	'default_timezone'	=> 'Die Standardzeitzone ist ungültig.',
	'user_style'	=> 'Die Berechtigungseinstellungen für den Benutzerstil sind ungültig.',
	'max_avatars_per_user'	=> 'Die maximale Anzahl an Avataren pro Benutzer muss eine gültige Zahl sein.',
	'max_login_attempts'	=> 'Die Wartezeit bis zu einem erneuten Verbindungsversuch ist ungültig.',
	'max_sticky_topics'	=> 'Die maximale Anzahl angepinnter Themen pro Forum muss eine gültige Zahl sein.',
	'max_subscribes'	=> 'Die maximale Anzahl an Abonnements muss eine gültige Anzahl sein.',
	'load_limit'	=> 'Die Einstellungen zur Serverlastdrosselung sind ungültig.',
	'notifications_limit'	=> 'Das Limit der gesendeten Benachrichtigungen muss eine gültige Zahl sein.',
	'posts_per_page'	=> 'Die Anzahl der Beiträge pro Seite muss eine gültige Zahl sein.',
	'post_flood_time'	=> 'Die Nachflutzeit muss eine gültige Zahl sein.',
	'post_max_size'	=> 'Die maximale Beitragsgröße muss eine gültige Zahl sein.',
	'post_max_smilies'	=> 'Die maximale Anzahl an Smileys muss eine gültige Zahl sein.',
	'form_expiration_time'	=> 'Die Ablaufzeit des Formulars muss eine gültige Zahl sein.',
	'session_expiration_time'	=> 'Das Sitzungszeitlimit muss eine gültige Zahl sein.',
	'max_autologin_time'	=> 'Die maximale Sitzungsdauer muss eine gültige Zahl sein.',
	'sessions_per_ip'	=> 'Die maximale Anzahl an Sitzungen pro IP muss eine gültige Zahl sein.',
	'sign_max_size'	=> 'Die maximale Signaturgröße muss eine gültige Zahl sein.',
	'site_closed_reason'	=> 'Der Grund für die Schließung ist zu lang.',
	'site_mail'	=> 'Die E-Mail-Adresse der Website ist ungültig. Die E-Mail muss das Format example@domain.com haben.',
	'site_name'	=> 'Sie müssen den Site-Namen eingeben. Er darf maximal 100 Zeichen lang sein.',
	'site_description'	=> 'Die Site-Beschreibung muss weniger als 1000 Zeichen umfassen.',
	'site_open'	=> 'Die Einstellungen zum Herunterfahren der Website sind ungültig.',
	'topics_per_page'	=> 'Die Anzahl der Themen pro Seite muss eine gültige Zahl sein.',
	'topic_flood_time'	=> 'Die Topic-Flood-Zeit muss eine gültige Zahl sein.',
	'topic_max_size'	=> 'Die maximale Themengröße muss eine gültige Zahl sein.',
	'upload_allowed_types'	=> 'Sie müssen gültige autorisierte Erweiterungen für Dateiübermittlungen eingeben.',
	'upload_max_files'	=> 'Die maximale Anzahl gleichzeitiger Uploads muss eine gültige Zahl sein.',
	'upload_max_height'	=> 'Die maximale Höhe der hochgeladenen Dateien muss eine gültige Zahl sein.',
	'upload_max_size'	=> 'Die maximale Größe der gesendeten Dateien muss eine gültige Zahl sein.',
	'upload_max_width'	=> 'Die maximale Breite der hochgeladenen Dateien muss eine gültige Zahl sein.',
	'upload_wait_time'	=> 'Die Wartezeit zwischen mehreren gleichzeitigen Uploads muss eine gültige Zahl sein.',
	'welcome_message'	=> 'Die Willkommensnachricht ist zu lang.',
	'session_gc_probability'	=> 'Sie müssen eine gültige Wahrscheinlichkeitszahl für die Sitzungsauslagerung eingeben.',
	'table_prefix'	=> 'Das Tabellenpräfix ist ungültig.',
	'default_lang'	=> 'Die Standardsprache der Website ist ungültig.',
	'server_protocol'	=> 'Das Serverprotokoll muss im Format http:// oder https:// vorliegen.',
	'smtp_server'	=> 'Der SMTP-Server muss im Format „smtp.domain.xxx“ vorliegen.',
	'smtp_port'	=> 'Der SMTP-Port muss eine gültige Nummer sein.',
	'sendmail_from'	=> 'Das E-Mail-Konto muss das Format example@domain.xxx haben.',
	'articles_auth_read'	=> 'Der zum Lesen eines Artikels erforderliche Mindestrang ist ungültig.',
	'articles_auth_new'	=> 'Der zum Posten eines Artikels erforderliche Mindestrang ist ungültig.',
	'articles_auth_edit'	=> 'Der zum Bearbeiten eines Artikels erforderliche Mindestrang ist ungültig.',
	'articles_auth_delete'	=> 'Der zum Löschen eines Artikels erforderliche Mindestrang ist ungültig.',
);
