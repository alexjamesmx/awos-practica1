<?php
session_start(); //crear o reactivar sesion

echo "Sesion restaurada";
echo "<h5>ID:".session_id()."</h5>";

$_SESSION[ "usurario" ] = "Alex Santiago";
$_SESSION[ "Date" ] = date("m/d/Y");
var_dump( $_SESSION);

?>