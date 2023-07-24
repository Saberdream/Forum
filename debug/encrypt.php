<?php
define('SESS_CIPHER', 'aes-128-cbc');

function encrypt($data, $key) {
	$salt = '6ieacr)gz*&e20-8|=kldf&j?u=!1_-~3&&j17>m7a0!a2ki/m&1gv_lqw!zh/~s';
	$key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
	
	$ivlen = openssl_cipher_iv_length(SESS_CIPHER);
	$iv = openssl_random_pseudo_bytes($ivlen);
	$ciphertext_raw = openssl_encrypt($data, SESS_CIPHER, $key, OPENSSL_RAW_DATA, $iv);
	
	$ciphertext = base64_encode($iv.$ciphertext_raw);
	
	return $ciphertext;
}

function decrypt($data, $key) {
	$salt = '6ieacr)gz*&e20-8|=kldf&j?u=!1_-~3&&j17>m7a0!a2ki/m&1gv_lqw!zh/~s';
	$key = substr(hash('sha256', $salt.$key.$salt), 0, 32);
	
	$decoded = base64_decode($data);
	
	$ivlen = openssl_cipher_iv_length(SESS_CIPHER);
	$iv = substr($decoded, 0, $ivlen);
	$ciphertext_raw = substr($decoded, $ivlen);
	$original_data = openssl_decrypt($ciphertext_raw, SESS_CIPHER, $key, OPENSSL_RAW_DATA, $iv);
	
	return $original_data;
}

function random_str($length = 30, $specials = null) {
	$key = '';
	$pool = array_merge(range(0,9), range('a', 'z'));
	
	if($specials != null)
		$pool = array_merge($pool, str_split($specials));
	
	for($i=0; $i < $length; $i++)
		$key .= $pool[mt_rand(0, count($pool)-1)];
	
	return $key;
}

$key = '3fdd420690884e9d6835426eae2258a76978ce911b4acde15facd0a592a68d4efeb773fa2dc63632c98fc54e5af629a13447980eba45f41ca346b5f0b5400685';
$data = array(
	'sessionid' => '0fa673807f8fc12c27d30290a2d587117d1c33572f7b7f0c5d88cc15f5ceb971d4b08844b7654f87814534d036d0d3d8786d50be05edcc7268cf029a1f579b0b',
	'user_id' => 1,
	'user_name' => 'Saikuro',
	'user_password' => ',X3s?kqqSQq~(E:w',
	'user_rank' => 5,
	'user_style' => 'silver'
);
$data2 = array('v  v', ' ');
$data3 = array();

$text_encrypted = encrypt(serialize($data), $key);
print '<p><b>text encrypted:</b><br>'.$text_encrypted.'</p>';

$text_decrypted = unserialize(decrypt($text_encrypted, $key));
print '<p><b>text decrypted:</b><br>array( '.implode(',<br>', $text_decrypted).' )</p>';

print '<p>';
print_r($text_decrypted);
print '</p>';

print '<p>';
foreach($text_decrypted as $key => $val) {
	if($val == $data[$key])
		print $key.': match<br>';
	else
		print $key.': not match<bt>';
}
print '</p>';

// $random_str = hash('sha256', random_str(64));
$random_str = random_str(64, '!?#=*@-_~()+$%');

print '<p>random salt generator: '.$random_str.'</p>';
