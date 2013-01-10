<?php
	include('controller.php');
	
	class Campuses extends Controller
	{
		public $headerMsg;
		public $result;
		private $model;
		
		private $validParameters = array("campuscode","campusname");									
		
		public function __construct()
		{
			parent::__construct();
			
			include('models/campuses.php');
			$this->model= new CampusesModel($this->page,$this->size);
			
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

					if ($this->parameters[0] == $this->validParameters[0])
						$this->getByCampusCode($this->values[0]);
					else 
						$this->getByCampusName($this->values[0]);
				}
				else	//bad request
				{
					$this->headerMsg = 'HTTP/1.1 400 Bad Request';
					$this->result['Failed'] = "Invalid parameter(s) passed";
				}
			}
			else	//no parameters. Return all
			{
				$this->getAll();
			}
		}
		
		private function getAll()
		{			
			$this->model->getAll();
			$this->result['campuses']['campus'] = $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";
		}
		
		private function getByCampusCode($campuscode)
		{			
			$this->model->getByCampusCode($campuscode); 			
			$this->result['campuses']['campus'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";
		}
		
		private function getByCampusName($campusname)
		{
			$this->model->getByCampusName($campusname); 			
			$this->result['campuses']['campus'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";			
		}
	}
?>