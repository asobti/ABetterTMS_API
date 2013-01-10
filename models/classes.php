<?php
	include('model.php');
	
	class ClassesModel extends Model
	{
		public $output;
		public $count;
		
		public function __construct($page,$size)
		{
			parent::__construct($page,$size);
			$this->output = array();
		}
		
		public function getByCRN($crn)
		{
			
			$query = sprintf("SELECT class.crn, t.termname, coll.collegename, sub.subjectname, c.coursenumber, c.coursetitle, s.sec,class.days,class.time,it.instructiontypename,ic.instructorname,class.credits,ca.campusname, b.buildingname, class.startdate, class.enddate, class.room, class.maxenroll, class.enroll, class.comments, class.description FROM prod_classinfo as class INNER JOIN prod_instructiontype as it ON class.instructiontypecode = it.instructiontypecode INNER JOIN prod_instructors as ic ON ic.instructorcode = class.instructorcode INNER JOIN prod_campus as ca ON ca.campuscode = class.campuscode INNER JOIN prod_buildings as b ON b.buildingcode = class.buildingcode INNER JOIN prod_sections as s ON s.crn = class.crn INNER JOIN prod_courses as c ON s.coursecode = c.coursecode INNER JOIN prod_subjects as sub ON c.subjectcode = sub.subjectcode INNER JOIN prod_colleges as coll ON coll.collegecode = sub.collegecode INNER JOIN prod_terms as t ON t.termcode = s.termcode WHERE class.crn=%d LIMIT %d,%d",(int)$crn,($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
			
			$query = sprintf("SELECT count(*) FROM prod_classinfo WHERE crn=%d",(int)$crn);
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];
						
		}
		
		public function getByCustom($params)
		{
			$params = $this->sanitize($params);
			
			$query = sprintf("SELECT class.crn, t.termname, coll.collegename, sub.subjectname, c.coursenumber, c.coursetitle, s.sec,class.days,class.time,it.instructiontypename,ic.instructorname,class.credits,ca.campusname, b.buildingname, class.startdate, class.enddate, class.room, class.maxenroll, class.enroll, class.comments, class.description FROM prod_classinfo as class INNER JOIN prod_instructiontype as it ON class.instructiontypecode = it.instructiontypecode INNER JOIN prod_instructors as ic ON ic.instructorcode = class.instructorcode INNER JOIN prod_campus as ca ON ca.campuscode = class.campuscode INNER JOIN prod_buildings as b ON b.buildingcode = class.buildingcode INNER JOIN prod_sections as s ON s.crn = class.crn INNER JOIN prod_courses as c ON s.coursecode = c.coursecode INNER JOIN prod_subjects as sub ON c.subjectcode = sub.subjectcode INNER JOIN prod_colleges as coll ON coll.collegecode = sub.collegecode INNER JOIN prod_terms as t ON t.termcode = s.termcode WHERE t.termcode='%s'",$params['termcode']);		
			
			foreach($params as $key=>$value)
			{
				if ($key == "termcode")
					continue;
				else if ($key == "days")
					$query .= " AND class.days = '$value'";
				else if ($key == "instructiontypecode")
					$query .= " AND class.instructiontypecode = $value";
				else if ($key == "instructorcode")
					$query .= " AND class.instructorcode = $value";
				else if ($key == "campuscode")
					$query .= " AND class.campuscode = $value";
			}
			
			$countquery = $query;
			$query .= sprintf(" LIMIT %d,%d",($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;

			$resource = mysql_query($countquery);			
			$this->count = mysql_num_rows($resource);			
		}
	
	}
?>