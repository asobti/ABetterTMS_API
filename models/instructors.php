<?php
	include('model.php');
	
	class InstructorsModel extends Model
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
			$query = sprintf("SELECT * FROM prod_instructors LIMIT %d,%d",($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_instructors");
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
		}
		
		public function getByInstructorCode($instructorcode)
		{
			$instructorcode= $this->sanitize($instructorcode);
			$query = sprintf("SELECT * FROM prod_instructors where `instructorcode`=%d LIMIT %d,%d", (int)$instructorcode,($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_instructors where `instructorcode`=%d", (int)$instructorcode);
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
						
		}
		
		public function getByInstructorName($instructorname)
		{
			$instructorname= $this->sanitize($instructorname);
			$query = sprintf("SELECT * FROM prod_instructors where UPPER(`instructorname`)='%s' LIMIT %d,%d", strtoupper($instructorname),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;	
					
			$query = sprintf("SELECT count(*) FROM prod_instructors where UPPER(`instructorname`)='%s'", strtoupper($instructorname));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];			
		}
	}
?>