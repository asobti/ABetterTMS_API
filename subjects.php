<?php
	require('controller/subjects.php');
	$subjects = new Subjects();
	header($subjects->headerMsg);
	echo json_encode($subjects->result);
?>