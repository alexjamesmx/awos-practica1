<?php
require_once( "./helper.php" );
$mysqli = conectar();
$sql = "SELECT * from paises order by idpais";
$rs = query( $sql );

echo json_encode($rs->fetch_all());

desconectar();
?>