<?php

	require_once('ChordLib.php');
	$obj = new ChordLib();

	$score = array(
		array('2','x','x','x','x','x'),
		array('2','x','x','x','x','x'),
		array('x','4','x','x','x','x'),
		array('2','x','x','x','x','x'),
		array('x','5','x','x','x','x'),
		array('2','x','x','x','x','x'),
		array('x','4','x','x','x','x'),
		array('2','x','x','x','x','x'),
		array('x','2','x','x','x','x'),
		array('x','0','x','x','x','x'),
		array('4','x','x','x','x','x'),
		array('x','0','x','x','x','x'),
		array('x','2','x','x','x','x'),
		array('x','0','x','x','x','x'),
		array('4','x','x','x','x','x'),
		array('x','0','x','x','x','x'),
		array('x','x','0','2','3','2'),
		array('x','x','x','4','5','4'),
	);

	$obj->renderScore($score, 160);

?>