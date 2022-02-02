<?php
require_once( "./helper.php" );
$mysqli = conectar();
//Reciba como parametro: idpais, idedo
$idpais = $_REQUEST[ "idpais" ];
$idedo = $_REQUEST[ "idedo" ];

$sql = "SELECT idmpio, nommpio from municipios
        where
            idpais = '$idpais' and
            idedo = '$idedo'
            order by nommpio";
$rs = query( $sql );

echo json_encode($rs->fetch_all());



desconectar();
?>