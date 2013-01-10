<?php
	include('controller.php');
	
	class Sections extends Controller
	{
		public $headerMsg;
		public $result;
		private $model;
		
		private $validParameters = array("coursecode");									
		
		public function __construct()
		{
			parent::__construct();
			
			include('models/sections.php');
			$this->model = new SectionsModel($this->page,$this->size);
			
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
				if (in_array($this->parameters[0],$this->validParameters) && count($this->parameters) == 1)
				{

					$this->getByCourseCode($this->values[0]);
				}
				else	//bad request
				{
					$this->headerMsg = 'HTTP/1.1 400 Bad Request';
					$this->result['Failed'] = "Invalid parameter(s) passed";
				}
			}
			else	//coursecode parameter is mandatory
			{
				$this->headerMsg = 'HTTP/1.1 400 Bad Request';
				$this->result['Failed'] = "Invalid parameter(s) passed";
			}			
		}
		
		private function getByCourseCode($coursecode)
		{
			$this->model->getByCourseCode($coursecode); 			
			$this->result['sections']['section'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";			
		}
	}
?>