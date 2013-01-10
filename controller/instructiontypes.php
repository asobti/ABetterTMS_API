<?php
	include('controller.php');
	
	class Instructiontypes extends Controller
	{
		public $headerMsg;
		public $result;
		private $model;
		
		private $validParameters = array("instructiontypecode","instructiontypename");									
		
		public function __construct()
		{
			parent::__construct();
			
			include('models/instructiontypes.php');
			$this->model = new InstructiontypesModel($this->page,$this->size);
			
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
						$this->getByInstructiontypeCode($this->values[0]);
					else 
						$this->getByInstructiontypeName($this->values[0]);
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
			$this->result['instructiontypes']['instructiontype'] = $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";
		}
		
		private function getByInstructiontypeCode($instructiontypecode)
		{			
			$this->model->getByInstructiontypeCode($instructiontypecode); 			
			$this->result['instructiontypes']['instructiontype'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";
		}
		
		private function getByInstructiontypeName($instructiontypename)
		{
			$this->model->getByInstructiontypeName($instructiontypename); 			
			$this->result['instructiontypes']['instructiontype'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";			
		}
	}
?>