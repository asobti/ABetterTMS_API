<?php
	include('model.php');
	
	class CoursesModel extends Model
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
			$query = sprintf("SELECT c.coursecode,c.subjectcode,c.coursenumber,c.coursetitle,s.collegecode FROM prod_courses AS c INNER JOIN prod_subjects AS s ON c.subjectcode = s.subjectcode LIMIT %d,%d",($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_courses");
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
		}
		
		public function getByCourseCode($coursecode)
		{			
			$query = sprintf("SELECT c.coursecode,c.subjectcode,c.coursenumber,c.coursetitle,s.collegecode FROM prod_courses AS c INNER JOIN prod_subjects AS s ON c.subjectcode = s.subjectcode WHERE c.coursecode=%d LIMIT %d,%d",(int)$coursecode, ($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_courses WHERE coursecode=%d",(int)$coursecode);
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
						
		}
		
		public function getBySubjectCode($subjectcode)
		{
			$subjectcode = $this->sanitize($subjectcode);
			$query = sprintf("SELECT c.coursecode,c.subjectcode,c.coursenumber,c.coursetitle,s.collegecode FROM prod_courses AS c INNER JOIN prod_subjects AS s ON c.subjectcode = s.subjectcode WHERE UPPER(c.subjectcode)='%s' LIMIT %d,%d",strtoupper($subjectcode), ($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
					
			$query = sprintf("SELECT count(*) FROM prod_courses WHERE UPPER(subjectcode)='%s'",strtoupper($subjectcode));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
						
		}		
		
		public function getByCollegeCode($collegecode)
		{
			$collegecode= $this->sanitize($collegecode);
			$query = sprintf("SELECT c.coursecode,c.subjectcode,c.coursenumber,c.coursetitle,s.collegecode FROM prod_courses AS c INNER JOIN prod_subjects AS s ON c.subjectcode = s.subjectcode WHERE UPPER(s.collegecode)='%s' LIMIT %d,%d",strtoupper($collegecode), ($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;		
					
			$query = sprintf("SELECT count(*) FROM prod_courses AS c INNER JOIN prod_subjects AS s ON c.subjectcode = s.subjectcode WHERE UPPER(s.collegecode)='%s'",strtoupper($collegecode));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];		
		}
		
		public function getByCourseTitle($coursetitle)
		{
			$coursetitle = $this->sanitize($coursetitle);
			$query = sprintf("SELECT c.coursecode,c.subjectcode,c.coursenumber,c.coursetitle,s.collegecode FROM prod_courses AS c INNER JOIN prod_subjects AS s ON c.subjectcode = s.subjectcode WHERE UPPER(c.coursetitle)='%s' LIMIT %d,%d",strtoupper($coursetitle), ($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;		
					
			$query = sprintf("SELECT count(*) FROM prod_courses WHERE UPPER(coursetitle)='%s'",strtoupper($coursetitle));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];		
		}


	}
?>