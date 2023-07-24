<?php
$image_dest = isset($_GET['n']) ? $_GET['n'] : '';
$filename = substr($image_dest, 0, strrpos($image_dest, '.'));
echo $filename;