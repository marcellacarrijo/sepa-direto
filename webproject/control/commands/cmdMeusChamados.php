<?php
class cmdMeusChamados{

	private $conn;

 public function executar($request){
	
	$this->conn = (new DBConnector());
	
	$method = $request->getParameters()['op']; 
	
	return call_user_func(array($this, $method), $request);
		
 }
 
  private function loadMeusChamados() {
	 
	$queryListaChamados = "select t.cod_chamado, f.nome, e.descricao, t.texto 
							from tramites t, filas f, etapas e 
							where dta_fim is null and t.cod_fila = f.cod_fila and t.cod_etapas = e.cod_etapa";    
	
	return self::select($queryListaChamados);
	 
 }
 private function select($query) {
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
 
 
}