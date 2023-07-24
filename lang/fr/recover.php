<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * overall template
*/
$lang['recover'] = array (
	// side menu
	'forgot_password'			=> 'Mot de passe oublié',
	'account'					=> 'Compte',
	'subscriptions'				=> 'Abonnements',
	'avatars'					=> 'Avatars',
	'registration'				=> 'Inscription',
	'recover_info'				=> 'Entrez votre pseudo ainsi que l\'email associée au compte pour recevoir votre mot de passe par mail',
	'users_connected'			=> 'Utilisateurs connectés',

	// form errors
	'error_occured'				=> 'Une erreur est survenue',
	'errors_occured'			=> 'Une ou plusieurs erreurs doivent être corrigées ',
	'informations_updated'		=> 'Vos informations ont bien été mises à jour.',
	'incorrect_captcha'			=> 'Le code de confirmation n\'est pas correctement rempli/est incorrect.',
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'invalid_sex'				=> 'Le sexe est invalide.',
	'invalid_username'			=> 'Le pseudo est invalide, il doit comporter de 3 à 15 caractères et se composer uniquement de chiffres, lettres et/ou tirets.',
	'ip_banned'					=> 'Votre adresse IP est bannie.',
	'email_banned'				=> 'Cette adresse email est bannie.',
	'invalid_password'			=> 'Le mot de passe doit comporter au maximum 30 caractères.',
	'invalid_email'				=> 'L\'email est invalide.',
	'email_sent_success'		=> 'Vos informations de connexion vous ont été envoyées à l\'adresse email que vous avez renseignée lors de la création de votre compte.',
	'username_not_exists'		=> 'Ce pseudo n\'existe pas.',
	'cant_recover_password'		=> 'Vous ne pouvez pas récupérer le mot de passe de ce compte.',
	'username_email_not_match'	=> 'Le pseudo et l\'adresse email du compte ne correspondent pas.',
	'mail_not_sent'				=> 'Une erreur est survenue et l\'email n\'a pas pu être envoyé, veuillez retenter votre requête ultérieurement.',

	// form fields
	'username'					=> 'Pseudo',
	'password'					=> 'Mot de passe',
	'email'						=> 'Email',
	'ask_new_code'				=> 'Demander un nouveau code',
	'validate'					=> 'Valider',
	'copy_code'					=> 'Recopier le code',
	'enter_password'			=> 'Entrer le mot de passe',
	'enter_email'				=> 'Entrer l\'adresse email',
	'enter_username'			=> 'Entrer le pseudo',
	'password_confirmation'		=> 'Confirmation du mot de passe',
	'confirm_password'			=> 'Confirmez le mot de passe',
	
	// mail body
	'password_recovery'			=> 'Récupération de votre mot de passe',
	'mail_body'					=> 'Bonjour, vous avez demandé une récupération de votre mot de passe par mail sur le site <a href="%s">%s</a>, veuillez retenir ces informations et bien veiller à ne pas les perdre.<br /><br /><p>Votre pseudo : <span style="color:#C00;">%s</span></p><p>Votre mot de passe : <span style="color:#C00;">%s</span></p><br /><br />A bientôt sur %s',
);
