<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * blacklist.php
*/
$lang['bl'] = array(
	'not_logged_in'	=> 'Debe estar registrado y conectado para acceder a esta parte del sitio.',
	'no_blacklisted_user'	=> 'No hay usuarios en su lista negra.',
	'date'	=> 'Fecha',
	'rows'	=> 'Líneas',
	'total'	=> 'Total',
	'username'	=> 'Usuario',
	'token_expired'	=> 'El token está caducado o es incorrecto.',
	'add_new_users'	=> 'Agregar usuarios a su lista negra',
	'add'	=> 'Agregar',
	'delete'	=> 'BORRAR',
	'delete_selection'	=> 'Eliminar selección',
	'incorrect_ids'	=> 'Los identificadores no son válidos.',
	'usernames'	=> 'Usuarios',
	'expired_form'	=> 'El formulario está caducado o es incorrecto.',
	'invalid_form'	=> 'El formulario no es válido, inténtalo de nuevo.',
	'error_occurred'	=> 'Ocurrieron uno o más errores',
	'invalid_username'	=> 'El usuario "%s" no es válido.',
	'banned_user'	=> 'El usuario "%s" está prohibido.',
	'user_not_exists'	=> 'El usuario "%s" no existe.',
	'cant_add_user'	=> 'No puede agregar el usuario "%s".',
	'user_duplicate'	=> 'El usuario "%s" está presente dos o más veces en la lista.',
	'users_not_exists'	=> 'Los usuarios no existen.',
	'self_username'	=> 'No puede agregarse a su lista negra.',
	'already_blacklisted'	=> 'El usuario "%s" ya está en su lista negra.',
	'no_user_too_long'	=> 'No ha ingresado un usuario o su lista de usuarios es demasiado larga.',
	'user_successful_added'	=> 'Los usuarios se han agregado con éxito a su lista negra.',
	'too_many_users'	=> 'Ha agregado demasiados usuarios a su lista negra, elimine algunos para poder agregar otros nuevos.',
	'mailbox'	=> 'Bandeja de entrada',
	'blacklist'	=> 'Lista negra',
	'new_message'	=> 'Nuevo mensaje',
	'confirm_action'	=> '¿Está seguro de que desea realizar esta acción en los elementos seleccionados?',
	'select_action'	=> 'Debe seleccionar una acción.',
	'select_element'	=> 'Debe seleccionar al menos un elemento.',
	'alert'	=> 'Alerta',
	'cancel'	=> 'anular',
	'action_success'	=> 'La acción se ha realizado sobre los elementos seleccionados.',
	'confirm_delete'	=> '¿Está seguro de que desea eliminar este elemento?',
	'users_deleted'	=> 'Los usuarios han sido eliminados con éxito.',
);
