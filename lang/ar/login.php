<?php
if(empty($lang) || !is_array($lang))
	$lang = array();

/*
 * login.php
*/
$lang['login'] = array(
	'not_authorized'	=> 'غير مصرح لك بالوصول إلى هذا الجزء من الموقع',
	'connect'	=> 'تسجيل الدخول',
	'connect_acp'	=> 'تسجيل الدخول إلى لوحة الإدارة',
	'page_description'	=> 'يمكنك اختيار تعيين ملف تعريف ارتباط لتمكين تسجيل الدخول التلقائي حتى لا تضطر إلى تسجيل الدخول مرة أخرى في زيارتك التالية.',
	'page_description_acp'	=> 'مرحبًا بك في صفحة تسجيل الدخول إلى لوحة الإدارة. ',
	'username'	=> 'مستعار',
	'password'	=> 'كلمة السر',
	'validate'	=> 'للتحقق من صحة',
	'already_connected'	=> 'كنت متصلا بالفعل.',
	'already_connected_acp'	=> 'لقد قمت بتسجيل الدخول بالفعل إلى الإدارة.',
	'copy_code'	=> 'انسخ الكود',
	'ask_new_code'	=> 'اطلب رمزًا جديدًا',
	'enter_username'	=> 'أدخل كنية',
	'errors_occurred'	=> 'حدث خطأ واحد أو أكثر',
	'automatic_connection'	=> 'اتصال تلقائي',
	'account'	=> 'حسابي',
	'users_connected'	=> 'المستخدمون المتصلون',
);

$lang['form_errors'] = array(
	'enter_password'	=> 'يجب عليك إدخال كلمة المرور.',
	'incorrect_username'	=> 'اللقب غير صحيح.',
	'incorrect_captcha'	=> 'لم يتم ملء رمز التأكيد بشكل صحيح / غير صحيح.',
	'invalid_form'	=> 'النموذج غير صالح ، يرجى المحاولة مرة أخرى.',
);

$lang['login_errors'] = array(
	'invalid_username'	=> 'اللقب غير صالح.',
	'username_not_exists'	=> 'هذا اللقب غير موجود.',
	'cant_connect_guest'	=> 'لا يمكنك تسجيل الدخول إلى حساب ضيف.',
	'too_many_attempts'	=> 'لقد أجريت العديد من محاولات تسجيل الدخول ، يجب الانتظار٪ d ثانية أخرى قبل محاولة تسجيل الدخول مرة أخرى.',
	'incorrect_password'	=> 'كلمة مرور الحساب غير صحيحة.',
	'permanently_banned'	=> 'اللقب ممنوع بسبب "٪ s" لفترة دائمة.',
	'temporarily_banned'	=> 'اللقب محظور بسبب "٪ s" لمدة٪ d يوم (أيام).',
	'session_error'	=> 'جلسة غير صالحة أو غير موجودة ، يرجى المحاولة مرة أخرى في وقت لاحق.',
);
