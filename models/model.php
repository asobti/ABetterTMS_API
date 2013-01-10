<?php
	class Model
	{
		protected $dbCred;
		protected $page;
		protected $size;
		
		function __construct($page,$size)
		{
			include('dbconfig.php');
			$dbObject = new dbconfig;
			$this->dbCred = $dbObject->getConnDetails();
			mysql_connect($this->dbCred['host'],$this->dbCred['username'],$this->dbCred['password']);
			mysql_select_db($this->dbCred['database']);
			
			$this->page = $page;
			$this->size = $size;
		}
		
		function __destruct()
		{
			mysql_close();
		}		
		
		protected function sanitize($input)
		{
			if (is_array($input)) 
			{
	        	foreach($input as $var=>$val) 
	        	{
	            	$output[$var] = $this->sanitize($val);
	        	}
	    	}
	    	else 
	    	{
	        	if (get_magic_quotes_gpc()) 
	        	{
	            	$input = stripslashes($input);
	        	}
	        	$input  = $this->cleanInput($input);
	        	$output = mysql_real_escape_string($input);
	    	}
	    	
	    	return $output;
		}
		
		private function cleanInput($input) 
		{

			$search = array(
						'@<script[^>]*?>.*?</script>@si',   // Strip out javascript
						'@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
						'@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
						'@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
						);

		    $output = preg_replace($search, '', $input);
		    return $output;
  		}  		
	}
?>