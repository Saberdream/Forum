<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * overall template
*/
$lang['settings'] = array (
	// side menu
	'notifications'				=> 'Notifications',
	'account'					=> 'Compte',
	'subscriptions'				=> 'Abonnements',
	'avatars'					=> 'Avatars',
	'edit_settings'				=> 'Modifier ses informations',
	
	// form errors
	'errors_occured'			=> 'Une ou plusieurs erreurs doivent être corrigées ',
	'informations_updated'		=> 'Vos informations ont bien été mises à jour.',
	'incorrect_captcha'			=> 'Le code de confirmation n\'est pas correctement rempli/est incorrect.',
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_password'		=> 'Le mot de passe du compte est incorrect.',
	'enter_password'			=> 'Vous devez entrer un mot de passe.',
	'invalid_birthday'			=> 'Votre date de naissance est invalide.',
	'invalid_birthday_format'	=> 'Votre date de naissance doit être au format jj/mm/aaaa.',
	'invalid_sex'				=> 'Le sexe est invalide.',
	'invalid_password'			=> 'Le mot de passe doit comporter au maximum %d caractères.',
	'invalid_email'				=> 'L\'email est invalide.',
	'invalid_signature'			=> 'Votre signature doit comporter au maximum %d caractères.',
	'invalid_description'		=> 'Votre description personnelle doit comporter au maximum %d caractères.',
	'invalid_country'			=> 'Le pays doit comporter au maximum 50 caractères.',
	'invalid_style'				=> 'Le style est invalide.',
	'invalid_lang'				=> 'La langue est invalide.',
	'invalid_timezone'			=> 'Le fuseau horaire est invalide.',
	'invalid_avatar'			=> 'L\'avatar est invalide.',
	'update_error'				=> 'Une erreur est survenue durant la mise à jour des informations.',
	
	// form fields
	'password'					=> 'Mot de passe',
	'password_desc'				=> 'Uniquement pour le changer.',
	'email'						=> 'Email',
	'birthday'					=> 'Date de naissance',
	'day'						=> 'Jour',
	'month'						=> 'Mois',
	'year'						=> 'Année',
	'sex'						=> 'Sexe ',
	'country'					=> 'Pays',
	'country_desc'				=> '%d caractères au maximum',
	'lang'						=> 'Langue du site',
	'style'						=> 'Style du site',
	'not_specified'				=> 'Non spécifié',
	'no_avatar'					=> 'Pas d\'avatar',
	'no_avatar_uploaded'		=> 'Vous n\'avez envoyé aucun avatar.',
	'forum_signature'			=> 'Signature sur les forums',
	'forum_signature_desc'		=> 'Votre signature sera visible sur les forums sous chacun de vos posts.',
	'description'				=> 'Description personnelle',
	'description_desc'			=> 'Votre description sera visible depuis votre profil',
	'avatar'					=> 'Avatar',
	'send_avatar'				=> 'Envoyer un avatar',
	'ask_new_code'				=> 'Demander un nouveau code',
	'validate'					=> 'Valider',
	'copy_code'					=> 'Recopier le code',
	'enter_password'			=> 'Entrer le mot de passe',
	'enter_email'				=> 'Entrer l\'adresse email',
	'timezone'					=> 'Fuseau horaire',
);

$lang['settings_sexes'] = array (
	'm'							=> 'Masculin',
	'f'							=> 'Féminin',
);
