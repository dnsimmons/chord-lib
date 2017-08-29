<?php

	require_once('../ChordLib.php');
	$obj = new ChordLib();

	// Let's define a simple G Major scale pattern.
	$pattern = [
		['x','x','x','x','x','x'],
		['x','2','2','2','x','2'],
		['3','3','x','x','3','3'],
		['x','x','4','4','x','x'],
		['5','5','5','5','5','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
		['x','x','x','x','x','x'],
	];

	$options = [
		'color_text' => '#aa0000'
	];

	// Render the pattern and change the marker text color just for fun.
	$obj->renderPattern($pattern, $options);

?>