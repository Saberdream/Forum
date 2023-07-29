<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * login.php
*/
$lang['login'] = array(
	'not_authorized'	=> '您无权访问网站的这一部分',
	'connect'	=> '登录',
	'connect_acp'	=> '管理面板登录',
	'page_description'	=> '您可以选择设置 cookie 来启用自动登录，这样您下次访问时就不必再次登录。',
	'page_description_acp'	=> '欢迎来到管理面板登录页面。',
	'username'	=> '伪',
	'password'	=> '密码',
	'validate'	=> '验证',
	'already_connected'	=> '您已经连接。',
	'already_connected_acp'	=> '您已经登录到管理界面。',
	'copy_code'	=> '复制代码',
	'ask_new_code'	=> '请求新代码',
	'enter_username'	=> '输入昵称',
	'errors_occurred'	=> '发生一个或多个错误',
	'automatic_connection'	=> '自动连接',
	'account'	=> '我的账户',
	'users_connected'	=> '已连接用户',
);

$lang['form_errors'] = array(
	'enter_password'	=> '您必须输入密码。',
	'incorrect_username'	=> '昵称不正确。',
	'incorrect_captcha'	=> '确认码填写不正确/不正确。',
	'invalid_form'	=> '表格无效，请重试。',
);

$lang['login_errors'] = array(
	'invalid_username'	=> '昵称无效。',
	'username_not_exists'	=> '这个昵称不存在。',
	'cant_connect_guest'	=> '您无法登录访客帐户。',
	'too_many_attempts'	=> '您尝试登录的次数过多，必须再等待 %d 秒才能再次登录。',
	'incorrect_password'	=> '帐号密码不正确。',
	'permanently_banned'	=> '该昵称因“%s”原因被永久禁止。',
	'temporarily_banned'	=> '该昵称因“%s”原因被禁止，持续时间为 %d 天。',
	'session_error'	=> '会话无效或不存在，请稍后重试。',
);
