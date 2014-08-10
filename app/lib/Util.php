<?php  

class Util
{
	
	public static function getNewDimensions($theImg){
            
            $maxWidth = 800;
            $maxHeight = 600;
            $newWidth = 0;
            $newHeight = 0;
            
                list($width, $height, $type, $attr) = getimagesize($theImg);

		if ($width > $height) {
			$newWidth = 800;
			$newHeight = ($newWidth * $height)/$width;
		}else if ($height > $width) {
			$newHeight = 600;
			$newWidth = ($newHeight * $width)/$height;
		}else{
			$newWidth = 800;
			$newHeight = 600;
		}

		$marginTop = (600 - $newHeight)/2;
		$marginLeft = (800 - $newWidth)/2;
                return array('width' => $newWidth, 'height' => $newHeight, 'left' => $marginLeft, 'top' => $marginTop);

            
            return array('width' => $newWidth, 'height' => $newHeight, 'left' => $marginLeft, 'top' => $marginTop);
	}
        
        public static function checkUserAuth() {
            if (Auth::check()) {
                return Auth::user()->email;
            }else{
                return null;
            }
        }
}

?>