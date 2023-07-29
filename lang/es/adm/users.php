<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * users.php
*/
$lang['users'] = array(
	'manage_users'	=> 'Gestión de usuarios',
	'exact'	=> 'Exacto',
	'search'	=> 'Buscar',
	'back'	=> 'Comentario',
	'total'	=> 'Total',
	'rows'	=> 'Líneas',
	'ban'	=> 'Prohibición',
	'unban'	=> 'Desbanear',
	'delete'	=> 'BORRAR',
	'validate'	=> 'Validar',
	'id'	=> 'IDENTIFICACIÓN',
	'username'	=> 'Seudo',
	'ip'	=> 'IP',
	'date'	=> 'Fecha',
	'last'	=> 'Último',
	'action'	=> 'Existencias',
	'edit_user_informations'	=> 'Editar información del usuario',
	'search_results'	=> '%d resultado(s) de la búsqueda de "<strong>%s</strong>"',
	'search_no_result'	=> 'No se encontraron resultados para "<strong>%s</strong>", vuelva a intentarlo con palabras clave más específicas.',
	'no_user'	=> '¡No hay usuarios!',
	'confirm_action'	=> '¿Está seguro de que desea realizar esta acción en los elementos seleccionados?',
	'select_action'	=> 'Debe seleccionar una acción.',
	'select_element'	=> 'Debe seleccionar al menos un elemento.',
	'alert'	=> 'Alerta',
	'cancel'	=> 'anular',
	'user_deleted'	=> 'El usuario ha sido eliminado con éxito.',
	'action_success'	=> 'La acción se ha realizado sobre los elementos seleccionados.',
	'invalid_form'	=> 'El formulario no es válido, inténtalo de nuevo.',
	'incorrect_ids'	=> 'Los identificadores son incorrectos.',
	'incorrect_category_id'	=> 'El ID de la categoría es incorrecto.',
	'incorrect_token'	=> 'El token está caducado o es incorrecto.',
	'error_occurred'	=> 'Se ha producido un error',
	'files_not_deleted'	=> 'No se pudieron eliminar los archivos.',
	'banlist'	=> 'Prohibiciones',
	'avatars'	=> 'avatares',
);

$lang['search_options'] = array(
	'id'	=> 'IDENTIFICACIÓN',
	'username'	=> 'Seudo',
	'ip'	=> 'IP',
	'email'	=> 'Correo electrónico',
);
