<?php
$root_path = './';
include $root_path.'core.php';

$captcha = new captcha;
$captcha->nb_chars = 6;
$captcha->size = 32;
$captcha->marge = 15;
$captcha->font = $root_path.'includes/angelina.ttf';
$captcha->image();