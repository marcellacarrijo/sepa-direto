<!DOCTYPE html>

<html lang="en">

<head>
	<?php include("header.php");?>
</head>
<?php
ini_set('display_errors', 1);
include('httpful.phar');


function getContents($op) {
	$get_request = 'http://localhost/webproject/op003?op='.$op;
	$response = \Httpful\Request::get($get_request)->send();
	return json_decode($response->body,true);
}
?>


<body>
	<div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Visualização de chamados</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
			
			<!-- /.row -->
			<!-- tabela dos chamados disponíveis para atendimento -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Chamados disponíveis
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>N° do chamado</th>
                                        <th>Previsão Etapa</th>
                                        <th>Motivo do Chamado</th>
                                        <th>Etapa</th>
                                        <th>Detalhes do Chamado</th>
										<th>Data de Abertura do Chamado</th>
										<th>Previsão do Chamado</th>
										<th>Atender Chamado</th>
                                    </tr>
                                </thead>
                                <tbody>
								
									<?php									
										$chamados = getContents("loadChamados");
										$url = "http://localhost/client/atenderChamado.php?cod_chamado=";
										foreach ($chamados as $key =>$value) {	
											echo "<form action='atenderChamado.php' method='post'>
											<tr class='odd gradeX'>
											<td id='chamado' name='chamado' value=".$value['cod_chamado'].">".$value['cod_chamado']."<input type='hidden' name='chamado' value=".$value['cod_chamado']." /></td>
											<td></td>
											<td>".$value['nome']."</td>
											<td>".$value['cod_etapas']." - ".$value['descricao']."</td>
											<td>".$value['texto']."</td>
											<td>".$value['dta_abertura']."</td>
											<td></td>
											<td><button type='submit' class='btn btn-default' href='atenderChamado.php'>Atender</button></td>
											</tr></form>";
										}
									?>
                                </tbody>
                            </table>
                        </div>
						
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	<?php 
		function redirect($url) {
			ob_start();
			header('Location: '.$url);
			ob_end_flush();
			die();
		}
	?>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="vendor/raphael/raphael.min.js"></script>
    <script src="vendor/morrisjs/morris.min.js"></script>
    <script src="data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
