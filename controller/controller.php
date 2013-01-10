<?php
	class Controller
	{		
		private $requestMethod;
		protected $parameters;
		protected $values;
		private $consumer;	
		protected $headerCode;	
		
		protected $page;
		protected $size;
		
		public function __construct()
		{
			$this->requestMethod = $_SERVER['REQUEST_METHOD'];
			$this->consumer = $_SERVER['REMOTE_ADDR'];
			
			$this->page = 0;
			$this->size = 100;
			
			if (isset($_GET))
			{				
				if (isset($_GET['page']))				
					if ((int)$_GET['page'] > 0)
					{
						$this->page = (int)$_GET['page'] - 1;
						unset($_GET['page']);
					}
				
					
				if (isset($_GET['size']))				
					if ((int)$_GET['size'] > 0 && (int)$_GET['size'] < 5000)
					{
						$this->size = (int)$_GET['size'];
						unset($_GET['size']);
					}
				
				foreach($_GET as $key=>$value) { $this->values[] = $value; $this->parameters[] = $key; }
				
			}
				
			$this->verifyRequestStatus();
		}
		
		private function verifyRequestStatus()
		{
			if ($this->requestMethod == "GET")			
				$this->headerCode = 200;			
			else			
				$this->headerCode = 405;
			
		}
	}
?>