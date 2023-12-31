<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * forum-edit.php
*/
$lang['forum_edit'] = array(
	'page_description'	=> 'Puede crear foros en esta página utilizando el formulario. ',
	'category'	=> 'Categoría',
	'forum'	=> 'Foro',
	'categories'	=> 'Categorías',
	'edit_forum'	=> 'Editar foro',
	'save'	=> 'Para salvaguardar',
	'no_category_created'	=> 'No has creado ninguna categoría.',
	'invalid_form'	=> 'El formulario no es válido, inténtalo de nuevo.',
	'incorrect_id'	=> 'La identificación es incorrecta.',
	'incorrect_category_id'	=> 'El ID de la categoría es incorrecto.',
	'category_not_exists'	=> 'La categoría del foro no existe o no es válida.',
	'forum_not_exists'	=> 'Este foro no existe.',
	'error_occurred'	=> 'Ocurrieron uno o más errores',
	'smilies'	=> 'caritas',
	'add_smilies'	=> 'Agregar caritas',
	'manage_smilies'	=> 'Manejo de emoticonos',
	'manage_forums'	=> 'Gestión del foro',
	'forum_successful_edited'	=> 'La configuración del foro se ha actualizado correctamente.',
	'forum_name'	=> 'Nombre del Foro',
	'icon'	=> 'icono del foro',
	'description'	=> 'Descripción del foro',
	'rules'	=> 'Reglas del Foro',
	'alerts'	=> 'Alertas',
	'moderators'	=> 'Lista de moderadores',
	'auths'	=> 'permisos',
	'auth_guests'	=> 'Visitantes',
	'auth_users'	=> 'miembros',
	'auth_moderators'	=> 'Moderadores',
	'auth_admins'	=> 'Administradores',
	'auth_view'	=> 'Leer el foro',
	'auth_topic'	=> 'Crear un nuevo tema',
	'auth_reply'	=> 'Responder a los temas',
	'auth_edit'	=> 'editar un mensaje',
	'auth_alert'	=> 'Reportar un mensaje',
	'auth_lock_topic'	=> 'bloquear un tema',
	'auth_stick_topic'	=> 'marcar un tema',
	'auth_delete_topic'	=> 'Eliminar tema',
	'auth_delete_post'	=> 'eliminar un mensaje',
	'auth_restore_topic'	=> 'Restaurar un tema',
	'auth_restore_post'	=> 'Restaurar un mensaje',
	'auth_ban'	=> 'Prohibir a un usuario',
	'closed'	=> 'Foro cerrado',
	'icon_desc'	=> 'El ícono debe colocarse en el directorio "raíz del foro/imágenes/foro/", luego proporcione el enlace relativo de la imagen (en la forma "imágenes/foro/ejemplo.png")',
	'description_desc'	=> 'Describe brevemente el foro en una línea.',
	'rules_desc'	=> 'Reglas del foro ubicadas en una página externa al foro a la que se podrá acceder a través de un enlace, las etiquetas html no se reconocen (pero el bbcode sí)',
	'auth_desc'	=> 'Nota importante: los permisos "restaurar tema" y "restaurar publicación" le dan al usuario la posibilidad de ver temas y/o publicaciones eliminados, que normalmente son invisibles para los visitantes.',
	'invalid_forum_name'	=> 'El nombre del foro no es válido (debe tener entre 1 y 100 caracteres).',
	'incorrect_category'	=> 'La categoría del foro es incorrecta.',
	'invalid_icon'	=> 'El icono del foro no es válido.',
	'invalid_description'	=> 'La descripción del foro debe tener menos de 1000 caracteres.',
	'invalid_rules'	=> 'Las reglas del foro deben tener menos de 15,000 caracteres.',
	'chose_if_alerts'	=> 'Tienes que elegir si quieres activar las alertas o no.',
	'chose_if_closed'	=> 'Debes elegir si quieres cerrar el foro o no.',
	'invalid_moderator_name'	=> 'El apodo de moderador "%s" no es válido.',
	'error_auth_view'	=> 'Solo los visitantes, miembros, moderadores o administradores pueden leer el foro.',
	'error_auth_topic'	=> 'Solo los miembros, moderadores o administradores pueden crear un nuevo tema.',
	'error_auth_reply'	=> 'Solo los miembros, moderadores o administradores pueden responder a los temas.',
	'error_auth_edit'	=> 'Solo los miembros, moderadores o administradores pueden editar sus temas/publicaciones.',
	'error_auth_alert'	=> 'Solo los miembros, moderadores o administradores pueden denunciar un mensaje.',
	'error_auth_lock_topic'	=> 'Solo los moderadores o administradores pueden bloquear un tema.',
	'error_auth_stick_topic'	=> 'Solo los moderadores o administradores pueden etiquetar un tema.',
	'error_auth_delete_topic'	=> 'Solo los moderadores o administradores pueden eliminar un tema o una publicación.',
	'error_auth_delete_post'	=> 'Solo los moderadores o administradores pueden eliminar un tema o una publicación.',
	'error_auth_restore_topic'	=> 'Solo los moderadores o administradores pueden restaurar un tema o mensaje.',
	'error_auth_restore_post'	=> 'Solo los moderadores o administradores pueden restaurar un tema o mensaje.',
	'error_auth_ban'	=> 'Solo los moderadores o administradores pueden prohibir a un usuario.',
	'update_error'	=> 'Ocurrió un error al actualizar la información.',
);
