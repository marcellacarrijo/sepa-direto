<?php

class cmdValidarLogin{
	
	private $conn;

 public function executar($request){
	 
	$this->conn = (new DBConnector());
		
	$paramsArr = json_decode($request->getBody(), true);	
	
	$keys = array_keys($paramsArr);
    $stringKeys = (implode(",", $keys));	
	
    $values = array_values($paramsArr);
    $stringValues = implode("','", $values);	
	
	$queryL = "select * from direct.usuarios where login_usuario = '".$paramsArr['login_usuario']."' and senha = '".$paramsArr['senha']."'";
	
	$retorno = self::select($queryL);
	 
	if (count($retorno) > 0 ) {
		return true;	
	} else {
		return false;
	}
	
	
	//return self::select($queryL);
	 
	
 }
 
 private function select($query) {
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);  
    }
 
 
}