<?php
	require('controller/campuses.php');
	$campuses= new Campuses();
	header($campuses->headerMsg);
	echo json_encode($campuses->result);
?>