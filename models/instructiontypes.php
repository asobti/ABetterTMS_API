<?php
	include('model.php');
	
	class InstructiontypesModel extends Model
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
			$query = sprintf("SELECT * FROM prod_instructiontype LIMIT %d,%d",($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_instructiontype");
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
		}
		
		public function getByInstructiontypeCode($instructiontypecode)
		{
			$instructiontypecode= $this->sanitize($instructiontypecode);
			$query = sprintf("SELECT * FROM prod_instructiontype where `instructiontypecode`=%d LIMIT %d,%d", (int)$instructiontypecode,($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_instructiontype where `instructiontypecode`=%d", (int)$instructiontypecode);
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
						
		}
		
		public function getByInstructiontypeName($instructiontypename)
		{
			$instructiontypename= $this->sanitize($instructiontypename);
			$query = sprintf("SELECT * FROM prod_instructiontype where UPPER(`instructiontypename`)='%s' LIMIT %d,%d", strtoupper($instructiontypename),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;	
					
			$query = sprintf("SELECT count(*) FROM prod_instructiontype where UPPER(`instructiontypename`)='%s'", strtoupper($instructiontypename));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];			
		}
	}
?>