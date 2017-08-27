<?php

require_once('ChordLib.php');
$obj = new ChordLib();

// Let's render a E Major chord as a chord box
$obj->renderChord(['0','2','2','1','0','0'], 200, 300);

?>