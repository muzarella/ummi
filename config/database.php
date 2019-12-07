<?php 


class Database {
private $_connection ;
private static $_instance ;
private $_host = "localhost";
private $_username = "root" ;
private $_password = "";
private $_dbname = "ummi" ;


/*

get an instance of the database 
@return instance 
*/


public  static function getInstance (){
	if (!self::$_instance){
		self::$_instance = new self ();
	}
	return self::$_instance ;

}


public function __construct(){

	
	try{

		$this->_connection = new PDO ("mysql:host=$this->_host;dbname=$this->_dbname",$this->_username, $this->_password) ;

// set the pdo error mode to exception 
		$this->_connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->_connection->setAttribute(PDO::ATTR_EMULATE_PREPARES,false );

	}
	catch(PDOException $e){
		echo " Connection failed :".$e->getMessage();


	}
	
}


// get mysqli connection 

public function getConnection (){
	return $this->_connection ;
}

}



?>