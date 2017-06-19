<!DOCTYPE html>
<?php
include('httpful.phar');

function getContents ($op) {	
	$get_request = 'http://localhost/webproject/op002?op='.$op;
	$response = \Httpful\Request::get($get_request)->send();	
	return json_decode($response->body, true);

}
?>
<html lang="en">
<head>
	<?php include("header.php");?>
</head>

<body>
	<div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Abrir Chamado</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Abrir chamado
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="abrirChamadoProc.php" method="post">
                                            <div class="form-group">
                                                <label for="enabledSelect">Cliente</label>
                                                <select id="cliente" name="cliente" onchange="loadFilas(this)">
												<option value="" id="cod_fila" name="cod_fila"> - </option>
												<?php												
												$clientes = getContents("loadClients");
												foreach ($clientes as $key =>$value) {	
													echo '<option value="'.$value['id_clientes'].'" id="cod_fila" name="cod_fila">'.$value['nome'].'</option>';
												}
												?>
                                                </select>
                                            </div>
											<div class="form-group">
                                                <label for="enabledSelect">Motivo</label>
                                            </div>
												<div id="filas" class="form-group">
											</div>
											
											<div class="form-group">
												<label>Descrição: </label>
												<textarea class="form-control" rows="3" id="texto" name="texto"></textarea>
											</div>
                                        <button type="submit" class="btn btn-default" href="abrirChamado.php">Abrir Chamado</button>
                                        <button type="reset" class="btn btn-default">Limpar Campos</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	
	<script>
	function loadFilas(cliente) {
  
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var filasCliente = JSON.parse(this.responseText);
				montaSelect(filasCliente);
			}
		};
		xhttp.open("GET", "http://localhost/webproject/op002?op=loadFilas&cod_cliente="+cliente.value, true);
		xhttp.send();
	}

	function montaSelect (filas) {
		var divFilas = document.getElementById("filas");
		var select;
	
		if (document.getElementById("selectFilas") === null) {
			select = document.createElement("select");
			select.id = "selectFilas";
			select.name = "fila";
			select.class = "form-control";
			divFilas.appendChild(select);
		} else {
			select = document.getElementById("selectFilas");
			select.options.length=0;
		}
	
		for (var i = 0; i < filas.length; i++) {
			var fila = filas[i];		
			var option = document.createElement("option");
			option.value = fila.cod_fila;
			option.text = fila.nome;
			select.appendChild(option);
		}
	}
	</script>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
