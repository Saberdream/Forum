<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * configuration.php
*/
$lang['config'] = array(
	'site_configuration'	=> '站点设置',
	'page_description'	=> '您可以在此处配置论坛设置。',
	'save'	=> '为了保障',
	'yes'	=> '是的',
	'no'	=> '不',
	'settings_saved'	=> '您的设置已被考虑在内。',
	'writing_error'	=> '写入配置文件时发生错误。',
	'invalid_form'	=> '表格无效，请重试。',
	'errors_occurred'	=> '发生一个或多个错误',
	'update_error'	=> '更新配置时出错。',
	'error_logs'	=> '错误日志',
	'styles'	=> '风格',
	'visitors'	=> '访客',
	'members'	=> '会员',
	'moderators'	=> '版主',
	'administrators'	=> '行政人员',
);

$lang['cat_names'] = array(
	'general_configuration'	=> '常规设置',
	'users_configuration'	=> '配置用户',
	'forums_configuration'	=> '配置论坛',
	'avatars_configuration'	=> '配置头像',
	'files_upload_configuration'	=> '配置文件上传',
	'server_configuration'	=> '服务器设置',
	'pm_configuration'	=> '设置私人消息',
	'articles_configuration'	=> '配置项目',
);

$lang['config_names'] = array(
	'site_name'	=> '网站名称',
	'site_description'	=> '网站说明',
	'domain_name'	=> '站点域名',
	'site_mail'	=> '网站邮箱',
	'default_style'	=> '默认样式',
	'default_timezone'	=> '默认时区',
	'user_style'	=> '允许用户样式',
	'site_open'	=> '网站开放',
	'site_closed_reason'	=> '关闭原因',
	'allow_register'	=> '允许注册',
	'desc_max_size'	=> '最大描述尺寸',
	'activate_sign'	=> '启用签名',
	'sign_max_size'	=> '签名最大尺寸',
	'form_expiration_time'	=> '表单过期时间',
	'session_expiration_time'	=> '会话超时',
	'max_autologin_time'	=> '会话的最大持续时间',
	'sessions_per_ip'	=> '最大限度。',
	'max_login_attempts'	=> '最大登录尝试次数',
	'attempt_wait_time'	=> '重试前的时间',
	'cookies_expiration_time'	=> 'Cookie 过期时间',
	'cookies_name'	=> '登录cookie名称',
	'max_subscribes'	=> '最大限度。',
	'load_limit'	=> '限制服务器负载',
	'notifications_limit'	=> '最大限度。',
	'welcome_message'	=> '注册时欢迎留言',
	'topics_per_page'	=> '每页主题',
	'posts_per_page'	=> '每页帖子数',
	'topic_flood_time'	=> '主题洪水时间',
	'post_flood_time'	=> '消息泛滥时间',
	'captcha_newtopic'	=> '验证码创建新主题',
	'captcha_reply'	=> '用于回复主题的验证码',
	'topic_max_size'	=> '最大主题长度',
	'post_max_size'	=> '最大消息长度',
	'max_sticky_topics'	=> '最大引脚数',
	'post_max_smilies'	=> '表情符号最大数量',
	'activate_avatar'	=> '启用头像',
	'avatar_max_height'	=> '最大头像高度',
	'avatar_max_width'	=> '最大头像宽度',
	'avatar_max_size'	=> '最大头像重量',
	'avatar_max_files'	=> '不。',
	'avatar_wait_time'	=> '上传之间的时间限制',
	'avatar_allowed_types'	=> '允许的文件类型',
	'max_avatars_per_user'	=> '最大限度。',
	'activate_upload'	=> '启用文件上传',
	'upload_max_height'	=> '最大文件高度',
	'upload_max_width'	=> '最大文件宽度',
	'upload_max_size'	=> '最大文件大小',
	'upload_max_files'	=> '不。',
	'upload_wait_time'	=> '上传之间的时间限制',
	'upload_allowed_types'	=> '允许的文件类型',
	'session_gc_probability'	=> '启用会话卸载的概率',
	'table_prefix'	=> '表前缀',
	'default_lang'	=> '默认站点语言',
	'server_protocol'	=> '服务器协议',
	'post_redirection_time'	=> '发布主题/消息后的指导时间',
	'smtp_server'	=> 'SMTP服务器',
	'smtp_port'	=> 'SMTP 服务器端口',
	'sendmail_from'	=> '电子邮件帐户',
	'activate_pm'	=> '启用私人消息',
	'pm_flood_time'	=> '每条消息之间的泛洪时间',
	'pm_reply_flood_time'	=> '每次响应之间的泛洪时间',
	'pm_captcha'	=> '新帖子的验证码',
	'pm_reply_captcha'	=> '验证码获取答案',
	'pm_max_size'	=> 'PM 标题的最大长度',
	'pm_reply_max_size'	=> '最大响应长度',
	'pm_max_smilies'	=> '回复中笑脸的最大数量',
	'pm_max_participants'	=> 'PM 参与人数上限',
	'activate_articles'	=> '启用文章',
	'articles_flood_time'	=> '文章之间的洪水时间',
	'articles_captcha'	=> '文章验证码',
	'articles_title_max_size'	=> '文章标题的最大字符数',
	'articles_text_min_size'	=> '文章文本的最小字符数',
	'articles_text_max_size'	=> '文章正文最大字符数',
	'articles_auth_read'	=> '阅读文章所需的排名',
	'articles_auth_new'	=> '发表文章所需的排名',
	'articles_auth_edit'	=> '编辑文章所需的排名',
	'articles_auth_delete'	=> '删除文章所需的排名',
);

$lang['config_descriptions'] = array(
	'form_expiration_time'	=> '秒数（默认为 900）',
	'session_expiration_time'	=> '秒数（默认为 3600）',
	'max_autologin_time'	=> '秒数（默认为 259200）',
	'sessions_per_ip'	=> '默认值 10',
	'max_login_attempts'	=> '默认5个',
	'attempt_wait_time'	=> '秒数（默认为 3600）',
	'cookies_expiration_time'	=> '天数',
	'cookies_name'	=> '自定义自动登录 cookie 名称',
	'load_limit'	=> '限制最大服务器负载（以％为单位，0表示禁用）',
	'max_subscribes'	=> '用户可以订阅的最大主题数（0 表示禁用）',
	'notifications_limit'	=> '限制响应期间的通知数量以减少服务器负载（0 表示禁用）',
	'topic_flood_time'	=> '秒数',
	'post_flood_time'	=> '秒数',
	'topic_max_size'	=> '字符数',
	'post_max_size'	=> '字符数',
	'avatar_max_height'	=> '像素数',
	'avatar_max_width'	=> '像素数',
	'avatar_max_size'	=> 'Mio数量',
	'avatar_max_files'	=> '文件数量（0表示无限制）',
	'avatar_wait_time'	=> '秒数（0 表示无限制）',
	'max_avatars_per_user'	=> '0 表示无限制',
	'upload_max_height'	=> '像素数',
	'upload_max_width'	=> '像素数',
	'upload_max_size'	=> 'Mio数量',
	'upload_max_files'	=> '文件数量',
	'upload_wait_time'	=> '秒数',
	'session_gc_probability'	=> '以 % 为单位（默认为 1）',
	'table_prefix'	=> '更改此设置可能会影响网站的正常运行，只有在您知道自己在做什么的情况下才能更改此设置',
	'server_protocol'	=> '仅当您想要指定与默认协议不同的协议时才更改此值',
	'post_redirection_time'	=> '秒数（默认为 5）',
	'sendmail_from'	=> '不一定与网站的电子邮件地址相同，但必须是与您的主机对应的有效帐户。',
	'pm_flood_time'	=> '秒数',
	'pm_reply_flood_time'	=> '秒数',
	'articles_flood_time'	=> '秒数',
	'pm_max_participants'	=> '0 表示无限制',
);

$lang['config_errors'] = array(
	'activate_avatar'	=> '头像设置无效。',
	'activate_pm'	=> '私信设置无效。',
	'activate_sign'	=> '签名设置无效。',
	'activate_upload'	=> '上传参数无效。',
	'allow_register'	=> '新注册的设置无效。',
	'attempt_wait_time'	=> '登录尝试次数无效。',
	'avatar_allowed_types'	=> '您必须输入有效的允许头像提交的扩展名。',
	'avatar_max_files'	=> '最大并发上传数必须是有效的数字。',
	'avatar_max_height'	=> '最大头像高度必须是有效数字。',
	'avatar_max_size'	=> '最大头像重量必须是有效数字。',
	'avatar_max_width'	=> '最大头像宽度必须是有效的数字。',
	'avatar_wait_time'	=> '多个同时上传之间的等待时间必须是有效数字。',
	'captcha_newtopic'	=> '私信设置无效。',
	'captcha_reply'	=> '私信设置无效。',
	'cookies_expiration_time'	=> 'Cookie 过期时间必须是有效数字。',
	'cookies_name'	=> '登录 cookie 的名称不能为空，并且最多必须包含 1000 个字母数字字符或 _。',
	'desc_max_size'	=> '配置文件描述字符限制必须是有效的数字。',
	'domain_name'	=> '该域名无效。',
	'default_style'	=> '论坛默认样式无效。',
	'default_timezone'	=> '默认时区无效。',
	'user_style'	=> '用户样式权限设置无效。',
	'max_avatars_per_user'	=> '每个用户的最大头像数量必须是有效的数字。',
	'max_login_attempts'	=> '尝试新连接之前的等待时间无效。',
	'max_sticky_topics'	=> '每个论坛固定主题的最大数量必须是有效的数字。',
	'max_subscribes'	=> '最大订阅数必须是有效的数字。',
	'load_limit'	=> '服务器负载限制设置无效。',
	'notifications_limit'	=> '发送通知的限制必须是有效的数量。',
	'posts_per_page'	=> '每页的帖子数必须是有效的数字。',
	'post_flood_time'	=> '洪水过后时间必须是有效数字。',
	'post_max_size'	=> '最大帖子大小必须是有效的数字。',
	'post_max_smilies'	=> '表情符号的最大数量必须是有效的数字。',
	'form_expiration_time'	=> '表单过期时间必须是有效数字。',
	'session_expiration_time'	=> '会话超时必须是有效的数字。',
	'max_autologin_time'	=> '最大会话持续时间必须是有效的数字。',
	'sessions_per_ip'	=> '每个 IP 的最大会话数必须是有效数字。',
	'sign_max_size'	=> '最大签名大小必须是有效数字。',
	'site_closed_reason'	=> '关闭原因太长了。',
	'site_mail'	=> '站点电子邮件无效，电子邮件格式必须为 example@domain.com。',
	'site_name'	=> '您必须输入站点名称，不得超过 100 个字符。',
	'site_description'	=> '网站描述必须少于 1000 个字符。',
	'site_open'	=> '站点关闭设置无效。',
	'topics_per_page'	=> '每页的主题数必须是有效的数字。',
	'topic_flood_time'	=> '主题泛洪时间必须是有效数字。',
	'topic_max_size'	=> '最大主题大小必须是有效的数字。',
	'upload_allowed_types'	=> '您必须输入有效的授权扩展名才能提交文件。',
	'upload_max_files'	=> '最大并发上传数必须是有效的数字。',
	'upload_max_height'	=> '上传文件的最大高度必须是有效的数字。',
	'upload_max_size'	=> '发送的文件的最大大小必须是有效的数字。',
	'upload_max_width'	=> '上传文件的最大宽度必须是有效的数字。',
	'upload_wait_time'	=> '多个同时上传之间的等待时间必须是有效数字。',
	'welcome_message'	=> '欢迎信息太长。',
	'session_gc_probability'	=> '您必须输入有效的会话卸载概率数。',
	'table_prefix'	=> '表前缀无效。',
	'default_lang'	=> '该网站的默认语言无效。',
	'server_protocol'	=> '服务器协议必须采用 http:// 或 https:// 格式。',
	'smtp_server'	=> 'SMTP 服务器必须采用“smtp.domain.xxx”格式。',
	'smtp_port'	=> 'SMTP 端口必须是有效的号码。',
	'sendmail_from'	=> '电子邮件帐户的格式必须为 example@domain.xxx。',
	'articles_auth_read'	=> '阅读文章所需的最低排名无效。',
	'articles_auth_new'	=> '发表文章所需的最低排名无效。',
	'articles_auth_edit'	=> '编辑文章所需的最低排名无效。',
	'articles_auth_delete'	=> '删除文章所需的最低排名无效。',
);