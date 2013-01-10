<?php
	include('controller.php');
	
	class Courses extends Controller
	{
		public $headerMsg;
		public $result;
		private $model;
		
		private $validParameters = array("coursecode","subjectcode","collegecode","coursetitle");									
		
		public function __construct()
		{
			parent::__construct();
			
			include('models/courses.php');
			$this->model = new CoursesModel($this->page,$this->size);
			
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
						$this->getByCourseCode($this->values[0]);
					else if ($this->parameters[0] == $this->validParameters[1])
						$this->getBySubjectCode($this->values[0]);
					else if ($this->parameters[0] == $this->validParameters[2])
						$this->getByCollegeCode($this->values[0]);
					else
						$this->getByCourseTitle($this->values[0]);
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
			$this->result['courses']['course'] = $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";
		}
		
		private function getByCourseCode($coursecode)
		{			
			$this->model->getByCourseCode($coursecode); 			
			$this->result['courses']['course'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";
		}
		
		private function getBySubjectCode($subjectcode)
		{
			$this->model->getBySubjectCode($subjectcode); 			
			$this->result['courses']['course'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";			
		}
		
		private function getByCollegeCode($collegecode)
		{
			$this->model->getByCollegeCode($collegecode); 			
			$this->result['courses']['course'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";			
		}
		
		private function getByCourseTitle($coursetitle)
		{
			$this->model->getByCourseTitle($coursetitle); 			
			$this->result['courses']['course'] =  $this->model->output;
			$this->result['count'] = (int)$this->model->count;
			$this->result['status'] = "ok";			
		}

	}
?>