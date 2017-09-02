<?php

	require_once('../ChordLib.php');
	$obj = new ChordLib();

	// Let's define a small portion of the intro to Ozzy's Crazy Train
	$score = [
		['2','x','x','x','x','x'],
		['2','x','x','x','x','x'],
		['x','4','x','x','x','x'],
		['2','x','x','x','x','x'],
		['x','5','x','x','x','x'],
		['2','x','x','x','x','x'],
		['x','4','x','x','x','x'],
		['2','x','x','x','x','x'],
		['x','2','x','x','x','x'],
		['x','0','x','x','x','x'],
		['4','x','x','x','x','x'],
		['x','0','x','x','x','x'],
		['x','2','x','x','x','x'],
		['x','0','x','x','x','x'],
		['4','x','x','x','x','x'],
		['x','0','x','x','x','x'],
		['x','x','0','2','3','2'],
		['x','x','x','4','5','4']
	];

	// Set some optional options like the text color, just for fun.
	$options = [
		'color_text' => '#aa0000'
	];

	// Render the score as a PNG image.	
	$obj->renderScore($score, $options);

?>