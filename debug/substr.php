<?php
$image_dest = isset($_GET['n']) ? $_GET['n'] : '';
$type	   = substr(strrchr($image_dest, '.'), 1);
echo $type;