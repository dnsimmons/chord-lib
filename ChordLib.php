<?php

/**
 ********************************************************************************
 * ChordLib
 * 
 * Renders guitar chord diagrams and tablature blocks using GD.
 *
 * @package  ChordLib
 * @version  0.0.1
 * @author   Dave Simmons <http://github.com/dnsimmons>
 * @license  LGPLv3
 ********************************************************************************
 */
class ChordLib {

	/**
 	 ***************************************************************************
 	 * getPitches
	 * Returns an array matrix representing the possible pitches on a 6 string
	 * guitar neck in standard tuning.
	 * 
	 * @return array Associative array map of pitches
 	 ***************************************************************************
	 */
	private function getPitches(){

		return array(
			'string_0' => array('E','F','F#','G','G#','A','A#','B','C','C#','D','D#','E'),
			'string_1' => array('A','A#','B','C','C#','D','D#','E','F','F#','G','G#','A'),
			'string_2' => array('D','D#','E','F','F#','G','G#','A','A#','B','C','C#','D'),
			'string_3' => array('G','G#','A','A#','B','C','C#','D','D#','E','F','F#','G'),
			'string_4' => array('B','C','C#','D','D#','E','F','F#','G','G#','A','A#','B'),
			'string_5' => array('E','F','F#','G','G#','A','A#','B','C','C#','D','D#','E'),
			);

	}

	/**
 	 ***************************************************************************
 	 * renderColor
	 * Converts a HEX color code to a RGB color array.
	 * 
	 * @param  string $hex Hexideciaml color code
	 * 
	 * @return array RGB color array
 	 ***************************************************************************
	 */
	private function renderColor($hex){

	   $hex = str_replace('#', '', $hex);
	   
	   if(strlen($hex) == 3) {
	      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
	      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
	      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
	   } else {
	      $r = hexdec(substr($hex,0,2));
	      $g = hexdec(substr($hex,2,2));
	      $b = hexdec(substr($hex,4,2));
	   }

	   $rgb = array($r, $g, $b);

	   return $rgb;

	}

	/**
 	 ***************************************************************************
 	 * renderChord
	 * Renders a guitar chord box with the given dimensions and fingering.
	 * 
	 * @param  array $fingering Array of fingerboard marker positions:
	 *                          x = unplucked string
	 *                          0 = open plucked string
	 *                          1-5 = fretted plucked note
	 * @param  integer $width   Image width in pixels
	 * @param  integer $height  Image height in pixels
	 * 
	 * @return void
 	 ***************************************************************************
	 */
	public function renderChord($fingering, $width, $height){

		// break down fingering array to individual strings
		$string_0 = (string) $fingering[0];
		$string_1 = (string) $fingering[1];
		$string_2 = (string) $fingering[2];
		$string_3 = (string) $fingering[3];
		$string_4 = (string) $fingering[4];
		$string_5 = (string) $fingering[5];

		// calculate some dimensional data for the image
        $image_w = $width;
        $image_h = $height;
        $spacer  = ($image_w / 7);
        $marker  = ($spacer / 2);

        // create a image object
		$obj_image 	= imagecreate($image_w, $image_h);

		// create color object for the image background
		$rgb = $this->renderColor('#ffffff');
		$color_background = imagecolorallocate($obj_image, $rgb[0], $rgb[1], $rgb[2]);

		// create color object for the image foreground text and grid lines
		$rgb = $this->renderColor('#000000');		
		$color_text = imagecolorallocate($obj_image, $rgb[0], $rgb[1], $rgb[2]);
		$color_line = imagecolorallocate($obj_image, $rgb[0], $rgb[1], $rgb[2]);

		// create color object for the image markers
		$rgb = $this->renderColor('#000000');
		$color_marker = imagecolorallocate($obj_image, $rgb[0], $rgb[1], $rgb[2]);
		
		// define initial brush locations and image margins
		$brush_x = $spacer;
		$brush_y = ($spacer * 2); 
		$margin_x_top 		= ($spacer * 2);
		$margin_x_bottom 	= ($image_h - ($spacer * 2));
		$margin_y_left 		= $spacer;
		$margin_y_right 	= ($image_w - $spacer);

		// plot and draw the fingerboard horizontal fret markers and vertical 
		// string markers forming the chord box grid
		for($i=0; $i<6; $i++){
			
			// draw a horizontal line
			imagesetthickness($obj_image, 2);
			imageline($obj_image, $brush_x, $margin_x_top, $brush_x, $margin_x_bottom, $color_line);
			$brush_x = ($brush_x + $spacer);

			// draw a vertical line
			imagesetthickness($obj_image, ($i == 0) ? 5 : 2);
			imageline($obj_image, $margin_y_left, $brush_y, $margin_y_right, $brush_y, $color_line);
			$brush_y = ($brush_y + $spacer);

		}

		// Create an in memory map of possible fingerboard marker locations given
		// the dimensions of the fingerboard to be rendered
		$brush_x = $spacer;
		$brush_y = ($spacer + ($spacer / 2)); 
		$map_markers = array();
		for($i=0; $i<6; $i++){
			for($j=0; $j<6; $j++){
				// define an array node with the possible marker location
				$map_markers['s_'.$i.'_'.$j] = array('x' => $brush_x, 'y' => $brush_y);
				$brush_y = ($brush_y + $spacer);
			}
			$brush_x = ($brush_x + $spacer);
			$brush_y = ($spacer + ($spacer / 2)); 
		}

		// draw the desired fingerboard markers by looking up the marker position in the
		// in memory fingerboard marker locations map
		$brush_x = $spacer;
		$brush_y = ($spacer + ($spacer / 2)); 
		for($i=0; $i<6; $i++){
			$str = 'string_'.$i;
			if($$str == 'x'){
				// if the marker denotes a unplucked string
				$marker_xy = $map_markers['s_'.$i.'_0'];
				imagestring($obj_image, 5, ($marker_xy['x'] - 4), ($marker_xy['y'] - 4), 'X', $color_line);
			} elseif($$str == '0') {
				// if the marker denotes an open plucked string
				$marker_xy = $map_markers['s_'.$i.'_'.$$str];
				imageellipse($obj_image, $marker_xy['x'], $marker_xy['y'], $marker, $marker, $color_line);
			} else {
				// if the marker denotes a fretted plucked note
				$marker_xy = $map_markers['s_'.$i.'_'.$$str];
				imagefilledellipse($obj_image, $marker_xy['x'], $marker_xy['y'], $marker, $marker, $color_marker);
			}
		}

		// output the image as raw image data and cleanup
		header("Content-type: image/png");
		imagepng($obj_image);
		imagedestroy($obj_image);

	}

	/**
 	 ***************************************************************************
 	 * renderTab
	 * Renders a guitar tablature snippet with the given dimensions and fingering. 
	 * 
	 * @param  array $fingering Array of fingerboard marker positions:
	 *                          x = unplucked string
	 *                          0 = open plucked string
	 *                          1-5 = fretted plucked note
	 * @param  integer $width   Image width in pixels
	 * @param  integer $height  Image height in pixels
	 * 
	 * @return void
 	 ***************************************************************************
	 */
	public function renderTab($fingering, $width, $height){

		// fetch an array map of possible fingerboard pitches
		$fingerboard = $this->getPitches();

		// break down fingering array to individual strings
		$string_0 = (string) $fingering[0];
		$string_1 = (string) $fingering[1];
		$string_2 = (string) $fingering[2];
		$string_3 = (string) $fingering[3];
		$string_4 = (string) $fingering[4];
		$string_5 = (string) $fingering[5];

        // create a image object
		$obj_image = imagecreate($width, $height);

		// create color object for the image background
		$rgb = $this->renderColor('#ffffff');
		$color_background = imagecolorallocate($obj_image, $rgb[0], $rgb[1], $rgb[2]);

		// create color object for the image foreground lines and text
		$rgb = $this->renderColor('#000000');		
		$color_line = imagecolorallocate($obj_image, $rgb[0], $rgb[1], $rgb[2]);

		// create color object for the image markers
		$rgb = $this->renderColor('#ffffff');	
		$color_marker = imagecolorallocate($obj_image, $rgb[0], $rgb[1], $rgb[2]);

		// draw the horizontral tablature lines
		$y = 20;
		for($i=0; $i<6; $i++){
			imageline($obj_image, 0, $y, 320, $y, $color_line);
			$y = ($y + 20);
		}
		// draw the markers and pitches for the strings
		$x = 40;
		if($string_0 != 'x'){
			imagefilledellipse($obj_image, ($x + 4), 118, 20, 20, $color_line);
			imagestring($obj_image, 8, $x, 110, $string_0, $color_marker);
			imagestring($obj_image, 8, $x, 130, $fingerboard['string_0'][$string_0], $color_line);
			$x = ($x + 40);
		}
		if($string_1 != 'x'){
			imagefilledellipse($obj_image, ($x + 4), 98, 20, 20, $color_line);
			imagestring($obj_image, 8, $x, 90, $string_1, $color_marker);
			imagestring($obj_image, 8, $x, 130, $fingerboard['string_1'][$string_1], $color_line);
			$x = ($x + 40);
		}
		if($string_2 != 'x'){
			imagefilledellipse($obj_image, ($x + 4), 78, 20, 20, $color_line);
			imagestring($obj_image, 8, $x, 70, $string_2, $color_marker);
			imagestring($obj_image, 8, $x, 130, $fingerboard['string_2'][$string_2], $color_line);
			$x = ($x + 40);
		}
		if($string_3 != 'x'){
			imagefilledellipse($obj_image, ($x + 4), 58, 20, 20, $color_line);
			imagestring($obj_image, 8, $x, 50, $string_3, $color_marker);
			imagestring($obj_image, 8, $x, 130, $fingerboard['string_3'][$string_3], $color_line);
			$x = ($x + 40);
		}
		if($string_4 != 'x'){
			imagefilledellipse($obj_image, ($x + 4), 38, 20, 20, $color_line);
			imagestring($obj_image, 8, $x, 30, $string_4, $color_marker);
			imagestring($obj_image, 8, $x, 130, $fingerboard['string_4'][$string_4], $color_line);
			$x = ($x + 40);
		}
		if($string_5 != 'x'){
			imagefilledellipse($obj_image, ($x + 4), 18, 20, 20, $color_line);
			imagestring($obj_image, 8, $x, 10, $string_5, $color_marker);
			imagestring($obj_image, 8, $x, 130, $fingerboard['string_5'][$string_5], $color_line);
			$x = ($x + 40);
		}

		// output the image as raw image data and cleanup
		header("Content-type: image/png");
		imagepng($obj_image);
		imagedestroy($obj_image);

	}

}


?>