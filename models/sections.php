<?php
	include('model.php');
	
	class SectionsModel extends Model
	{
		public $output;
		public $count;
		
		public function __construct($page,$size)
		{
			parent::__construct($page,$size);
			$this->output = array();
		}
		
		public function getByCourseCode($coursecode)
		{			
			$query = sprintf("SELECT `coursecode`,`crn`,`sec` FROM prod_sections where `coursecode`=%d LIMIT %d,%d", (int)$coursecode,($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
			
			$query = sprintf("SELECT count(*) FROM prod_sections where `coursecode`=%d", (int)$coursecode);
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];					
		}		
	}
?>