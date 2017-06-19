<head>
	<?php include("header.php");?>
</head>
<?php

include('httpful.phar');
 
$json = json_encode($_POST);
 
$get_request = 'http://localhost/webproject/op001?';
 
$response = \Httpful\Request::post($get_request)
->sendsJson()
->body($json)
->send();
//echo $response;
//echo 'Chamado aberto (talvez)';
?>
<body>
    <div id="wrapper">
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chamado aberto, numero: 
						<?php
							echo $response->body;
						?>
						</h1>
                    </div>
					<form action='index.php' method='post'
						<button type="submit" class="btn btn-default" href="index.php">Voltar</button>
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





