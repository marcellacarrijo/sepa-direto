<?php

class cmdGenerica{
	
	private $conn;

 public function executar($request){
	 
	$this->conn = (new DBConnector());
	
	$method = $request->getParameters()['op']; 
	
	return call_user_func(array($this, $method), $request);
	
 }
 
 private function loadClients() {
	 
	$query = "select * from direct.clientes";
	
	
	return self::select($query);
	 
 }
 
  private function loadFilas($request) {
	
	$cliente = $request->getParameters()['cod_cliente'];
	$query = "select cod_fila, nome from direct.filas f where f.id_clientes = ".$cliente." and f.situacao = 1";
	return self::select($query);
	 
 }
 
 private function loadChamado($request) {

	$chamado = $request->getParameters()['chamado'];
	
	$query= "select t.cod_chamado, f.nome, e.descricao, e.cod_etapa, e.ordem, t.texto, f.cod_fila, DATE_FORMAT(t.dta_abertura,'%d/%m/%Y') as dta_abertura from tramites t, filas f, etapas e where dta_fim is null and t.cod_fila = f.cod_fila and t.cod_etapas = e.cod_etapa and t.cod_chamado= " .$chamado;    
	
	return self::select($query);
	 
 }
 
 private function searchChamado($request) {

	$chamado = $request->getParameters()['chamado'];
	
	$query= "select t.cod_chamado, f.nome, e.descricao, e.cod_etapa, e.ordem, t.texto, f.cod_fila, DATE_FORMAT(t.dta_abertura,'%d/%m/%Y') as dta_abertura from tramites t, filas f, etapas e where dta_fim is null and t.cod_fila = f.cod_fila and t.cod_etapas = e.cod_etapa and t.cod_chamado = " .$chamado;    
	$result = self::select($query);
	
	if($result == null){
		return false;
	} else {
		return $result;
	}
 } 
 
 private function execution_query($query) {
        $this->conn->query($query);
 }
 
private function select($query) {	
    return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);  
}
 
 
}