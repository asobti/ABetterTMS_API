<?php
	include('model.php');
	
	class CollegesModel extends Model
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
			$query = sprintf("SELECT * FROM prod_colleges LIMIT %d,%d",($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_colleges");
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
		}
		
		public function getByCollegeCode($collegecode)
		{
			$collegecode = $this->sanitize($collegecode);
			$query = sprintf("SELECT * FROM prod_colleges where UPPER(`collegecode`)='%s' LIMIT %d,%d", strtoupper($collegecode),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_colleges where UPPER(`collegecode`)='%s'", strtoupper($collegecode));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];						
		}
		
		public function getByCollegeName($collegename)
		{
			$collegename = $this->sanitize($collegename);
			$query = sprintf("SELECT * FROM prod_colleges where UPPER(`collegename`)='%s' LIMIT %d,%d", strtoupper($collegename),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;	
					
			$query = sprintf("SELECT count(*) FROM prod_colleges where UPPER(`collegename`)='%s'", strtoupper($collegename));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];			
		}
	}
?>