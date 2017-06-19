<!DOCTYPE html>
<?php
include('httpful.phar');

ini_set('display_errors', 1);

$get_request = 'http://localhost/webproject/op002?op=loadClients';
$response = \Httpful\Request::get($get_request)->send();
echo $response->body();


?>