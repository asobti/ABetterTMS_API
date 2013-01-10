<?php
	include('model.php');
	
	class BuildingsModel extends Model
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
			$query = sprintf("SELECT * FROM prod_buildings LIMIT %d,%d",($this->page * $this->size),$this->size);
			$resource = mysql_query($query);						
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
			
			$query = sprintf("SELECT count(*) FROM prod_buildings");
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];			
		}
		
		public function getByBuildingCode($buildingcode)
		{
			$buildingcode = $this->sanitize($buildingcode);
			$query = sprintf("SELECT * FROM prod_buildings where `buildingcode`=%d LIMIT %d,%d", (int)$buildingcode,($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
			
			$query = sprintf("SELECT count(*) FROM prod_buildings where `buildingcode`=%d", (int)$buildingcode);
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];					
		}
		
		public function getByBuildingName($buildingname)
		{
			$buildingname = $this->sanitize($buildingname);
			$query = sprintf("SELECT * FROM prod_buildings where UPPER(`buildingname`)='%s' LIMIT %d,%d", strtoupper($buildingname),($this->page * $this->size),$this->size);
			$resource = mysql_query($query);
			
			if (mysql_num_rows($resource) > 0)
				while ($row = mysql_fetch_assoc($resource))				
					$this->output[] = $row;
			
			$query = sprintf("SELECT count(*) FROM prod_buildings where UPPER(`buildingname`)='%s'", strtoupper($buildingname));
			$resource = mysql_query($query);			
			$row = mysql_fetch_assoc($resource);
			$this->count = $row['count(*)'];						
		}
	}
?>