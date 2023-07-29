<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * recover.php
*/
$lang['recover'] = array(
	'forgot_password'	=> 'contraseña olvidada',
	'account'	=> 'Cuenta',
	'subscriptions'	=> 'Suscripciones',
	'avatars'	=> 'avatares',
	'registration'	=> 'Registro',
	'recover_info'	=> 'Ingrese su apodo y el correo electrónico asociado a la cuenta para recibir su contraseña por correo electrónico',
	'users_connected'	=> 'Usuarios conectados',
	'error_occured'	=> 'Se ha producido un error',
	'errors_occured'	=> 'Uno o más errores deben ser corregidos',
	'informations_updated'	=> 'Su información ha sido actualizada con éxito.',
	'incorrect_captcha'	=> 'El código de confirmación no se rellena correctamente/es incorrecto.',
	'invalid_form'	=> 'El formulario no es válido, inténtalo de nuevo.',
	'invalid_sex'	=> 'El género no es válido.',
	'invalid_username'	=> 'El apodo no es válido, debe tener de 3 a 15 caracteres y consistir solo de números, letras y/o guiones.',
	'ip_banned'	=> 'Su dirección IP está prohibida.',
	'email_banned'	=> 'Esta dirección de correo electrónico está prohibida.',
	'invalid_password'	=> 'La contraseña debe tener un máximo de 30 caracteres.',
	'invalid_email'	=> 'El correo electrónico es invalido.',
	'email_sent_success'	=> 'Su información de inicio de sesión se ha enviado a la dirección de correo electrónico que proporcionó al crear su cuenta.',
	'username_not_exists'	=> 'Este apodo no existe.',
	'cant_recover_password'	=> 'No puede recuperar la contraseña de esta cuenta.',
	'username_email_not_match'	=> 'El nombre de usuario de la cuenta y la dirección de correo electrónico no coinciden.',
	'mail_not_sent'	=> 'Se ha producido un error y no se ha podido enviar el correo electrónico. Vuelve a intentarlo más tarde.',
	'username'	=> 'Seudo',
	'password'	=> 'Contraseña',
	'email'	=> 'Correo electrónico',
	'ask_new_code'	=> 'Solicitar un nuevo código',
	'validate'	=> 'Validar',
	'copy_code'	=> 'copia el codigo',
	'enter_password'	=> 'Introducir la contraseña',
	'enter_email'	=> 'Introducir la dirección de correo electrónico',
	'enter_username'	=> 'Introduce el apodo',
	'password_confirmation'	=> 'Confirmación de contraseña',
	'confirm_password'	=> 'Confirmar la contraseña',
	'password_recovery'	=> 'Recuperando tu contraseña',
	'mail_body'	=> 'Hola, ha solicitado una recuperación de su contraseña por correo electrónico en el sitio <a href="%s">%s</a>, recuerde esta información y tenga cuidado de no perderla.<br /> <br / ><p>Tu apodo: <span style="color:#C00;">%s</span></p><p>Tu contraseña: <span style="color:#C00; ">%s< /span></p><br /><br />Hasta pronto en %s',
);
