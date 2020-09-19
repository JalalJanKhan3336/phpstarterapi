<?php
	/**
	 * Database connection Class
	 */
	class Database {

		// DB Params
		private $host = 'localhost';
		private $db_name = 'vayadb';
		private $username = 'root';
		private $password = '';
		private $conn;
		private $error;
		
		function __construct()
		{
			try{
				$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->username,
					$this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->error = $this->conn->getAttribute(constant("PDO::ATTR_ERRMODE"));
			}catch (PDOException $e){
				$this->error = "Connection Error: ".$e->getMessage();
				echo $this->error;
			}
		}


		public function connect(){
			return $this->conn;
		}

		public function getConnectionError(){
			return $this->error;
		}
	}