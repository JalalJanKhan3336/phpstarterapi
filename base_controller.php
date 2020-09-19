<?php 
/**
 * General Controller Class
 */
abstract class BaseController
{
	protected $conn;
	protected $table;

	abstract protected function connectionFailure($error);
	abstract protected function bindParams($stmt);

	function __construct($table)
	{
		require_once dirname(__DIR__, 1).'/config/database.php';
		
		$db = new Database();
		$this->conn = $db->connect();
		$this->table = $table;

		if($this->conn = null)
			$this->connectionFailure($db->getConnectionError());
	}

	protected function selectAllQuery($table){
		return 'SELECT * FROM '.$table;
	}

	protected function prepareInsertQuery($query){
		$stmt = $this->conn->prepare($query);

		if($this->bindParams()){
			if(!$stmt->execute())
				toJson(true, $stmt->error, null);
			else
				return true;
		}

	}

	protected function toJson($isError, $msg, $data){
		$response = array(
			'error' => $isError,
			'msg' => $msg,
			'data' => $data,
		);
		
		echo json_encode($response);
	}

}