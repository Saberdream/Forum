<?php
include '../includes/functions.php';
$img = isset($_GET['img']) ? $_GET['img'] : 'orton.jpg';
imagethumb('../gallery/uploads/'.$img, null, 100, true);

/*
	//--------debug-------//
	$debug_vars = array( 'dst_x : '.$dst_x , 'dst_y : '.$dst_y , 
	'src_x : '.$src_x , 'src_y : '.$src_y , 'dst_w : '.$dst_w , 'dst_h : '.$dst_h , 'src_w : '.$src_w, 'src_h : '.$src_h ,
	'imagecreate_w : '.$new_width , 'imagecreate_h : '.$new_height );
	file_put_contents('thumb-'.time().'.txt', implode("\r\n", $debug_vars));
	//--------debug-------//
*/