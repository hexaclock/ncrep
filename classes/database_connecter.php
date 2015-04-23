<?php


class Database_Connector
{
	private $db_host = "localhost";
	private $db_user = "";
	private $db_pass = "";
	private $db_name = "";
	protected static $connection;
	
  	public function connect()
	{
		if(!isset(self::$connection))
		{
			self::$connection = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
		}
		if(self::$connection === false)
			return false;
		return self::$connection;
	}
	
 	public function disconnect()
	{
		self::$connection->close();
	}
	
	public function quote($value)
	{
		$connection = $this->connect();
		return $connection->real_escape_string($value);
	}
	
	private function parseArray($array, $where = 0)
	{
		$string = "";
		if(empty($array))
			return $string;
			
		if($where)
			$concat = " AND";
		else
			$concat = ",";
			
		foreach($array as $key => $value)
		{
			$key = $this->quote($key);
			$value = $this->quote($value);
			$string .= " `".$key."`='".$value."'".$concat;
		}
		if($where)
			$string = substr($string, 0, -3);
		else
			$string = rtrim($string, ",");
		
		return $string;
	}
	
	private function query($query)
	{
		$connection = $this->connect();
		$result = $connection->query($query);
		if(!$result)
			echo $connection->error;
		return $result;
	}
	
   public function select($table, $columns = "*", $where = NULL, $order = NULL, $limit = NULL)
	{
		$rows = array();
		$statement = "SELECT ".$columns." FROM `".$table."`";
		if(!is_null($where))
		{
			$statement .= " WHERE";
			$statement .= $this->parseArray($where, 1);
		}
		if(!is_null($order))
			$statement .= " ORDER BY ".$order;
		if(!is_null($limit))
			$statement .= " LIMIT ".$limit;
		
		$results = $this->query($statement);
		if($results === false)
			return false;
		
		while($row = $results->fetch_assoc())
		{
			$rows[] = $row;
		}
		return $rows;
	}
	
 	public function insert($table, $columns, $values)
	{
		$statement = "INSERT INTO `".$table."` (";
		foreach($columns as $column)
		{
			$statement .= "`".$column."`,";
		}
		$statement = rtrim($statement, ",");
		$statement .= ") VALUES (";
		foreach($values as $value)
		{
			$value = $this->quote($value);
			$statement .= '"'.$value.'",';
		}
		$statement = rtrim($statement, ",");
		$statement .= ')';
		return $this->query($statement);
	}
	
	public function update($table, $values, $conditions = NULL)
	{
		$statement = "UPDATE `".$table."` SET";
		$statement .= $this->parseArray($values, 0);
		if(!is_null($conditions))
		{
			$statement .= " WHERE";
			$statement .= $this->parseArray($conditions, 1);
		}
		if(!$this->query($statement))
			return false;
		return true;
	}
	
  	public function delete($table, $conditions)
	{
		$statement = "DELETE FROM `".$table."` WHERE";
		$statement .= $this->parseArray($conditions, 1);
		
		return $this->query($statement);
	}
}


// TEST CODE --------------------------------------------------------------------------------------------------------

/* INSERT CODE
$columns = ["id", "username", "password", "name", "email", "iphistory", "currip", "currsessionid", "watch", "registered", "lastlogin", "numlogins"];

$pass = password_hash("simplepass", PASSWORD_BCRYPT, ["cost" => 10]);
$datetime = date('Y-m-d H:i:s');
$values = ["", "sean", $pass, "Sean Loveall", "seanlove3@gmail.com", "2600:1001:b109:621:912f:bb7e:56dc:fef5", "2600:1001:b109:621:912f:bb7e:56dc:fef5", "", "0", $datetime, $datetime, "0"];
if($db->insert("users", $columns, $values) == true)
	echo "Insert works!<br />";
else
	echo "Insert failed<br />";*/
	
/* UPDATE CODE
$values = ["name" => "bob", "email" => "random.1324@gmail.com", "numlogins" => 5];
$conditions = ["id" => 1];
if($db->update("users", $values, $conditions))
	echo "Update works!";
else
	echo "Update failed!";*/


/* SELECT CODE
$columns = "id,name,lastlogin";
$conditions = ["username" => "sean"];
$order = "`id` DESC";
$limit = 1;
if(($data = $db->select("users", $columns, $conditions, $order, $limit)) == false)
	echo "Select failed!<br />";
else
	print_r($data);*/


/* DELETE CODE 
$conditions = ["id" => 1, "name" => "bob"];
if($db->delete("users", $conditions))
	echo "Delete works!<br />";
else
	echo "Delete failed!<br />";*/

?>
