<?php
class cmdListarChamados{

	private $conn;

 public function executar($request){
	 
	$this->conn = (new DBConnector());
	
	$queryListaChamados = "select t.cod_chamado, f.nome, e.descricao, t.texto from tramites t, filas f, etapas e where dta_fim is null and t.cod_fila = f.cod_filas and t.cod_etapa = e.cod_etapas;";    
	
	return self::select($queryListaChamados);
		
 }
 
 private function select($query) {
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
 
 
}