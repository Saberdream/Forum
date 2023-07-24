<?php
header('Content-Type: text/html; charset=utf-8');
$system = array(
	'Version de php' => phpversion(),
	'Version d\'Apache' => apache_get_version(),
	'Hôte du serveur' => $_SERVER['HTTP_HOST'],
	'Support de cURL' => extension_loaded('curl') ? '<strong style="color:green;">Oui</strong>' : '<strong style="color:d00;">Non</strong>',
	'Support de la bibliothèque GD' => extension_loaded('gd') ? '<strong style="color:green;">Oui</strong>' : '<strong style="color:d00;">Non</strong>',
	'Support de mysql' => extension_loaded('mysql') ? '<strong style="color:green;">Oui</strong>' : '<strong style="color:d00;">Non</strong>',
	'Support de mysqli' => extension_loaded('mysqli') ? '<strong style="color:green;">Oui</strong>' : '<strong style="color:d00;">Non</strong>',
	'Support de PDO' => extension_loaded('pdo_mysql') ? '<strong style="color:green;">Oui</strong>' : '<strong style="color:d00;">Non</strong>',
	'Support de la réécriture d\'url' => in_array('mod_rewrite', apache_get_modules()) ? '<strong style="color:green;">Oui</strong>' : '<strong style="color:d00;">Non</strong>',
);
$functions = array(
	'allow_url_fopen' => ini_get('allow_url_fopen'),
	'file_uploads' => ini_get('file_uploads'),
	'max_file_uploads' => ini_get('max_file_uploads'),
	'post_max_size' => ini_get('post_max_size'),
	'max_execution_time' => ini_get('max_execution_time'),
	'max_file_uploads' => ini_get('max_file_uploads'),
	'memory_limit' => ini_get('memory_limit'),
	'upload_max_filesize' => ini_get('upload_max_filesize'),
	'max_input_time' => ini_get('max_input_time'),
);
ksort($functions);


echo '<table>';
foreach($system as $key => $value){
	echo '<tr>
<td style="background-color:#ecf6ff;width:50%;">'.$key.'</td>
<td style="background-color:#f1f1f1;width:50%;">'.$value.'</td>
</tr>';
}
echo '</table>';

echo '<table>';
foreach($functions as $key => $value){
	echo '<tr>
<td style="background-color:#ecf6ff;width:50%;">'.$key.'</td>
<td style="background-color:#f1f1f1;width:50%;">'.$value.'</td>
</tr>';
}
echo '</table>';