<?php
	require('controller/courses.php');
	$courses = new Courses();
	header($courses->headerMsg);
	echo json_encode($courses->result);
?>