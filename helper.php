<?php 
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
//BIBLIOTECA DE FUNCIONES 
    // contectar()         : Conectar a una BD 
    // desconectar()       : Desconectar
    // query()             : Ejecuta instruccion SQL en MySQL
    // verficia_usuario() : valida un usuario existente
    // sesion_valida()     : valida una sesion existente
    
 //$mysqli = conectar();
 //$rs = query( "select * from paises");
 //var_dump( $rs->fetch_all());
 //verifica_usuario("zavaleta@uteq.edu.mx",'123');
 //desconectar();

function conectar(){
    $servidor = "127.0.0.1";
    $usuario = "root";
    $password ="Alejandro2mx";
    $bd = "bd_awos";
    $mysqli = new mysqli( $servidor, $usuario, $password, $bd );
 
 return $mysqli;
}


function desconectar(){
    global $mysqli;
    $mysqli->close();
}
function query($sql){
    global $mysqli;
    $rs = $mysqli->query($sql)
        or die("ERROR BASE DE DATOS: ".$mysqli->error);
    return $rs;
}

function verifica_usuario($usuario,$contrasenia){
    $rs = query("select * from personas where correo like binary 
    '$usuario' and contrasenia like binary '$contrasenia'");
    echo $rs->num_rows == 1;
}

function sesion_valida(){
    
}

?>