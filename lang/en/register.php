<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * overall template
*/
$lang['register'] = array (
	// side menu
	'notifications'				=> 'Notifications',
	'account'					=> 'Compte',
	'subscriptions'				=> 'Abonnements',
	'avatars'					=> 'Avatars',
	'registration'				=> 'Inscription',

	// form errors
	'error_occured'				=> 'Une erreur est survenue',
	'errors_occured'			=> 'Une ou plusieurs erreurs doivent être corrigées ',
	'informations_updated'		=> 'Vos informations ont bien été mises à jour.',
	'incorrect_captcha'			=> 'Le code de confirmation n\'est pas correctement rempli/est incorrect.',
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_password'		=> 'Le mot de passe du compte est incorrect.',
	'enter_password'			=> 'Vous devez entrer un mot de passe.',
	'invalid_birthday'			=> 'Votre date de naissance doit être au format jj/mm/aaaa.',
	'invalid_sex'				=> 'Le sexe est invalide.',
	'invalid_username'			=> 'Le pseudo est invalide, il doit comporter de 3 à 15 caractères et se composer uniquement de chiffres, lettres et/ou tirets.',
	'username_already_taken'	=> 'Ce pseudo est déjà réservé, merci d\'en choisir un autre.',
	'passwords_not_identical'	=> 'Le mot de passe et la confirmation doivent être identiques.',
	'email_already_taken'		=> 'Cette adresse email est déjà liée à un autre compte.',
	'ip_banned'					=> 'Votre adresse IP est bannie.',
	'email_banned'				=> 'Cette adresse email est bannie.',
	'registration_closed'		=> 'Les inscriptions sont fermées pour le moment, merci de revenir ultérieurement.',
	'invalid_password'			=> 'Le mot de passe doit comporter au maximum 30 caractères.',
	'invalid_email'				=> 'L\'email est invalide.',
	'must_accept_terms'			=> 'Vous devez lire et accepter les conditions générales d\'utilisation.',
	'account_created'			=> 'Votre compte a bien été créé, vous êtes connecté. Voici vos identifiants :<br />Pseudo : %s<br />Mot de passe : %s',

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
	'accept_terms'				=> 'J\'ai lu et j\'accepte les <a href="%s">conditions générales d\'utilisation</a>',
	'terms_of_use'				=> 'Conditions générales d\'utilisation du site',
	'terms_text'				=> '<p><strong>Cette charte a pour but de détailler les conditions d\'utilisation du site ainsi que ses règles.</strong></p>
	<h5>Préambule</h5>
	<p>En cliquant sur accepter, je reconnais que ni %s, ni son équipe, ni son hébergeur ne pourraient être tenus pour responsables du contenu et des messages postés par les utilisateurs sur les forums, en particulier, ceux-ci ne pourraient être tenus pour responsables si des messages contenaient des contenus illégaux, choquant ou autre contenu illicite. De plus, l\'équipe du site se réserve le droit de supprimer tout sujet n\'étant pas conforme aux règles de bonne conduite sur les forums, et de bannir son créateur en cas de transgression des règles du forum sur lequel il poste, selon le niveau de gravité de celle-ci. Le site et son équipe ne pourraient également pas être tenus pour responsables en cas de violation par un utilisateur d\'un copyright, de droits d\'auteurs ou d\'une licence quelquonque (Creative Commons par exemple).</p>
	<p>En acceptant ces conditions d\'utilisation, je reconnais également être âgé de plus de 15 ans, ou d\'avoir obtenu l\'accord de mon représentant légal pour procéder à mon inscription sur ce site. Le site ne saurait être tenu pour responsable si je ne suis pas majeur, et qu\'un autre utilisateur poste un contenu choquant et non adapté à un enfant de moins de 15 ans.</p>
	<h5>Règles d\'utilisation du site et de ses forums</h5>
	<p>Il existe quelques règles à suivre pour préserver une bonne ambiante ainsi qu\'une bonne lisibilité en particulier sur les forums, entre autre :<br />
	- Ne pas flooder,<br />
	- Ne pas insulter autrui et respecter les autres utilisateurs,<br />
	- Ne pas faire de remarques discriminantes ou incitant à la haine contre un genre, une ethnie ou une religion,<br />
	- Ne pas booster/faire du freepost (messages sans but),<br />
	- Lire les règles du forum établies par le modérateur si il y a lieu,<br />
	- Faire une recherche avant de créer un sujet pour vérifier que la question n\'a pas déjà été posée auparavant,<br />
	- Eviter un maximum le language SMS (en abrégé) et avoir un orthographe correct afin de conserver le forum lisible.<br /><br />
	Egalement, ne seront pas tolérés :<br />
	- Les messages diffamatoires portant atteinte à la dignité d\'autrui,<br />
	- La divulgation d\'informations personnelles sur un autre utilisateur ou une autre personne,<br />
	- Les incitations au comportement violent ou haineux portant atteinte à l\'intégrité physique ou morale d\'autrui,<br />
	- La pédopornographie sera très lourdement sanctionnée à la fois par le site et par les autorités compétentes du pays à la fois du site et du pays dans lequel je réside,<br />
	- La publicité pour une quelconque plateforme ou site, comme une chaine monétisée ou un lien de parrainage.<br /><br />
	Tout manquement à l\'une de ces règles <strong>peut conduire à un bannissement temporaire voir définitif du compte</strong> si récidive selon la gravité de la faute commise par l\'utilisateur. Si un modérateur estime qu\'un utilisateur ne suit pas les règles, il est en mesure de faire une demande de bannissement qui <strong>sera traitée de façon prioritaire</strong> par l\'administration du site.</p>
	<h5>Données personnelles</h5>
	<p>J\'accepte que mes données personnelles soient conservées dans une base de données à partir de mon inscription et ce pendant toute la durée de mon utilisation du site, jusqu\'à que je formule explicitement le souhait par écrit de la suppression de mon compte. Mes données personnelles (adresse e-mail, pays...) sont conservées par le site dans un but d\'optimisation de l\'expérience utilisateur du site et je peux y accéder à tout moment en formulant une demande écrite au webmaster.</p>
	<p><strong style="color:#F00;">Le site se réserve le droit de modifier les conditions d\'utilisation à tout moment.</strong></p>',
);
