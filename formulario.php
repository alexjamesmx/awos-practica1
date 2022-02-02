<?php 
require_once("./helper.php");
$mysqli = conectar();
//Recibir como parametro el idpersona / accion
$accion = $_REQUEST[ "accion" ];
if ( $accion == "alta" ){

}
else if ( $accion == "cambio" ){
        $idpersona = $_REQUEST[ "idpersona" ];
        $sql = "SELECT * from personas where idpersona = '$idpersona'"; 
        $rs = query( $sql );
        $row = $rs->fetch_assoc();
        extract( $row );
        $nombre  = mb_strtoupper( $nombre );
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>Practica 1</title>
<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="./node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
  
<script src='./node_modules/jquery/jquery.min.js'></script>
<script src='./node_modules/bootstrap/dist/js/bootstrap.min.js'></script>
<script src='./formulario.js'></script> 
</head>
<body>
    <div class="container mt-2 mb-4 ">
        <h3>Practica 1 Ajaxx y sesiones</h3>
  
        <form action='./procesa.php'> 
            <div class='row'>
                <div class='form-group col-md-2' id='group-nombre'>
                    <label for=""><strong>Nombre:</strong></label>
                    <input type='text' class='form-control' name='nombre' id='nombre'value="<?= $nombre ?>" ></input>
                </div>
                <div class='form-group col-md-3'id='group-apellido'>
                    <label for=""><strong>Apellidos:</strong></label>
                    <input type='text' class='form-control' name='apellido' id='apellido'value='<?= $apellidos ?>' ></input>
                </div>
                <div class='form-group col-md-4'id='group-correo'>
                    <label for=""><strong>Correo:</strong></label>
                    <input type='text' class='form-control' name='correo' id='correo'value='<?= $correo ?> '></input>
                </div>
                <div class='form-group col-md-3'id='group-correo'>
                    <label for=""><strong>Password:</strong>
                    <small class='text-secondary text-opacity-50'>Write down if change</small></label>
                    <input type='password' class='form-control' name='contrasenia' id='contrasenia' ></input>
                </div>
            </div>
     

            <div class='row mb-5'>
                <div class='form-group col-md-4'id='group-idpais'>
                    <label><strong>Pais:</strong></label>
                    <select class='form-control' name='idpais' id='idpais' >
                    </select>
                    <input type="hidden" id='idpais-hidden'value='<?= $idpais ?>'></input>
                </div>
                <div class='form-group col-md-4'id='group-idedo'>
                    <label><strong>Estado/Provincia:</strong></label>
                    <select class='form-control' name='idedo' id='idedo' >   
                    </select>
                    <input type="hidden" id='idedo-hidden'value='<?= $idedo ?>'></input>
                </div>
                <div class='form-group col-md-4'id='group-idmpio'>
                    <label><strong>Municipio/Condado:</strong></label>
                    <select class='form-control' name='idmpio' id='idmpio' >
                    </select>
                    <input type="hidden" id='idmpio-hidden'value='<?= $idmpio ?>'></input>
                </div>
            </div>
       
        <button type='submit'class='btn btn-lg btn-success'>
            <i class='fas fa-save'></i>
            Guardar
        </button>
        <button type='reset'class='btn btn-lg btn-secondary'>
            <i class='fas fa-ban'></i>
            Restablecer
        </button>
    </form>
    </div>
</body>
</html>

<?php  
desconectar();
?>