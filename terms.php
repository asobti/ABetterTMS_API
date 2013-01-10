<?php
	require('controller/terms.php');
	$terms = new Terms();
	header($terms->headerMsg);
	echo json_encode($terms->result);
?>