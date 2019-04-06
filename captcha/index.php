<?php

	header('Content-type: image/png');

	session_start();
	
	if(!function_exists('gd_info') ) {
		throw new Exception('Required GD library is missing');
		exit;
	}
	
	$captcha 	= imagecreatefrompng('image.png');
	$white 		= imagecolorallocate($captcha, 0, 0, 0);
	$red 		= imagecolorallocate($captcha, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
	$font 		= './Thankfully.ttf';
	$text 		= '';
	$consonants 	= array('b','c','d','f','g','h','j','k','l','m','n','p','r','s','t','v','w','x','y','z');
	$vowels 	= array('a','e','i','o','u');
	
	for($i=0; $i<=2; $i++){
		   $text  .= $consonants[mt_rand(0,count($consonants)-1)];
		   $text  .= $vowels[mt_rand(0,count($vowels)-1)];
	}
		
	$_SESSION['captcha_question'] = $text;
	$delta = mt_rand(100,130);
	imagettftext($captcha, 77, 0, 11, $delta, $white, $font, $text);
	imagettftext($captcha, 77, 0, 20, $delta, $red, $font, $text);
	imagepng($captcha);
	imagedestroy($captcha);
	$text = "";

?>