<?php 

/* 
image-sizing  (oop style)
developerthai.com (banchar_pa@yahoo.com)
*/

class ImageSizing {
	
	private $img = null;
	
	private function __construct() { }
	
	static function from_file(string $file_name) {
		$image = new self();
		$info = pathinfo($file_name);
		$type = strtolower($info['extension']);
		if ($type=="gif") {
			$image->img = imagecreatefromgif($file_name);
		} else if ($type=="png") {
			$image->img =  imagecreatefrompng($file_name);
		} else if (in_array($type, ['jpg', 'jpeg', 'pjpeg'])) {
			$image->img =  imagecreatefromjpeg($file_name);
		}
		
		return $image;
	}

	static function from_upload(string $input_name, int $index=null) {
		$image = new self();
		$f = $_FILES[$input_name];
		$t = (is_null($index))?$f['type']:$f['type'][$index];
		if ($t=="image/gif") {
			$image->img =  (is_null($index))?imagecreatefromgif ($f['tmp_name']):imagecreatefromgif ($f['tmp_name'][$index]);
		} else if ($t=="image/png") {
			$image->img =  (is_null($index))?imagecreatefrompng($f['tmp_name']):imagecreatefrompng($f['tmp_name'][$index]);
		} else if (in_array($t, ['image/jpg', 'image/jpeg', 'image/pjpeg'])) {
			$image->img =  (is_null($index))?imagecreatefromjpeg($f['tmp_name']):imagecreatefromjpeg($f['tmp_name'][$index]);
		}		
		return $image;
	}

	private function resizing(int $dst_width, int $dst_height) {
	    $w = imagesx($this->img);
	    $h = imagesy($this->img);
		
	    $new_img = imagecreatetruecolor($dst_width, $dst_height);

	    imagealphablending($new_img, false);
	    imagesavealpha($new_img, true);
	    $transparent = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
	    imagefilledrectangle($new_img, 0, 0, $w, $h, $transparent);
	    imagecopyresampled($new_img, $this->img, 0, 0, 0, 0, $dst_width, $dst_height, $w, $h);

	    return $new_img;
	}

	function resize_percent(int $percent) {
		$p = $percent/100;
		$src_w = imagesx($this->img);
		$src_h = imagesy($this->img);
		$width = $src_w * $p;
		$height = $src_h * $p;

		$this->img = $this->resizing($width, $height);
	}

	function resize(int $width, int $height) {
		$this->img = $this->resizing($width, $height); 
	}

	function resize_width(int $width) {
		$r = $width/imagesx($this->img);
		$height = imagesy($this->img) * $r;
		$this->img =  $this->resizing($width, $height); 
	}

	function resize_height(int $height) {
		$r = $height/imagesy($this->img);
		$width = imagesx($this->img) * $r;
		$this->img = $this->resizing($width, $height); 
	}

	function resize_max(int $max_width, int $max_height) {
		$src_width = imagesx($this->img);
		$src_height = imagesy($this->img);
		$width = $src_width;
		$height = $src_height;

		if ($width > $height) {
			if ($width > $max_width) {
				$r = $width / $max_width;
				$height = intval($height / $r);
				$width = $max_width;

				if ($height > $max_height) {
					$r = $height / $max_height;
					$width = intval($width / $r);
					$height = $max_height;
				}
			} else {
				if ($height > $max_height) {
					$r = $height / $max_height;
					$width = intval($width / $r);
					$height = $max_height;
				}
			}
		} else {
			if ($height > $max_height) {
				$r = $height / $max_height;
				$width = intval($width / $r);
				$height = $max_height;
				if ($width > $max_width) {
					$r = $width / $max_width;
					$height = intval($heigh / $r);
					$width = $max_width;	
				}
			} else {
				if ($width > $max_width) {
					$r = $width / $max_width;
					$height = intval($height / $r);
					$width = $max_width;		
				}
			}
		}

		$this->img = $this->resizing($width, $height); 
	}

	function save(string $file_name) {
		$info = pathinfo($file_name);
		$type = strtolower($info['extension']);
		if ($type=="gif") {
			imagegif ($this->img, $file_name);
		} else if (in_array($type, ['jpg', 'jpeg', 'pjpeg'])) {
			imagejpeg($this->img, $file_name);
		} else if ($type=="png") {
			imagepng($this->img, $file_name);
		}
	}
}
?>
