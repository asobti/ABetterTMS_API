<?php
	include('controller.php');
	
	class Classes extends Controller
	{
		public $headerMsg;
		public $result;
		private $model;
		
		private $validParameters = array("crn","termcode");
		private $filteringParameters = array("days","instructiontypecode","instructorcode","campuscode");									
		
		public function __construct()
		{
			parent::__construct();
			
			include('models/classes.php');
			$this->model = new ClassesModel($this->page,$this->size);
			
			if ($this->headerCode == 200)			
			{
				$this->headerMsg = 'HTTP/1.1 200 OK';				
				$this->route();
			}
			else
			{
				$this->headerMsg = 'HTTP/1.1 405 Method Not Allowed';
				$this->result['Failed'] = "Only GET requests are honored";
			}
				
		}
		
		private function route()
		{
			if (isset($this->parameters))
			{
				if ($this->parameters[0] == $this->validParameters[0] && count($this->parameters) == 1)	//fetching by CRN
				{
					$this->getByCRN($this->values[0]);
				}
				else if ($this->parameters[0] == $this->validParameters[1])	//fetching by termcode
				{
					$isRequestValid = true;
					
					for($i = 1; $i < count($this->parameters); $i++)	//verify filtering parameters
					{
						if (!in_array($this->parameters[$i],$this->filteringParameters))
							$isRequestValid = false;
					}
					
					if ($isRequestValid)		//everything valid. Build custom query
						$this->getbyCustom();
					else
					{
						$this->headerMsg = 'HTTP/1.1 400 Bad Request';
						$this->result['Failed'] = "Invalid parameter(s) passed";
					}						
				}				
				else	//bad request
				{
					$this->headerMsg = 'HTTP/1.1 400 Bad Request';
					$this->result['Failed'] = "Invalid parameter(s) passed";
				}
			}
			else	//no parameters: not allowed
			{
				$this->headerMsg = 'HTTP/1.1 400 Bad Request';
				$this->result['Failed'] = "Invalid parameter(s) passed";
			}
		}
		
		private function getByCRN($crn)
		{			
			$this->model->getByCRN($crn); 			
			$this->result['classes']['class'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";
		}
		
		private function getByCustom()
		{
			$params = array();
			for ($i = 0; $i < count($this->parameters); $i++)
			{
				$params[$this->parameters[$i]] = $this->values[$i];
			}
			$this->model->getByCustom($params);
			$this->result['classes']['class'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";			
		}
	}
?>