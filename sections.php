<?php
	require('controller/sections.php');
	$sections = new Sections();
	header($sections->headerMsg);
	echo json_encode($sections->result);
?>