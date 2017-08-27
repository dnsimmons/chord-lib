<?php

require_once('ChordLib.php');
$obj = new ChordLib();

// Let's render a E Major chord as tablature
$obj->renderTab(['0','2','2','1','0','0'], 300, 200);

?>