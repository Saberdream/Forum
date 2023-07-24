<?php
function get_user($username) {
	global $dbh, $config;
	
	$sth = $dbh->prepare('SELECT user_id, user_password, user_email, user_rank FROM forum_users WHERE user_name = ?');
	$sth->execute(array($username));
	$data = $sth->fetch(PDO::FETCH_ASSOC);
							
	return $data;
}

function send_mail($username, $password, $email, $subject, $text) {
	global $config;

	ini_set('SMTP', $config['smtp_server']);
	ini_set('smtp_port', $config['smtp_port']);
	ini_set('sendmail_from', $config['sendmail_from']);

	$from = 'From:'.$config['site_mail']."\n";
	$from .= "MIME-version: 1.0\n";
	$from .= "Content-type: text/html; charset=UTF-8\n";
	$from .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
	$to = $email;
	$message = '<html>
	<head>
	<style type="text/css">
	html,body,a,div,p,strong,span{margin:0;padding:0;}
	body {text-align:center;padding-top:10px;color:#000;font: 13px Arial;}
	#content {margin:0 auto;width:600px;float:center;text-align:left;}
	#header{width:600px;margin-bottom:10px;}
	#mail_body {padding:5px;border:1px solid #DDD;}
	strong {font:bold 13px Arial;}
	a {color:#0A6DA8;text-decoration:none;}
	a:hover {color:#F20000 !important;}
	p{margin-bottom:6px;}
	</style>
	</head>
	<body>
	<div id="content">
	<div id="header"><img src="https://i.imgur.com/xFpwnNW.png" /></div>
	<div id="mail_body">'.$text.'</div>
	</div>
	</body>
	</html>';

	if(mail($to, $subject, $message, $from))
		return true;

	return false;
}
