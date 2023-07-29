<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * login.php
*/
$lang['login'] = array(
	'not_authorized'	=> 'No está autorizado para acceder a esta parte del sitio.',
	'connect'	=> 'Acceso',
	'connect_acp'	=> 'Inicio de sesión en el panel de administración',
	'page_description'	=> 'Puede optar por configurar una cookie para habilitar el inicio de sesión automático para que no tenga que volver a iniciar sesión en su próxima visita.',
	'page_description_acp'	=> 'Bienvenido a la página de inicio de sesión del panel de administración. ',
	'username'	=> 'Seudo',
	'password'	=> 'Contraseña',
	'validate'	=> 'Validar',
	'already_connected'	=> 'Ya estás conectado.',
	'already_connected_acp'	=> 'Ya estás logueado en la administración.',
	'copy_code'	=> 'copia el codigo',
	'ask_new_code'	=> 'Solicitar un nuevo código',
	'enter_username'	=> 'Introduce el apodo',
	'errors_occurred'	=> 'Ocurrieron uno o más errores',
	'automatic_connection'	=> 'Conexión automática',
	'account'	=> 'Mi cuenta',
	'users_connected'	=> 'Usuarios conectados',
);

$lang['form_errors'] = array(
	'enter_password'	=> 'Debe introducir una contraseña.',
	'incorrect_username'	=> 'El apodo es incorrecto.',
	'incorrect_captcha'	=> 'El código de confirmación no se rellena correctamente/es incorrecto.',
	'invalid_form'	=> 'El formulario no es válido, inténtalo de nuevo.',
);

$lang['login_errors'] = array(
	'invalid_username'	=> 'El apodo no es válido.',
	'username_not_exists'	=> 'Este apodo no existe.',
	'cant_connect_guest'	=> 'No puede iniciar sesión en una cuenta de invitado.',
	'too_many_attempts'	=> 'Ha realizado demasiados intentos de inicio de sesión, debe esperar otros %d segundo(s) antes de volver a intentar iniciar sesión.',
	'incorrect_password'	=> 'La contraseña de la cuenta es incorrecta.',
	'permanently_banned'	=> 'El apodo está prohibido por el motivo "%s" por un período permanente.',
	'temporarily_banned'	=> 'El apodo está prohibido por el motivo "%s" por una duración de %d día(s).',
	'session_error'	=> 'Sesión no válida o inexistente, inténtelo de nuevo más tarde.',
);
