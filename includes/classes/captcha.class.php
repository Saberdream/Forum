<?php
class captcha {
	private $generate;
	public $nb_chars;	// for example 6
	public $size;		// for example 32
	public $marge;		// for example 15
	public $font;

	public function __construct() {
		if(session_id() == '')
			session_start();
	}

	public function image() {
		$this->generate = $this->random($this->nb_chars);

		$_SESSION['captcha'] = $this->generate;
		
		header('Content-Type: image/png');
		
		$matrix_blur = array(
			array(1,1,1),
			array(1,1,1),
			array(1,1,1)
		);
			
		$box = imagettfbbox($this->size, 0, $this->font, $this->generate);
		$largeur = $box[2] - $box[0];
		$hauteur = $box[1] - $box[7];
		$largeur_lettre = round($largeur/strlen($this->generate));

		$img = imagecreate($largeur+$this->marge, $hauteur+$this->marge);
		$blanc = imagecolorallocate($img, 255, 255, 255); 
		$noir = imagecolorallocate($img, 0, 0, 0);

		$couleur = array(
			imagecolorallocate($img, 0x99, 0x00, 0x66),
			imagecolorallocate($img, 0xCC, 0x00, 0x00),
			imagecolorallocate($img, 0x00, 0x00, 0xCC),
			imagecolorallocate($img, 0x00, 0x00, 0xCC),
			imagecolorallocate($img, 0xBB, 0x88, 0x77)
		);

		for($i = 0; $i < strlen($this->generate);++$i) {
			$l = $this->generate[$i];
			$angle = mt_rand(-35,35);
			imagettftext($img, mt_rand($this->size-7, $this->size), $angle, ($i*$largeur_lettre)+$this->marge, $hauteur+mt_rand(0,$this->marge/2), $couleur[array_rand($couleur)], $this->font, $l);   
		}

		imageline($img, 2,mt_rand(2,$hauteur), $largeur+$this->marge, mt_rand(2,$hauteur), $noir);
		imageline($img, 2,mt_rand(2,$hauteur), $largeur+$this->marge, mt_rand(2,$hauteur), $noir);

		imagepng($img);
		imagedestroy($img);
	}

	public static function check() {
		if(session_id() == '')
			session_start();

		if(isset($_SESSION['captcha'])) {
			$captcha = $_SESSION['captcha'];

			unset($_SESSION['captcha']);

			if(!empty($_POST['captcha']) && $_POST['captcha'] == $captcha)
				return true;
		}

		return false;
	}

	private function random($n) {
		$vowels = array('a', 'e', 'i', 'o', 'u', 'ou', 'io','ou','ai');
		$consonants = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm','n', 'p', 'r', 's', 't', 'v', 'w', 'br','bl', 'cr','ch', 'dr', 'fr', 'dr', 'fr', 'fl', 'gr','gl','pr','pl','ps','st','tr','vr');
		$word = '';
		$nv = count($vowels)-1;
		$nc = count($consonants)-1;

		for($i = 0; $i < round($n/2); ++$i) {
			$word .= $vowels[mt_rand(0,$nv)];
			$word .= $consonants[mt_rand(0,$nc)];
		}

		return substr($word,0,$n);
	}
}