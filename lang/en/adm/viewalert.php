<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * viewalert
*/
$lang['viewalert'] = array (
	'manage_alerts'				=> 'Gestion des alertes',
	'view_alert'				=> 'Voir une alerte',
	'page_description'			=> 'Sur cette page sont centralisées toutes les informations sur l\'alerte, comme le titre du sujet et du forum, le lien contextuel du message et le message signalé ainsi que les informations sur celui-ci.',
	'actions_description'		=> 'Grâce aux boutons présents sur cette page, vous pouvez choisir de clore l\'alerte, d\'attribuer une sanction au posteur du message ou de simplement supprimer le message, selon le motif du signalement.',
	'validate'					=> 'Valider',
	'reason'					=> 'Motif',
	'no_alert'					=> 'Il n\'y a aucune alerte à afficher !',
	'view_message'				=> 'Voir le message',
	'do_nothing'				=> 'Ne rien faire',
	'delete_message'			=> 'Supprimer le message',
	'ban_temporarily'			=> 'Bannir temporairement',
	'ban_definitely'			=> 'Bannir définitivement',
	'alert_informations'		=> 'Informations sur l\'alerte',
	'alert_forum'				=> 'Forum de l\'alerte',
	'alert_subject'				=> 'Sujet de l\'alerte',
	'alert_reason'				=> 'Motif de l\'alerte',
	'alert_author'				=> 'Auteur de l\'alerte',
	'alert_date'				=> 'Date de l\'alerte ',
	'alert_author_ip'			=> 'IP de l\'auteur de l\'alerte',
	'alert_author_id'			=> 'ID de l\'auteur de l\'alerte',
	'forum_id'					=> 'ID du forum',
	'subject_id'				=> 'ID du sujet',
	'message_id'				=> 'ID du message',
	'poster_id'					=> 'ID du posteur',
	'alert_message'				=> 'Message de l\'alerte',
	'modify_alert_reason'		=> 'Modifier le motif de l\'alerte ',
	'modify_reason_description'	=> 'Si vous estimez que le motif indiqué dans l\'alerte n\'est pas le bon vous pouvez le modifier, vous devez cependant veiller à indiquer un nouveau motif correspondant au message signalé.',
	'alert_treated'				=> 'Cette alerte a été traitée.',
	'show_ipadress_whois'		=> 'Afficher le whois de l\'adresse IP',

	// javascript
	'confirm_action'			=> 'Êtes-vous sûr(e) de vouloir réaliser cette action ?',
	'alert'						=> 'Alerte',
	'cancel'					=> 'Annuler',
	'action_success'			=> 'L\'action a bien été effectuée.',
	'hide_message'				=> 'Cacher le message',
	'show_message'				=> 'Montrer le message',
	'click_to_enlarge'			=> 'Cliquez sur l\'image pour l\'agrandir',
	'show'						=> 'Afficher',
	'hide'						=> 'Masquer',

	// errors and form messages
	'invalid_form'				=> 'Le formulaire est invalide, veuillez retenter.',
	'incorrect_ids'				=> 'Les ids sont incorrects.',
	'incorrect_alert_id'		=> 'L\'id de l\'alerte est incorrect.',
	'incorrect_category_id'		=> 'L\'id de la catégorie est incorrect.',
	'incorrect_token'			=> 'Le jeton est expiré ou incorrect.',
	'error_occurred'			=> 'Une erreur est survenue',
	'errors_occurred'			=> 'Une ou plusieurs erreurs est/sont survenue(s) ',
	'files_not_deleted'			=> 'Les fichiers n\'ont pas pu être supprimés.',
	'reason_updated'			=> 'Le motif de l\'alerte a bien été modifié.',
	'identical_reason'			=> 'Le nouveau motif est identique au motif précédent.',
	'reason_not_exists'			=> 'Ce motif n\'existe pas.',
	'invalid_reason'			=> 'Vous devez indiquer un motif valide.',
	
	// left menu and breadcrumb
	'alerts_treated'			=> 'Alertes traitées',
	'banlist'					=> 'Bannissements',
);

/*
 * date
*/
$lang['date'] = array(
	'format'					=> 'j F Y à H:i:s'
);

$lang['days'] = array(
	'January'					=> 'janvier',
	'February'					=> 'février',
	'March'						=> 'mars',
	'April'						=> 'avril',
	'May'						=> 'mai',
	'June'						=> 'juin',
	'July'						=> 'juillet',
	'August'					=> 'août',
	'September'					=> 'septembre',
	'October'					=> 'octobre',
	'November'					=> 'novembre',
	'December'					=> 'décembre'
);
