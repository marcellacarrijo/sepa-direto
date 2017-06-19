<?php
class cmdAtenderChamado{
	
	private $conn;

 public function executar($request){
	 
	$this->conn = (new DBConnector());
		
	$paramsArr = json_decode($request->getBody(), true);	
	
	$keys = array_keys($paramsArr);
    $stringKeys = (implode(",", $keys));	
	
    $values = array_values($paramsArr);
    $stringValues = implode("','", $values);	
	
	print_r ($paramsArr);
	$queryOrdem = "select e.ordem, e.cod_etapa from etapas e where cod_filas = ".$paramsArr['fila']." and e.ordem > ".$paramsArr['ordem']." and e.situacao = 1 order by e.ordem asc"; 
	$ordens = self::select($queryOrdem);
	
	$updateTramite ="update direct.tramites t set dta_fim = sysdate() where t.cod_chamado = ".$paramsArr['chamado']." and cod_etapas = ".$paramsArr['codEtapa']." and cod_fila =" .$paramsArr['fila'];
	self::execute_query($updateTramite);
	
	if($ordens == null){

		$updateChamado = "update direct.chamados t set dta_fechamento = sysdate() where t.cod_chamado = ".$paramsArr['chamado']." and cod_fila =" .$paramsArr['fila'];
		self::execute_query($updateChamado);
	} else {
	
		$ordem = $ordens[0]['ordem'];
	
		$insertTramite = "insert into direct.tramites (cod_chamado,dta_associacao,texto, dta_abertura,sequencia,cod_etapas,id_usuario, cod_fila) VALUES (".$paramsArr['chamado'].", sysdate(), '".$paramsArr['texto']."', sysdate(), ".$ordem.", ". $ordem.", 1, ".$paramsArr['fila'].")";
		$result = self::execute_query($insertTramite);
		
	}

 }
 
private function select($query) {	
    return $this->conn->query($query)->fetchAll(PDO::FETCH_ASSOC);     
}
 
  private function execute_query($query) {
       $this->conn->query($query);
    }
}