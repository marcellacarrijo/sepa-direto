<?php
class cmdListarChamados{

	private $conn;

 public function executar($request){
	 
	$this->conn = (new DBConnector());
	
	$method = $request->getParameters()['op']; 
	
	return call_user_func(array($this, $method), $request);
		
 }
 
 private function loadChamados() {
	 
	//$queryChamados = "select c.cod_chamado from chamados c where c.dta_fechamento is null";
	//$result = self::select($queryChamados);
	
	//print_r($result);
	 
	$queryListaChamados = "select t.cod_chamado, f.nome, e.descricao, t.texto, e.ordem, t.cod_fila, DATE_FORMAT(t.dta_abertura,'%d/%m/%Y') as dta_abertura, t.cod_etapas 
								from tramites t, filas f, etapas e 
												where t.cod_fila = f.cod_fila
												and t.cod_etapas = e.cod_etapa
												and f.cod_fila = e.cod_filas
												and t.dta_fim is null
												and t.cod_chamado in (select c.cod_chamado from chamados c where c.dta_fechamento is null)
												order by t.dta_abertura asc";
	
	return self::select($queryListaChamados);
	 
 }
 
 private function select($query) {
        return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);  
    }
 
 
}