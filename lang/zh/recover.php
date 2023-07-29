<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * recover.php
*/
$lang['recover'] = array(
	'forgot_password'	=> '忘记密码了吗',
	'account'	=> '帐户',
	'subscriptions'	=> '订阅',
	'avatars'	=> '头像',
	'registration'	=> '登记',
	'recover_info'	=> '输入您的昵称和与帐户关联的电子邮件以通过电子邮件接收您的密码',
	'users_connected'	=> '已连接用户',
	'error_occured'	=> '发生了错误',
	'errors_occured'	=> '必须纠正一个或多个错误',
	'informations_updated'	=> '您的信息已成功更新。',
	'incorrect_captcha'	=> '确认码填写不正确/不正确。',
	'invalid_form'	=> '表格无效，请重试。',
	'invalid_sex'	=> '性别无效。',
	'invalid_username'	=> '昵称无效，必须包含 3 到 15 个字符，并且仅包含数字、字母和/或破折号。',
	'ip_banned'	=> '您的 IP 地址已被禁止。',
	'email_banned'	=> '该电子邮件地址已被禁止。',
	'invalid_password'	=> '密码不得超过 30 个字符。',
	'invalid_email'	=> '电子邮件无效。',
	'email_sent_success'	=> '您的登录信息已发送至您创建帐户时提供的电子邮件地址。',
	'username_not_exists'	=> '这个昵称不存在。',
	'cant_recover_password'	=> '您无法恢复该帐户的密码。',
	'username_email_not_match'	=> '帐户用户名和电子邮件地址不匹配。',
	'mail_not_sent'	=> '发生错误，无法发送电子邮件，请稍后重试您的请求。',
	'username'	=> '伪',
	'password'	=> '密码',
	'email'	=> '电子邮件',
	'ask_new_code'	=> '请求新代码',
	'validate'	=> '验证',
	'copy_code'	=> '复制代码',
	'enter_password'	=> '输入密码',
	'enter_email'	=> '请输入电邮地址',
	'enter_username'	=> '输入昵称',
	'password_confirmation'	=> '确认密码',
	'confirm_password'	=> '确认密码',
	'password_recovery'	=> '恢复您的密码',
	'mail_body'	=> '您好，您已在<a href="%s">%s</a>网站上通过电子邮件请求找回密码，请记住此信息并小心不要丢失。<br /> <br / ><p>您的昵称：<span style="color:#C00;">%s</span></p><p>您的密码：<span style="color:#C00;">%s< /span></p><br /><br />很快会在 %s 见',
);
