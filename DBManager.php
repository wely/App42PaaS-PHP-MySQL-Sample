<?php 

class DBManager {

	public $client;
	
	/*
	* initializes mysql with the given credentials
	*/
	
	public function __construct() {
		$lines = file("Config.properties"); 
		foreach ($lines as $line) {
			list($k, $v) = explode('=', $line);
			if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.username"))) {
				$user = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.port"))) {
				$port = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.password"))) {
				$password = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.ip"))) {
				$ip = rtrim(ltrim($v));
			}if (rtrim(ltrim($k)) == rtrim(ltrim("app42.paas.db.name"))) {
				$dbName = rtrim(ltrim($v));
			}
		}
			$this->client = mysqli_connect('localhost', 'demouser','p4ssW0rd1234', 'demodb') or die("Unable to connect to MySQL");
			//("$ip:$port", $user, $password, $dbName)
			
			$this->selected = mysqli_select_db($this->client,$dbName);// or die(mysql_error());
			//$this->selected = mysql_select_db($dbName,$this->client) or die(mysql_error());
	  
    }


	/*
	* insert data into mysql (user table)
	*/
	
	function insertData($name, $email, $description) {
		
		try{
			$sql = "CREATE TABLE user(name VARCHAR(255), email VARCHAR(355), description TEXT)";
			//mysql_query($sql,$this->client);
			mysqli_query($this->client, $sql);
		}catch(Exception $e){
				print_r("Table Already Created");
		}
		mysqli_query($this->client,"INSERT INTO user(name,email,description) VALUES('$name','$email','$description')");
		//mysql_query("INSERT INTO user(name,email,description) VALUES('$name','$email','$description')");
    }
	
	/*
	* get all data from mysql (user table)
	*/
	
	function getAllData() {
		
		$result = mysqli_query($this->client,"select * from user");
		return $result;
		
    }

}

?>