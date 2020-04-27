<?php

class Database{
	public $dbName=null;
	private $host=null;
	private $username=null;
	private $pwd=null;
	public $conn=null;

	function __construct($host,$user,$pwd,$db){
		 $this->dbName=$db;
	     $this->host=$host;
	     $this->username=$user;
	     $this->pwd=$pwd;
	     $this->conectar();
	}
	public function conectar(){
		$this->conn = new mysqli($this->host, $this->username, $this->pwd, $this->dbName);
		//var_dump($this->conn);
	}
	public function desconectar(){
		$this->conn->close();
	}
	function _destruct()
	{
		$this->desconectar();
	}
}