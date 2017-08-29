<?php

	require_once('ChordLib.php');
	$obj = new ChordLib();

	$pattern = array(
		array('x','x','x','x','x','x'),
		array('x','2','2','2','x','2'),
		array('3','3','x','x','3','3'),
		array('x','x','4','4','x','x'),
		array('5','5','5','5','5','x'),
		array('x','x','x','x','x','x'),
		array('x','x','x','7','x','7'),
		array('x','x','x','x','8','x'),
		array('x','x','9','x','x','x'),
		array('x','10','x','x','x','x'),
		array('x','x','x','x','x','x'),
		array('x','x','x','12','x','x'),
	);

	$obj->renderPattern($pattern, 200);

?>