<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * config
*/
$lang['config'] = array (
	'site_configuration'		=> 'Configuration du site',
	'page_description'			=> 'Ici vous pouvez configurer les paramètres de votre forum.',
	'save'						=> 'Sauvegarder',
	'yes'						=> 'Oui',
	'no'						=> 'Non',
	
	// form messages
	'settings_saved'			=> 'Vos paramètres ont bien été pris en compte.',
	'writing_error'				=> 'Une erreur est survenue lors de l\'écriture du fichier de configuration.',
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'errors_occurred'			=> 'Une ou plusieurs erreurs est/sont survenue(s) ',
	'update_error'				=> 'Erreur lors de la mise à jour de la configuration.',
	
	// left menu
	'error_logs'				=> 'Logs des erreurs',
	'styles'					=> 'Styles',
	'langs'						=> 'Langues',
	
	// auths
	'guest'					=> 'Visiteur',
	'user'						=> 'Utilisateur',
	'moderator'				=> 'Modérateur',
	'administrator'			=> 'Administrateur'
);

/*
 * configuration categories
*/
$lang['cat_names'] = array (
	'general_configuration'		=> 'Configuration générale',
	'users_configuration'		=> 'Configuration des utilisateurs',
	'forums_configuration'		=> 'Configuration des forums',
	'avatars_configuration'		=> 'Configuration des avatars',
	'files_upload_configuration'=> 'Configuration des uploads de fichiers',
	'server_configuration'		=> 'Configuration du serveur',
	'pm_configuration'			=> 'Configuration des messages privés',
	'articles_configuration'	=> 'Configuration des articles'
);

/*
 * config names
*/
$lang['config_names'] = array (
	'site_name'					=> 'Nom du site',
	'site_description'			=> 'Description du site',
	'domain_name'				=> 'Domaine du site',
	'site_mail'					=> 'Email du site',
	'default_style'				=> 'Style par défaut',
	'default_timezone'			=> 'Fuseau horaire par défaut',
	'user_style'				=> 'Autoriser le style utilisateur',
	'site_open'					=> 'Site ouvert',
	'site_closed_reason'		=> 'Raison de la fermeture',
	'allow_register'			=> 'Autoriser les inscriptions',
	'desc_max_size'				=> 'Taille max de la description',
	'activate_sign'				=> 'Activer les signatures',
	'sign_max_size'				=> 'Taille max des signatures',
	'form_expiration_time'		=> 'Temps d\'expiration des formulaires',
	'session_expiration_time'	=> 'Temps d\'expiration des sessions',
	'max_autologin_time'		=> 'Durée maximale d\'une session',
	'sessions_per_ip'			=> 'Nb max. de sessions par IP',
	'max_login_attempts'		=> 'Nombre max de tentatives de connexion',
	'attempt_wait_time'			=> 'Délais avant nouvelle tentative',
	'cookies_expiration_time'	=> 'Temps d\'expiration des cookies',
	'cookies_name'				=> 'Nom du cookie de connexion',
	'max_subscribes'			=> 'Nombre max. d\'abonnements',
	'load_limit'				=> 'Limiter la charge du serveur',
	'notifications_limit'		=> 'Nombre max. de notifications',
	'welcome_message'			=> 'Message de bienvenue lors de l\'inscription',
	'topics_per_page'			=> 'Sujets par page',
	'posts_per_page'			=> 'Messages par page',
	'topic_flood_time'			=> 'Temps de flood des sujets',
	'post_flood_time'			=> 'Temps de flood des messages',
	'captcha_newtopic'			=> 'Captcha pour créer un nouveau sujet',
	'captcha_reply'				=> 'Captcha pour répondre à un sujet',
	'topic_max_size'			=> 'Longueur max des sujets',
	'post_max_size'				=> 'Longueur max des messages',
	'max_sticky_topics'			=> 'Nombre max d\'épingles',
	'post_max_smilies'			=> 'Nombre max de smilies',
	'activate_avatar'			=> 'Activer les avatars',
	'avatar_max_height'			=> 'Hauteur max des avatars',
	'avatar_max_width'			=> 'Largeur max des avatars',
	'avatar_max_size'			=> 'Poids max des avatars',
	'avatar_max_files'			=> 'Nb. max d\'uploads simultanés',
	'avatar_wait_time'			=> 'Temps limite entre uploads',
	'avatar_allowed_types'		=> 'Types de fichiers autorisés',
	'max_avatars_per_user'		=> 'Nombre max. d\'avatar par utilisateur',
	'activate_upload'			=> 'Activer l\'upload de fichiers',
	'upload_max_height'			=> 'Hauteur max des fichiers',
	'upload_max_width'			=> 'Largeur max des fichiers',
	'upload_max_size'			=> 'Poids max des fichiers',
	'upload_max_files'			=> 'Nb. max d\'uploads simultanés',
	'upload_wait_time'			=> 'Temps limite entre uploads',
	'upload_allowed_types'		=> 'Types de fichiers autorisés',
	'session_gc_probability'	=> 'Probabilité d\'activer le délestage de sessions',
	'table_prefix'				=> 'Préfixe des tables',
	'default_lang'				=> 'Langue par défaut du site',
	'server_protocol'			=> 'Protocole du serveur',
	'post_redirection_time'		=> 'Temps de direction après avoir posté un sujet/message',
	'smtp_server'				=> 'Serveur SMTP',
	'smtp_port'					=> 'Port du serveur SMTP',
	'sendmail_from'				=> 'Compte email',
	'activate_pm'				=> 'Activer les messages privés',
	'pm_flood_time'				=> 'Temps de flood entre chaque message',
	'pm_reply_flood_time'		=> 'Temps de flood entre chaque réponse',
	'pm_captcha'				=> 'Captcha pour les nouveaux messages',
	'pm_reply_captcha'			=> 'Captcha pour les réponses',
	'pm_max_size'				=> 'Longueur maximum des titres de MP',
	'pm_reply_max_size'			=> 'Longueur maximum des réponses',
	'pm_max_smilies'			=> 'Nombre maximum de smileys dans les réponses',
	'pm_max_participants'		=> 'Nombre maximum de participants à un MP',
	'activate_articles'			=> 'Activer les articles',
	'articles_flood_time'		=> 'Temps de flood entre les articles',
	'articles_captcha'			=> 'Captcha pour les articles',
	'articles_title_max_size'	=> 'Nb maximum de caractères du titre des articles',
	'articles_text_min_size'	=> 'Nb minimum de caractères du texte des articles',
	'articles_text_max_size'	=> 'Nb maximum de caractères du texte des articles',
	'articles_auth_read'		=> 'Rang requis pour lire un article',
	'articles_auth_new'			=> 'Rang requis pour poster un article',
	'articles_auth_edit'		=> 'Rang requis pour éditer un article',
	'articles_auth_delete'		=> 'Rang requis pour supprimer un article'
);

/*
 * config descriptions
*/
$lang['config_descriptions'] = array(
	'form_expiration_time'		=> 'Nombre de secondes (900 par défaut)',
	'session_expiration_time'	=> 'Nombre de secondes (3600 par défaut)',
	'max_autologin_time'		=> 'Nombre de secondes (259200‬ par défaut)',
	'sessions_per_ip'			=> 'Vaut 10 par défaut',
	'max_login_attempts'		=> '5 par défaut',
	'attempt_wait_time'			=> 'Nombre de secondes (3600 par défaut)',
	'cookies_expiration_time'	=> 'Nombre de jours',
	'cookies_name'				=> 'Pour personnaliser le nom du cookie de connexion automatique',
	'load_limit'				=> 'Limite la charge maximale du serveur (en %, 0 pour désactiver)',
	'max_subscribes'			=> 'Nombre maximal de sujets auquel un utilisateur peut s\'abonner (0 pour désactiver)',
	'notifications_limit'		=> 'Limite le nombre de notifications lors d\'une réponse pour diminuer la charge des serveurs (0 pour désactiver)',
	'topic_flood_time'			=> 'Nombre de secondes',
	'post_flood_time'			=> 'Nombre de secondes',
	'topic_max_size'			=> 'Nombre de caractères',
	'post_max_size'				=> 'Nombre de caractères',
	'avatar_max_height'			=> 'Nombre de pixels',
	'avatar_max_width'			=> 'Nombre de pixels',
	'avatar_max_size'			=> 'Nombre de Mio',
	'avatar_max_files'			=> 'Nombre de fichiers (0 pour illimité)',
	'avatar_wait_time'			=> 'Nombre de secondes (0 pour illimité)',
	'max_avatars_per_user'		=> '0 pour illimité',
	'upload_max_height'			=> 'Nombre de pixels',
	'upload_max_width'			=> 'Nombre de pixels',
	'upload_max_size'			=> 'Nombre de Mio',
	'upload_max_files'			=> 'Nombre de fichiers',
	'upload_wait_time'			=> 'Nombre de secondes',
	'session_gc_probability'	=> 'En nombre de % (1 par défaut)',
	'table_prefix'				=> 'La modification de ce paramètre peut compromettre le bon fonctionnement du site, ne modifiez ce paramètre que si vous savez ce que vous faites',
	'server_protocol'			=> 'Ne modifiez cette valeur que si vous voulez spécifier un protocole différent du protocole par défaut',
	'post_redirection_time'		=> 'Nombre de secondes (5 par défaut)',
	'sendmail_from'				=> 'N\'est pas obligatoirement la même adresse email que l\'email du site mais doit être un compte valide correspondant à votre hébergeur.',
	'pm_flood_time'				=> 'Nombre de secondes',
	'pm_reply_flood_time'		=> 'Nombre de secondes',
	'articles_flood_time'		=> 'Nombre de secondes',
	'pm_max_participants'		=> '0 pour illimité',
);

/*
 * config errors
*/
$lang['config_errors'] = array(
	'activate_avatar'			=> 'Les paramètres des avatars sont invalides.',
	'activate_pm'				=> 'Les paramètres des messages privés sont invalides.',
	'activate_sign'				=> 'Les paramètres des signatures sont invalides.',
	'activate_upload'			=> 'Les paramètres des uploads sont invalides.',
	'allow_register'			=> 'Les paramètres des nouvelles inscriptions sont invalides.',
	'attempt_wait_time'			=> 'Le nombre de tentatives de connexion est invalide.',
	'avatar_allowed_types'		=> 'Vous devez entrer des extensions autorisées valides pour les envois d\'avatars.',
	'avatar_max_files'			=> 'Le nombre maximum d\'uploads simultanés doit être un nombre valide.',
	'avatar_max_height'			=> 'La hauteur maximale des avatars doit être un nombre valide.',
	'avatar_max_size'			=> 'Le poids maximal des avatars doit être un nombre valide.',
	'avatar_max_width'			=> 'La largeur maximale des avatars doit être un nombre valide.',
	'avatar_wait_time'			=> 'Le temps d\'attente entre plusieurs uploads simultanés doit être un nombre valide.',
	'captcha_newtopic'			=> 'Les paramètres des messages privés sont invalides.',
	'captcha_reply'				=> 'Les paramètres des messages privés sont invalides.',
	'cookies_expiration_time'	=> 'Le temps d\'expiration des cookies doit être un nombre valide.',
	'cookies_name'				=> 'Le nom du cookie de connexion ne doit pas être vide et doit comporter au maximum 1000 caractères alphanumériques ou _.',
	'desc_max_size'				=> 'La limite de caractères de la description du profil doit être un nombre valide.',
	'domain_name'				=> 'Le nom de domaine est invalide.',
	'default_style'				=> 'Le style par défaut du forum est invalide.',
	'default_timezone'			=> 'Le fuseau horaire par défaut est invalide.',
	'user_style'				=> 'Les paramètres d\'autorisation du style utilisateur sont invalides.',
	'max_avatars_per_user'		=> 'Le nombre maximal d\'avatar par utilisateur doit être un nombre valide.',
	'max_login_attempts'		=> 'Le temps d\'attente avant une nouvelle tentative de connexion est invalide.',
	'max_sticky_topics'			=> 'Le nombre maximum de sujets épinglés par forum doit être un nombre valide.',
	'max_subscribes'			=> 'Le nombre maximum d\'abonnements doit être un nombre valide.',
	'load_limit'				=> 'Les paramètres de limitation de la charge du serveur sont invalides.',
	'notifications_limit'		=> 'La limite de notifications envoyées doit être un nombre valide.',
	'posts_per_page'			=> 'Le nombre de posts par page doit être un nombre valide.',
	'post_flood_time'			=> 'Le temps de flood des posts doit être un nombre valide.',
	'post_max_size'				=> 'La taille maximale des posts doit être un nombre valide.',
	'post_max_smilies'			=> 'Le nombre max des smileys doit être un nombre valide.',
	'form_expiration_time'		=> 'Le temps d\'expiration des formulaires doit être un nombre valide.',
	'session_expiration_time'	=> 'Le temps d\'expiration des sessions doit être un nombre valide.',
	'max_autologin_time'		=> 'La durée maximale d\'une session doit être un nombre valide.',
	'sessions_per_ip'			=> 'Le nombre maximal de sessions par IP doit être un nombre valide.',
	'sign_max_size'				=> 'La taille maximale des signatures doit être un nombre valide.',
	'site_closed_reason'		=> 'La raison de la fermeture est trop longue.',
	'site_mail'					=> 'L\'email du site est invalide, l\'email doit être au format exemple@domaine.com.',
	'site_name'					=> 'Vous devez entrer le nom du site, celui-ci doit comporter 100 caractères ou moins.',
	'site_description'			=> 'La description du site doit comporter moins de 1000 caractères.',
	'site_open'					=> 'Les paramètres de fermeture du site sont invalides.',
	'topics_per_page'			=> 'Le nombre de sujets par page doit être un nombre valide.',
	'topic_flood_time'			=> 'Le temps de flood des sujets doit être un nombre valide.',
	'topic_max_size'			=> 'La taille max des sujets doit être un nombre valide.',
	'upload_allowed_types'		=> 'Vous devez entrer des extensions autorisées valides pour les envois de fichiers.',
	'upload_max_files'			=> 'Le nombre maximum d\'uploads simultanés doit être un nombre valide.',
	'upload_max_height'			=> 'La hauteur maximale des fichiers envoyés doit être un nombre valide.',
	'upload_max_size'			=> 'Le poids maximal des fichiers envoyés doit être un nombre valide.',
	'upload_max_width'			=> 'La largeur maximale des fichiers envoyés doit être un nombre valide.',
	'upload_wait_time'			=> 'Le temps d\'attente entre plusieurs uploads simultanés doit être un nombre valide.',
	'welcome_message'			=> 'Le message de bienvenue est trop long.',
	'session_gc_probability'	=> 'Vous devez entrer un nombre de probabilité du délestage de sessions valide.',
	'table_prefix'				=> 'Le préfixe des tables est invalide.',
	'default_lang'				=> 'La langue par défaut du site est invalide.',
	'server_protocol'			=> 'Le protocole du serveur doit être au format http:// ou https://.',
	'smtp_server'				=> 'Le serveur SMTP doit être au format "smtp.domaine.xxx".',
	'smtp_port'					=> 'Le port SMTP doit être un nombre valide.',
	'sendmail_from'				=> 'Le compte email doit être au format exemple@domaine.xxx.',
	'articles_auth_read'		=> 'Le rang minimum requis pour lire un article est invalide.',
	'articles_auth_new'			=> 'Le rang minimum requis pour poster un article est invalide.',
	'articles_auth_edit'		=> 'Le rang minimum requis pour éditer un article est invalide.',
	'articles_auth_delete'		=> 'Le rang minimum requis pour supprimer un article est invalide.'
);
