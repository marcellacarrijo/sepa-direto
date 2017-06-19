<?php
include('httpful.phar');

session_start();

if ($_POST['login_usuario'] != null && $_POST['senha'] != null) {
	$_SESSION['user'] = $_POST['login_usuario'];
	
	$validarLogin = 'http://localhost/webproject/op006';
	
	$response = \Httpful\Request::post($validarLogin)
		->sendsJson()
		->body(json_encode($_POST))
		->send();
	
	$out = $response->body;
	
	if($out == "false"){
  		echo     '<script>
		alert("Senha ou login inválido!");
		window.location.href = "login.php";
	    		</script>';
	}
	else{		
		$id = $_POST['login_usuario'];
		$_SESSION['login'] = $id;
		echo '<script>
		alert("Sucesso!");
		window.location.href = "meusChamados.php";
	          </script>';
	}
}
?>