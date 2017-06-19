<!DOCTYPE html>
<?php
include('httpful.phar');

function getContents ($op) {
$get_request = 'http://localhost/webproject/op002?op='.$op; 
$response = \Httpful\Request::get($get_request)->send();
return json_decode($response->body, true);
}
?>
<body>
<form action="abrirChamadoProc.php" method="post">
<select id="cliente" name="cliente" onchange="loadFilas(this)">
<option value="" id="cod_fila" name="cod_fila"> - </option>
<?php
$clientes = getContents("loadClients");
foreach ($clientes as $key =>$value) {	
	echo '<option value="'.$value['id_cliente'].'" id="cod_fila" name="cod_fila">'.$value['nome'].'</option>';
}
?>
</select>
<p>
<p>
<div id="filas">
</div>
<p>
<p>
<label>Descricao</label>
<input type="text" id="texto" name="texto"></input>
<button type="submit">Abrir chamado</button>
</form>
</body>
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
		divFilas.appendChild(select);
	} else {
		select = document.getElementById("selectFilas");
		select.options.length=0;
	}
	
	for (var i = 0; i < filas.length; i++) {
		var fila = filas[i];		
		var option = document.createElement("option");
		option.value = fila.cod_filas;
		option.text = fila.nome;
		select.appendChild(option);
	}
}
</script>
</html>