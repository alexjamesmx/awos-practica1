<?php    

require_once( "./helper.php" );
$mysqli = conectar();

extract($_REQUEST); // recuperar usuario (correo) y sesion
session_start(); //restaurar sesion
if (!sesion_valida($c, $s)) :
    desconectar();
    header("location:.?iderror=2");
else :

    // Normalizacion de datos 
    if( $accion == "alta" || $accion == "cambio"){
        $nombre = mb_strtoupper( $nombre );
        $apellidos = mb_strtoupper( $apellidos );
    }
switch ( $accion ) {
    case "alta":
        $sql = "insert into personas ( nombre, apellidos, correo, contrasenia, 
                idpais, idedo, idmpio)
        values(
            '$nombre',
            '$apellidos',
            '$correo',
            '$contrasenia',
            '$idpais',
            '$idedo',
            '$idmpio'
        )";
        break;
    
    case "cambio":
        $sql = "update personas 
                SET
                    nombre      =   '$nombre',
                    apellidos   =   '$apellidos',
                    correo      =   '$correo',      
                    idpais      =   '$idpais',
                    idedo       =   '$idedo',
                    idmpio      =   '$idmpio'
                    WHERE idpersona  = '$idpersona'";
                if( $contrasenia != ''){
                    query("UPDATE personas SET contrasenia = '$contrasenia' 
                           WHERE idpersona = '$idpersona'");
                }
        break;

    case "baja":
         $sql = "DELETE from personas where 
         idpersona = '$idpersona'";
        break;
}

query($sql);

desconectar();
header( "location:lista.php?c=$c&s=$s" );
endif;
?>