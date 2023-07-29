<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * mod.php
*/
$lang['mod_errors'] = array(
	'not_authorized_access'	=> 'No puede acceder a esta sección.',
	'incorrect_forum_id'	=> 'Identificación del foro no válida.',
	'forum_not_found'	=> 'Foro no encontrado.',
	'not_moderator'	=> 'No eres moderador de este foro.',
	'expired_token'	=> 'El token está caducado o es incorrecto.',
	'no_topic_selected'	=> 'No se ha seleccionado ningún tema.',
	'incorrect_ids'	=> 'Las identificaciones son incorrectas.',
	'incorrect_action'	=> 'Esta acción es incorrecta.',
	'not_authorized_action'	=> 'No tiene el permiso necesario para realizar esta acción.',
	'max_sticky_reached'	=> 'Se ha alcanzado el número máximo de temas anclados (%d).',
	'topic_not_found'	=> 'Asunto eliminado o identificación incorrecta.',
	'no_topic_affected'	=> 'Ningún tema/publicación se vio afectado por la consulta.',
	'action_success'	=> 'Acción completada con éxito, %d publicaciones/temas afectados.',
	'incorrect_topic_id'	=> 'Identificación de sujeto no válida.',
	'incorrect_post_id'	=> 'ID de mensaje incorrecto.',
	'incorrect_user_id'	=> 'Identificación de usuario incorrecta.',
	'error_occurred'	=> 'Se ha producido un error',
);
