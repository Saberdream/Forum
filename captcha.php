<?php
include __DIR__.'/core.php';

$captcha = new captcha;
$captcha->nb_chars = 6;
$captcha->size = 32;
$captcha->marge = 15;
$captcha->font = __DIR__.'/includes/angelina.ttf';
$captcha->image();