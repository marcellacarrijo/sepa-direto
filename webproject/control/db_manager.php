<?php

class DBConnector extends PDO{

	private $engine;
	private $host;
	private $database;
	private $user;
	private $pass;
	private $connection;
	
	public function __construct(){
	$this->engine = 'mysql';
	$this->host = 'localhost';
	$this->database = 'direct';
	$this->user = 'root';
	$this->pass = '';
	$dns = $this->engine. ':dbname='.$this->database.";host=".$this->host;
	parent::__construct( $dns, $this->user, $this->pass );
	}
}