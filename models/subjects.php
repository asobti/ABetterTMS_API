<?php
	include('model.php');
	
	class SubjectsModel extends Model
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
			$query = sprintf("SELECT `subjectcode`,`subjectname`,`collegecode` FROM prod_subjects LIMIT %d,%d",($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_subjects");
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
		}
		
		public function getBySubjectCode($subjectcode)
		{
			$subjectcode = $this->sanitize($subjectcode);
			$query = sprintf("SELECT `subjectcode`,`subjectname`,`collegecode` FROM prod_subjects where UPPER(`subjectcode`)='%s' LIMIT %d,%d", strtoupper($subjectcode),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_subjects where UPPER(`subjectcode`)='%s'", strtoupper($subjectcode));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
						
		}
		
		public function getBySubjectName($subjectname)
		{
			$subjectname= $this->sanitize($subjectname);
			$query = sprintf("SELECT `subjectcode`,`subjectname`,`collegecode` FROM prod_subjects where UPPER(`subjectname`)='%s' LIMIT %d,%d", strtoupper($subjectname),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;	
					
			$query = sprintf("SELECT count(*) FROM prod_subjects where UPPER(`subjectname`)='%s'", strtoupper($subjectname));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];			
		}
		
		public function getByCollegeCode($collegecode)
		{
			$collegecode= $this->sanitize($collegecode);
			$query = sprintf("SELECT `subjectcode`,`subjectname`,`collegecode` FROM prod_subjects where UPPER(`collegecode`)='%s' LIMIT %d,%d", strtoupper($collegecode),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;		
					
			$query = sprintf("SELECT count(*) FROM prod_subjects where UPPER(`collegecode`)='%s'", strtoupper($collegecode));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];		
		}

	}
?>