<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * user edit
*/
$lang['user_edit'] = array (
	'manage_users'				=> 'Gestion des utilisateurs',
	'edit_user'					=> 'Modifier un utilisateur',
	'validate'					=> 'Valider',
	'save'						=> 'Sauvegarder',
	'edit_user_informations'	=> 'Editer les informations de l\'utilisateur',
	'user_informations'			=> 'Informations de l\'utilisateur',
	'search_results'			=> '%d résultat(s) pour la recherche de « <strong>%s</strong> »',
	'search_no_result'			=> 'Aucun résultat pour la recherche de « <strong>%s</strong> », essayez une nouvelle fois avec des mot-clés plus précis.',
	'no_user'					=> 'Il n\'y a aucun utilisateur !',
	'user_have_no_avatar'		=> 'L\'utilisateur n\'a pas choisi d\'avatar.',
	'incorrect_user_id'			=> 'L\'id de l\'utilisateur est incorrect.',
	'user_informations_updated'	=> 'Les informations du compte ont bien été mises à jour.',
	'errors_occurred'			=> 'Une ou plusieurs erreurs est/sont survenue(s) ',

	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action sur les éléments sélectionnés ?',
	'select_action'				=> 'Vous devez sélectionner une action.',
	'select_element'			=> 'Vous devez sélectionner au moins un élément.',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'user_deleted'				=> 'L\'utilisateur a bien été supprimé.',
	'action_success'			=> 'L\'action a bien été effectuée sur les éléments sélectionnés.',

	// left menu and breadcrumb
	'banlist'					=> 'Bannissements',
	'avatars'					=> 'Avatars',

	// form fields names
	'username'					=> 'Nom d\'utilisateur',
	'password'					=> 'Mot de passe',
	'email'						=> 'Email',
	'ip'						=> 'Adresse IP',
	'time'						=> 'Date d\'inscription',
	'last'						=> 'Date du dernier passage',
	'rank'						=> 'Rang',
	'sex'						=> 'Sexe',
	'birthday'					=> 'Date de naissance',
	'sign'						=> 'Signature sur les forums',
	'desc'						=> 'Description',
	'posts'						=> 'Nombre de messages postés',
	'avatar'					=> 'Avatar',
	'country'					=> 'Pays',
	'style'						=> 'Style',
	'lang'						=> 'Langue',
	'timezone'					=> 'Fuseau horaire',

	// form fields descriptions
	'password_desc'				=> 'Entre 1 et 30 caractères.',
	'email_desc'				=> 'exemple@domaine.com',
	'ip_desc'					=> 'Actualisée à chaque connexion.',
	'time_desc'					=> 'Au format timestamp.',
	'last_desc'					=> 'Au format timestamp.',
	'birthday_desc'				=> 'Doit être au format jj/mm/aaaa.',
	'sign_desc'					=> 'Signature visible sur les forums sous chacun des posts.',
	'desc_desc'					=> 'Description visible sur le profil.',
	'posts_desc'				=> 'Messages postés sur les forums.',
	'country_desc'				=> '50 caractères au maximum.',

	// form errors
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_ids'				=> 'Les ids sont incorrects.',
	'incorrect_user_id'			=> 'L\'id de l\'utilisateur est incorrect.',
	'incorrect_category_id'		=> 'L\'id de la catégorie est incorrect.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'error_occurred'			=> 'Une erreur est survenue',
	'files_not_deleted'			=> 'Les fichiers n\'ont pas pu être supprimés.',
	'not_authorized_to_modify'	=> 'Vous n\'avez pas l\'autorisation de modifier ce compte.',
	'invalid_password'			=> 'Le mot de passe est invalide.',
	'invalid_email'				=> 'L\'email est invalide.',
	'invalid_ip'				=> 'L\'adresse IP est invalide.',
	'invalid_registration_date'	=> 'La date d\'inscription est invalide.',
	'invalid_last_connection'	=> 'La date du dernier passage est invalide.',
	'invalid_rank'				=> 'Le rang est invalide.',
	'not_allowed_modify_rank'	=> 'Vous ne pouvez pas modifier le rang de cet utilisateur.',
	'incorrect_gender'			=> 'Le genre est incorrect.',
	'invalid_birthday'			=> 'La date de naissance n\'a pas un format valide.',
	'invalid_country'			=> 'Le pays doit comporter au maximum 50 caractères.',
	'invalid_style'				=> 'Le style est invalide.',
	'invalid_lang'				=> 'La langue est invalide.',
	'user_not_exists'			=> 'Cet utilisateur n\'existe pas ou est introuvable !',
	'invalid_timezone'			=> 'Le fuseau horaire est invalide.',
	'update_error'				=> 'Une erreur est survenue durant la mise à jour des informations.',
	'not_specified'				=> 'Non spécifié',
);

$lang['user_edit_ranks'] = array(
	'user'						=> 'Utilisateur',
	'moderator'					=> 'Modérateur',
	'administrator'				=> 'Administrateur',
);

$lang['user_edit_sexes'] = array (
	'm'							=> 'Masculin',
	'f'							=> 'Féminin',
);
