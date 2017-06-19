<?php 
include_once ('../webproject/model/request.php');
include_once ('../webproject/control/commands/cmdAbrirChamado.php');
include_once ('../webproject/control/commands/cmdGenerica.php');
include_once ('../webproject/control/commands/cmdAtenderChamado.php');
include_once ('../webproject/control/commands/cmdListarChamados.php');
include_once ('../webproject/control/commands/cmdMeusChamados.php');
include_once ('../webproject/control/commands/cmdValidarLogin.php');
include_once ('db_manager.php');
 
class ResourceController
{  
    private $METHODMAP = ['GET' => 'search' , 'POST' => 'create' , 'PUT' => 'update', 'DELETE' => 'remove' ];
   
    public function treat_request($request) {
		$query = "select op.op_destino from direct.operacoes op where op.cod_operacoes like '". $request->getResource() ."'";
		$destino = self::select($query);
		$class_destino = $destino[0]['op_destino'];
		$object = new $class_destino();		
		return $object->executar($request);
    }
   
    private function select($query) {       
        $conn = (new DBConnector())->query($query);
        return $conn->fetchAll(PDO::FETCH_ASSOC);       
    }
 
    private function create($request) {    
        $body = $request->getBody();
        //var_dump($body);
        $resource = $request->getResource();       
        $query = 'INSERT INTO '.$resource.' ('.$this->getColumns($body).') VALUES ('.$this->getValues($body).')';
       
        return self::execution_query($query);
         
    }
       
    private function queryParams($params) {
       
        $query = "";       
        foreach($params as $key => $value) {
            $query .= $key.' = '."'".$value."'".' AND ';   
        }
        $query = substr($query,0,-5);
        if ($query == null) {
            $query.=1;     
        }
        return $query;
    }
 
    private function execution_query($query) {
        $conn = (new DBConnector());
        $conn->query($query);
    }
       
    private function getUpdateCriteria($json)
    {
        $criteria = "";
        $where = " WHERE ";
        $array = json_decode($json, true);
        foreach($array as $key => $value) {
            if($key != 'id')
                $criteria .= $key." = '".$value."',";
           
        }
        return substr($criteria, 0, -1).$where." id = '".$array['id']."'";
    }
   
    private function getColumns($json)
    {
        $array = json_decode($json, true);
        $keys = array_keys($array);
        return implode(",", $keys);
   
    }
 
    private function getValues($json)
        {
                $array = json_decode($json, true);
                $values = array_values($array);
                $string = implode("','", $values);
        return "'".$string."'";
       
        }
 
   
}