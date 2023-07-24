<?php
$array = array('46', 22, 4, 'coucou', '60', '61', '62');

$ids = array_filter($array, 'is_numeric');

echo '<pre>';
print_r(array_values($ids));
echo '</pre>';