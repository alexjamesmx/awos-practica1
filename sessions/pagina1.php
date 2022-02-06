<?php
session_start();
echo "Sesion iniciada";
session_regenerate_id();
echo "<h5>ID:".session_id()."</h5>";

$_SESSION[ "usurario" ] = "Alex Santiago";
$_SESSION[ "Date" ] = date("m/d/Y");
var_dump( $_SESSION);

echo "<a href='pagina2.php'>Ir a otra pagina del mismo sitio</a>";



session_unset();
session_destroy();
echo "<br> /> Sesion destruida...";
echo "<h5>ID:".session_id()."</h5>";
var_dump( $_SESSION );



?>