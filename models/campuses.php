<?php
	include('model.php');
	
	class CampusesModel extends Model
	{
		public $output;
		public $count;
		
		public function __construct($page,$size)
		{
			parent::__construct($page,$size);
			$this->output = array();
		}
		
		public function getAll()
		{
			$query = sprintf("SELECT * FROM prod_campus LIMIT %d,%d",($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_campus");
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
		}
		
		public function getByCampusCode($campuscode)
		{
			$campuscode= $this->sanitize($campuscode);
			$query = sprintf("SELECT * FROM prod_campus where `campuscode`=%d LIMIT %d,%d", (int)$campuscode,($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_campus where `campuscode`=%d", (int)$campuscode);
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
						
		}
		
		public function getByCampusName($campusname)
		{
			$campusname= $this->sanitize($campusname);
			$query = sprintf("SELECT * FROM prod_campus where UPPER(`campusname`)='%s' LIMIT %d,%d", strtoupper($campusname),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;	
					
			$query = sprintf("SELECT count(*) FROM prod_campus where UPPER(`campusname`)='%s'", strtoupper($campusname));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];			
		}
	}
?>