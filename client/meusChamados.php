<!DOCTYPE html>
<html lang="en">
<head>
   <?php include("header.php");?>
</head>
<?php
include('httpful.phar');



function getContents($op) {
	$get_request = 'http://localhost/webproject/op004?op='.$op; 
	$response = \Httpful\Request::get($get_request)->send();
	//echo $response->body;
	return json_decode($response->body,true);
}
?>



<body>
	<div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Meus Chamados</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Chamados abertos por mim
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
										<th>N° chamado </th>
                                        <th>Abertura Chamado</th>
                                        <th>Motivo do Chamado</th>
                                        <th>Etapa</th>
                                        <th>Detalhes do Chamado</th>
										<th>Previsão do Chamado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
									<?php									
										$meusChamados = getContents("loadMeusChamados");
										foreach ($meusChamados as $key =>$value) {	
											echo "<tr class='odd gradeX'><td>".$value['cod_chamado']."</td><td></td><td>".$value['nome']."</td><td>".$value['descricao']."</td><td>".$value['texto']."</td><td></td></tr>";
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
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
