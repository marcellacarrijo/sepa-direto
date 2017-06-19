<!DOCTYPE html>
<?php
include('httpful.phar');

function getContents () {
	$get_request = 'http://localhost/webproject/op002?op=loadChamado&chamado='.$_GET['chamado']; 
	$response = \Httpful\Request::get($get_request)->send();
	echo $response->body;
}
?>
<html lang="en">

<head>
	<?php include("header.php");?>
</head>

<body>
	<div id="wrapper">
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Pequisar Chamado</h1>
                    </div>
					<div class="form-group">
					<form name="form" action="atenderChamado.php" method="post">
						<label>Nr° do chamado</label>
						<input class="form-control" id="chamado" name="chamado">
					</div>
					 <button type="submit" class="btn btn-default" href="">Pesquisar</button>
                     <button type="reset" class="btn btn-default">Limpar Campos</button>
					</form>
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
