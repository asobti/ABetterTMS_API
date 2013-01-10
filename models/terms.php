<?php
	include('model.php');
	
	class TermsModel extends Model
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
			$query = sprintf("SELECT `termcode`,`termname` FROM prod_terms LIMIT %d,%d",($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_terms");
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
		}
		
		public function getByTermCode($termcode)
		{
			$termcode= $this->sanitize($termcode);
			$query = sprintf("SELECT `termcode`,`termname` FROM prod_terms where UPPER(`termcode`)='%s' LIMIT %d,%d", strtoupper($termcode),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_terms where UPPER(`termcode`)='%s'", strtoupper($termcode));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
						
		}
		
		public function getByTermName($termname)
		{
			$termname= $this->sanitize($termname);
			$query = sprintf("SELECT `termcode`,`termname` FROM prod_terms where UPPER(`termname`)='%s' LIMIT %d,%d", strtoupper($termname),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_terms where UPPER(`termname`)='%s'", strtoupper($termname));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
								
		}
	}
?>