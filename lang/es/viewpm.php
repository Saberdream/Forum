<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * viewpm.php
*/
$lang['viewpm'] = array(
	'page'	=> 'Página',
	'refresh'	=> 'Actualizar',
	'reply'	=> 'Responder',
	'avatar'	=> 'Avatar',
	'click_to_enlarge'	=> 'Click en la imagen para ampliar',
	'show'	=> 'Mostrar',
	'hide'	=> 'Esconder',
	'preview'	=> 'Conocimiento',
	'read_message'	=> 'leer un mensaje',
	'read_private_message'	=> 'Leer un mensaje privado',
	'reply_to_message'	=> 'Responder a un mensaje',
	'participants'	=> 'asistentes',
	'participants_list'	=> '%d asistentes',
	'message_author'	=> 'autor del tema',
	'add_participants'	=> 'Agregar asistentes',
	'add'	=> 'Agregar',
	'no_post'	=> 'No hay publicaciones en este hilo.',
	'login_required'	=> 'Debes estar registrado y logueado para responder a los temas.',
	'not_own_message'	=> 'Solo puedes editar tus propias publicaciones.',
	'not_authorized_edit'	=> 'No tienes permiso para editar una publicación en este foro.',
	'expired_token'	=> 'El token está caducado o es incorrecto.',
	'not_logged_in'	=> 'Tu no estas conectado.',
	'poster_banned'	=> 'No puedes enviar un mensaje porque estás baneado.',
	'code_not_filled'	=> 'Debes rellenar el código de confirmación.',
	'incorrect_code'	=> 'El código de confirmación es incorrecto.',
	'alert'	=> 'Alerta',
	'action'	=> 'Existencias',
	'delete'	=> 'BORRAR',
	'close_discussion'	=> 'cerrar el hilo',
	'validate'	=> 'Validar',
	'confirm_action'	=> '¿Está seguro de que desea realizar esta acción en los elementos seleccionados?',
	'select_action'	=> 'Debe seleccionar una acción.',
	'select_element'	=> 'Debe seleccionar al menos un elemento.',
	'cancel'	=> 'anular',
	'check_all'	=> 'Comprobar todo',
	'successful_closed'	=> 'La discusión ha sido cerrada con éxito.',
	'exclude'	=> 'Excluir',
	'exclude_user'	=> 'Excluir este usuario',
	'user_correctly_excluded'	=> 'El usuario ha sido eliminado con éxito del chat.',
	'action_success'	=> 'La acción se ha realizado sobre los elementos seleccionados.',
	'error_occurred'	=> 'Se ha producido un error.',
	'reply_to_subject'	=> 'Responder a este tema',
	'subject'	=> 'Sujeto',
	'message'	=> 'Mensaje',
	'type_subject'	=> 'Introduce el asunto',
	'type_message'	=> 'Introducir mensaje',
	'request_new_code'	=> 'Solicitar un nuevo código',
	'copy_code'	=> 'copia el codigo',
	'post'	=> 'Publicar',
	'smileys_list'	=> 'lista de caritas',
	'not_authorized_reply'	=> 'No puede responder a los temas de este foro.',
	'not_authorized_access'	=> 'No tiene la autorización necesaria para acceder a esta parte del sitio.',
	'pm_closed'	=> 'Esta discusión está cerrada.',
	'message_not_filled'	=> 'Debes ingresar un mensaje.',
	'message_too_long'	=> 'Su mensaje es demasiado largo, debe contener un máximo de %d caracteres.',
	'flood_time_message'	=> 'Publicaste un mensaje hace menos de %d segundos, espera.',
	'expired_form'	=> 'El formulario está caducado o es incorrecto.',
	'errors_detected'	=> 'Se han detectado uno o más errores.',
	'message_not_posted'	=> 'El mensaje no fue enviado, inténtalo de nuevo.',
	'invalid_username'	=> 'El apodo "%s" no es válido.',
	'banned_user'	=> 'El usuario "%s" está prohibido.',
	'user_not_exists'	=> 'El usuario "%s" no existe.',
	'blacklisted_user'	=> 'Estás en la lista negra del usuario "%s".',
	'cant_add_user'	=> 'No puede agregar el usuario "%s".',
	'user_already_in'	=> 'El usuario "%s" ya está presente en el chat.',
	'user_duplicate'	=> 'El usuario "%s" está presente dos o más veces en la lista ingresada.',
	'no_user_too_long'	=> 'No ha ingresado un usuario o su lista de usuarios es demasiado larga.',
	'self_username'	=> 'No puedes enviarte un mensaje a ti mismo (no pero).',
	'users_successful_added'	=> 'Los usuarios se han agregado correctamente a la discusión.',
	'mailbox'	=> 'Bandeja de entrada',
	'blacklist'	=> 'Lista negra',
	'new_message'	=> 'Nuevo mensaje',
);

$lang['date'] = array(
	'format'	=> 'j F Y a H:i:s',
);

$lang['days'] = array(
	'January'	=> 'Enero',
	'February'	=> 'FEBRERO',
	'March'	=> 'marzo',
	'April'	=> 'abril',
	'May'	=> 'mayo',
	'June'	=> 'Junio',
	'July'	=> 'julio',
	'August'	=> 'agosto',
	'September'	=> 'septiembre',
	'October'	=> 'octubre',
	'November'	=> 'noviembre',
	'December'	=> 'Diciembre',
);