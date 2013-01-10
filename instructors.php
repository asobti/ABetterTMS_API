<?php
	require('controller/instructors.php');
	$instructors = new Instructors();
	header($instructors->headerMsg);
	echo json_encode($instructors->result);
?>