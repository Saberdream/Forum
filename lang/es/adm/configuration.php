<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * configuration.php
*/
$lang['config'] = array(
	'site_configuration'	=> 'Configuración del sitio',
	'page_description'	=> 'Aquí puede configurar los ajustes de su foro.',
	'save'	=> 'Para salvaguardar',
	'yes'	=> 'Sí',
	'no'	=> 'No',
	'settings_saved'	=> 'Su configuración se ha tenido en cuenta.',
	'writing_error'	=> 'Ocurrió un error al escribir el archivo de configuración.',
	'invalid_form'	=> 'El formulario no es válido, inténtalo de nuevo.',
	'errors_occurred'	=> 'Ocurrieron uno o más errores',
	'update_error'	=> 'Error al actualizar la configuración.',
	'error_logs'	=> 'Registros de errores',
	'styles'	=> 'estilos',
	'visitors'	=> 'Visitantes',
	'members'	=> 'miembros',
	'moderators'	=> 'Moderadores',
	'administrators'	=> 'Administrador',
);

$lang['cat_names'] = array(
	'general_configuration'	=> 'Configuración general',
	'users_configuration'	=> 'Configuración de usuarios',
	'forums_configuration'	=> 'Configuración de foros',
	'avatars_configuration'	=> 'Configuración de avatares',
	'files_upload_configuration'	=> 'Configurar cargas de archivos',
	'server_configuration'	=> 'Configuración del servidor',
	'pm_configuration'	=> 'Configuración de mensajes privados',
	'articles_configuration'	=> 'Configuración de elementos',
);

$lang['config_names'] = array(
	'site_name'	=> 'nombre del sitio',
	'site_description'	=> 'Descripción del lugar',
	'domain_name'	=> 'dominio del sitio',
	'site_mail'	=> 'Correo electrónico del sitio web',
	'default_style'	=> 'Estilo por Defecto',
	'default_timezone'	=> 'Zona horaria predeterminada',
	'user_style'	=> 'Permitir estilo de usuario',
	'site_open'	=> 'sitio web abierto',
	'site_closed_reason'	=> 'Motivo del cierre',
	'allow_register'	=> 'Permitir registros',
	'desc_max_size'	=> 'Tamaño máximo de descripción',
	'activate_sign'	=> 'Habilitar firmas',
	'sign_max_size'	=> 'Tamaño máximo de firmas',
	'form_expiration_time'	=> 'Tiempo de caducidad del formulario',
	'session_expiration_time'	=> 'Tiempos de espera de sesión',
	'max_autologin_time'	=> 'Duración máxima de una sesión',
	'sessions_per_ip'	=> 'máx. ',
	'max_login_attempts'	=> 'Número máximo de intentos de inicio de sesión',
	'attempt_wait_time'	=> 'Tiempo antes de reintentar',
	'cookies_expiration_time'	=> 'Tiempo de caducidad de las cookies',
	'cookies_name'	=> 'Nombre de la cookie de inicio de sesión',
	'max_subscribes'	=> 'máx. ',
	'load_limit'	=> 'Limitar la carga del servidor',
	'notifications_limit'	=> 'máx. ',
	'welcome_message'	=> 'Mensaje de bienvenida al registrarse',
	'topics_per_page'	=> 'Temas por página',
	'posts_per_page'	=> 'Publicaciones por página',
	'topic_flood_time'	=> 'Tiempo de inundación del tema',
	'post_flood_time'	=> 'Tiempo de inundación de mensajes',
	'captcha_newtopic'	=> 'Captcha para crear un nuevo tema',
	'captcha_reply'	=> 'Captcha para responder a un tema',
	'topic_max_size'	=> 'Longitud máxima del tema',
	'post_max_size'	=> 'Longitud máxima del mensaje',
	'max_sticky_topics'	=> 'Número máximo de pines',
	'post_max_smilies'	=> 'Número máximo de caritas',
	'activate_avatar'	=> 'Habilitar avatares',
	'avatar_max_height'	=> 'Altura máxima del avatar',
	'avatar_max_width'	=> 'Ancho máximo de avatar',
	'avatar_max_size'	=> 'Peso máximo de avatar',
	'avatar_max_files'	=> 'No. ',
	'avatar_wait_time'	=> 'Límite de tiempo entre subidas',
	'avatar_allowed_types'	=> 'Tipos de archivo permitidos',
	'max_avatars_per_user'	=> 'máx. ',
	'activate_upload'	=> 'Habilitar carga de archivos',
	'upload_max_height'	=> 'Altura máxima del archivo',
	'upload_max_width'	=> 'Ancho máximo de archivo',
	'upload_max_size'	=> 'Tamaño máximo de archivo',
	'upload_max_files'	=> 'No. ',
	'upload_wait_time'	=> 'Límite de tiempo entre subidas',
	'upload_allowed_types'	=> 'Tipos de archivo permitidos',
	'session_gc_probability'	=> 'Probabilidad de habilitar la descarga de sesión',
	'table_prefix'	=> 'Tabla de prefijos',
	'default_lang'	=> 'Idioma predeterminado del sitio',
	'server_protocol'	=> 'protocolo del servidor',
	'post_redirection_time'	=> 'Tiempo de dirección después de publicar un tema/mensaje',
	'smtp_server'	=> 'servidor SMTP',
	'smtp_port'	=> 'Puerto del servidor SMTP',
	'sendmail_from'	=> 'Cuenta de correo electrónico',
	'activate_pm'	=> 'Habilitar mensajes privados',
	'pm_flood_time'	=> 'Tiempo de inundación entre cada mensaje',
	'pm_reply_flood_time'	=> 'Tiempo de inundación entre cada respuesta',
	'pm_captcha'	=> 'Captcha para nuevas publicaciones',
	'pm_reply_captcha'	=> 'Captcha para respuestas',
	'pm_max_size'	=> 'Longitud máxima de los títulos de PM',
	'pm_reply_max_size'	=> 'Longitud máxima de respuesta',
	'pm_max_smilies'	=> 'Número máximo de emoticonos en las respuestas',
	'pm_max_participants'	=> 'Número máximo de participantes de PM',
	'activate_articles'	=> 'Habilitar artículos',
	'articles_flood_time'	=> 'Tiempo de inundación entre artículos',
	'articles_captcha'	=> 'Captcha para artículos',
	'articles_title_max_size'	=> 'Número máximo de caracteres para títulos de artículos',
	'articles_text_min_size'	=> 'Número mínimo de caracteres para el texto del artículo',
	'articles_text_max_size'	=> 'Número máximo de caracteres del texto de los artículos',
	'articles_auth_read'	=> 'Rango requerido para leer un artículo',
	'articles_auth_new'	=> 'Rango requerido para publicar un artículo',
	'articles_auth_edit'	=> 'Rango requerido para editar un artículo',
	'articles_auth_delete'	=> 'Rango requerido para eliminar un artículo',
);

$lang['config_descriptions'] = array(
	'form_expiration_time'	=> 'Número de segundos (900 por defecto)',
	'session_expiration_time'	=> 'Número de segundos (3600 por defecto)',
	'max_autologin_time'	=> 'Número de segundos (259200 por defecto)',
	'sessions_per_ip'	=> 'Vale 10 por defecto',
	'max_login_attempts'	=> '5 por defecto',
	'attempt_wait_time'	=> 'Número de segundos (3600 por defecto)',
	'cookies_expiration_time'	=> 'Número de días',
	'cookies_name'	=> 'Para personalizar el nombre de la cookie de inicio de sesión automático',
	'load_limit'	=> 'Limite la carga máxima del servidor (en %, 0 para deshabilitar)',
	'max_subscribes'	=> 'Número máximo de temas a los que un usuario puede suscribirse (0 para deshabilitar)',
	'notifications_limit'	=> 'Limite la cantidad de notificaciones durante una respuesta para reducir la carga del servidor (0 para deshabilitar)',
	'topic_flood_time'	=> 'Número de segundos',
	'post_flood_time'	=> 'Número de segundos',
	'topic_max_size'	=> 'Número de caracteres',
	'post_max_size'	=> 'Número de caracteres',
	'avatar_max_height'	=> 'número de píxeles',
	'avatar_max_width'	=> 'número de píxeles',
	'avatar_max_size'	=> 'Número de millones',
	'avatar_max_files'	=> 'Número de archivos (0 para ilimitado)',
	'avatar_wait_time'	=> 'Número de segundos (0 para ilimitado)',
	'max_avatars_per_user'	=> '0 para ilimitado',
	'upload_max_height'	=> 'número de píxeles',
	'upload_max_width'	=> 'número de píxeles',
	'upload_max_size'	=> 'Número de millones',
	'upload_max_files'	=> 'Número de archivos',
	'upload_wait_time'	=> 'Número de segundos',
	'session_gc_probability'	=> 'En número de % (1 por defecto)',
	'table_prefix'	=> 'Cambiar esta configuración puede comprometer el correcto funcionamiento del sitio, solo cambie esta configuración si sabe lo que está haciendo',
	'server_protocol'	=> 'Cambie este valor solo si desea especificar un protocolo diferente del protocolo predeterminado',
	'post_redirection_time'	=> 'Número de segundos (5 por defecto)',
	'sendmail_from'	=> 'No es necesariamente la misma dirección de correo electrónico que el correo electrónico del sitio, pero debe ser una cuenta válida correspondiente a su host.',
	'pm_flood_time'	=> 'Número de segundos',
	'pm_reply_flood_time'	=> 'Número de segundos',
	'articles_flood_time'	=> 'Número de segundos',
	'pm_max_participants'	=> '0 para ilimitado',
);

$lang['config_errors'] = array(
	'activate_avatar'	=> 'La configuración del avatar no es válida.',
	'activate_pm'	=> 'La configuración de mensajes privados no es válida.',
	'activate_sign'	=> 'La configuración de la firma no es válida.',
	'activate_upload'	=> 'Los parámetros de subida no son válidos.',
	'allow_register'	=> 'La configuración para nuevos registros no es válida.',
	'attempt_wait_time'	=> 'El número de intentos de inicio de sesión no es válido.',
	'avatar_allowed_types'	=> 'Debe ingresar extensiones permitidas válidas para envíos de avatares.',
	'avatar_max_files'	=> 'El número máximo de cargas simultáneas debe ser un número válido.',
	'avatar_max_height'	=> 'La altura máxima del avatar debe ser un número válido.',
	'avatar_max_size'	=> 'El peso máximo del avatar debe ser un número válido.',
	'avatar_max_width'	=> 'El ancho máximo del avatar debe ser un número válido.',
	'avatar_wait_time'	=> 'El tiempo de espera entre varias cargas simultáneas debe ser un número válido.',
	'captcha_newtopic'	=> 'La configuración de mensajes privados no es válida.',
	'captcha_reply'	=> 'La configuración de mensajes privados no es válida.',
	'cookies_expiration_time'	=> 'El tiempo de caducidad de la cookie debe ser un número válido.',
	'cookies_name'	=> 'El nombre de la cookie de inicio de sesión no debe estar vacío y debe contener un máximo de 1000 caracteres alfanuméricos o _.',
	'desc_max_size'	=> 'El límite de caracteres de la descripción del perfil debe ser un número válido.',
	'domain_name'	=> 'El nombre de dominio no es válido.',
	'default_style'	=> 'El estilo predeterminado del foro no es válido.',
	'default_timezone'	=> 'La zona horaria predeterminada no es válida.',
	'user_style'	=> 'La configuración de permisos de estilo de usuario no es válida.',
	'max_avatars_per_user'	=> 'El número máximo de avatares por usuario debe ser un número válido.',
	'max_login_attempts'	=> 'El tiempo de espera antes de un nuevo intento de conexión no es válido.',
	'max_sticky_topics'	=> 'El número máximo de temas anclados por foro debe ser un número válido.',
	'max_subscribes'	=> 'El número máximo de suscripciones debe ser un número válido.',
	'load_limit'	=> 'La configuración de limitación de carga del servidor no es válida.',
	'notifications_limit'	=> 'El límite de notificaciones enviadas debe ser un número válido.',
	'posts_per_page'	=> 'El número de publicaciones por página debe ser un número válido.',
	'post_flood_time'	=> 'El tiempo posterior a la inundación debe ser un número válido.',
	'post_max_size'	=> 'El tamaño máximo de publicación debe ser un número válido.',
	'post_max_smilies'	=> 'El número máximo de caritas debe ser un número válido.',
	'form_expiration_time'	=> 'El tiempo de caducidad de los formularios debe ser un número válido.',
	'session_expiration_time'	=> 'El tiempo de espera de la sesión debe ser un número válido.',
	'max_autologin_time'	=> 'La duración máxima de la sesión debe ser un número válido.',
	'sessions_per_ip'	=> 'El número máximo de sesiones por IP debe ser un número válido.',
	'sign_max_size'	=> 'El tamaño máximo de la firma debe ser un número válido.',
	'site_closed_reason'	=> 'El motivo del cierre es demasiado largo.',
	'site_mail'	=> 'El correo electrónico del sitio no es válido, el correo electrónico debe tener el formato ejemplo@dominio.com.',
	'site_name'	=> 'Debe ingresar el nombre del sitio, debe tener 100 caracteres o menos.',
	'site_description'	=> 'La descripción del sitio debe tener menos de 1000 caracteres.',
	'site_open'	=> 'La configuración de cierre del sitio no es válida.',
	'topics_per_page'	=> 'El número de temas por página debe ser un número válido.',
	'topic_flood_time'	=> 'El tiempo de inundación del tema debe ser un número válido.',
	'topic_max_size'	=> 'El tamaño máximo del tema debe ser un número válido.',
	'upload_allowed_types'	=> 'Debe ingresar extensiones autorizadas válidas para el envío de archivos.',
	'upload_max_files'	=> 'El número máximo de cargas simultáneas debe ser un número válido.',
	'upload_max_height'	=> 'La altura máxima de los archivos cargados debe ser un número válido.',
	'upload_max_size'	=> 'El tamaño máximo de los archivos enviados debe ser un número válido.',
	'upload_max_width'	=> 'El ancho máximo de los archivos cargados debe ser un número válido.',
	'upload_wait_time'	=> 'El tiempo de espera entre varias cargas simultáneas debe ser un número válido.',
	'welcome_message'	=> 'El mensaje de bienvenida es demasiado largo.',
	'session_gc_probability'	=> 'Debe ingresar un número de probabilidad de descarga de sesión válido.',
	'table_prefix'	=> 'El prefijo de la tabla no es válido.',
	'default_lang'	=> 'El idioma predeterminado del sitio no es válido.',
	'server_protocol'	=> 'El protocolo del servidor debe tener el formato http:// o https://.',
	'smtp_server'	=> 'El servidor SMTP debe estar en formato "smtp.domain.xxx".',
	'smtp_port'	=> 'El puerto SMTP debe ser un número válido.',
	'sendmail_from'	=> 'La cuenta de correo electrónico debe tener el formato ejemplo@dominio.xxx.',
	'articles_auth_read'	=> 'El rango mínimo requerido para leer un artículo no es válido.',
	'articles_auth_new'	=> 'El rango mínimo requerido para publicar un artículo no es válido.',
	'articles_auth_edit'	=> 'El rango mínimo requerido para editar un artículo no es válido.',
	'articles_auth_delete'	=> 'El rango mínimo requerido para eliminar un artículo no es válido.',
);
