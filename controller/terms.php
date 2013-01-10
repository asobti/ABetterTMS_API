<?php
	include('controller.php');
	
	class Terms extends Controller
	{
		public $headerMsg;
		public $result;
		private $model;
		
		private $validParameters = array("termcode","termname");									
		
		public function __construct()
		{
			parent::__construct();
			
			include('models/terms.php');
			$this->model = new TermsModel($this->page,$this->size);
			
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
						$this->getByTermCode($this->values[0]);
					else 
						$this->getByTermName($this->values[0]);
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
			$this->result['terms']['term'] = $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";
		}
		
		private function getByTermCode($termcode)
		{			
			$this->model->getByTermCode($termcode); 			
			$this->result['terms']['term'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";
		}
		
		private function getByTermName($termname)
		{
			$this->model->getByTermName($termname); 			
			$this->result['terms']['term'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";			
		}
	}
?>