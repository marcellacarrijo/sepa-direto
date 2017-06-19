<!DOCTYPE html>
<html lang="en">
<?php
include('httpful.phar');
	
		$get_request = "http://localhost/webproject/op002?op=loadChamado&chamado=".$_POST['chamado']; 
		$response = \Httpful\Request::get($get_request)->send();
		$chamado = json_decode($response->body, true);

?>

<head>
	<?php include("header.php");?>
</head>

<body>
    <div id="wrapper">
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
			<form role="form" action='atenderChamadoProc.php' method='post'>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chamado: 
						<?php foreach ($chamado as $key =>$value) {
							echo $value['cod_chamado']."<input type='hidden' name='chamado' value=".$value['cod_chamado'].">";
						}?></h1>
                    </div>
					
					<div class="col-lg-12">
                        <p class="help-block"> </p>
                    </div>
					
					<div class="form-group">
						<label>Etapa: </label>
						<?php foreach ($chamado as $key =>$value) {
							echo $value['ordem']."<input type='hidden' name='ordem' value=".$value['ordem']."><input type='hidden' name='codEtapa' value=".$value['cod_etapa']."> - ".$value['descricao']."<input type='hidden' name='descricao' value=".$value['descricao'].">";
						}?>
					</div>
					
						<div class="form-group">
						<label>Data de abertura: </label>
						<?php foreach ($chamado as $key =>$value) {
							echo $value['dta_abertura']."<input type='hidden' name='dtaAbertura' value=".$value['dta_abertura'].">";
						}?>
					</div>
					
					<div class="form-group">
						<label>Motivo: </label>
						<?php foreach ($chamado as $key =>$value) {
							echo $value['nome']."<input type='hidden' name='fila' value=".$value['cod_fila'].">";
						}?>
					</div>
					
					<div class="form-group">
						<label>Descrição do Motivo:</label>
						<?php foreach ($chamado as $key =>$value) {
							echo $value['texto'];
						}?>
					</div>
					
					<div class="form-group">
						<label>Resposta: </label>
						<textarea class="form-control" rows="3" id="texto" name="texto"></textarea>
					</div>

					<button type="submit" class="btn btn-default" href="atenderChamado.php">Atender</button>
					<button type="reset" class="btn btn-default">Limpar Campos</button>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
