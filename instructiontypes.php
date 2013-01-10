<?php
	require('controller/instructiontypes.php');
	$instructiontypes = new Instructiontypes();
	header($instructiontypes->headerMsg);
	echo json_encode($instructiontypes->result);
?>