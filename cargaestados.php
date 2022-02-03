<?php
require_once( "./helper.php" );
$mysqli = conectar();
//Reciba como parametro: idpais
$idpais = $_REQUEST[ "idpais" ];

$sql = "SELECT idedo, nomestado from estados where idpais = '$idpais' order by nomestado";
$rs = query( $sql );

echo json_encode($rs->fetch_all());

desconectar();
?>