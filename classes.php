<?php
	require('controller/classes.php');
	$classes = new Classes();
	header($classes->headerMsg);
	echo json_encode($classes->result);
?>