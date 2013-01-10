<?php
	require('controller/buildings.php');
	$buildings = new Buildings();
	header($buildings->headerMsg);
	echo json_encode($buildings->result);
?>