<?php
	require('controller/colleges.php');
	$colleges= new Colleges();
	header($colleges->headerMsg);
	echo json_encode($colleges->result);
?>