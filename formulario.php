<?php 
require_once("./helper.php");
$mysqli = conectar();
extract($_REQUEST); // recuperar usuario (correo) y sesion
session_start(); //restaurar sesion
if (!sesion_valida($c, $s)) :
    desconectar();
    header("location:.?iderror=2");
else :
  
//Recibir como parametro el idpersona / accion
$accion = $_REQUEST[ "accion" ];
if ( $accion == "alta" ){
    $idpersona  = 0;
    $nombre     = "";
    $apellidos  = "";
    $correo     = "";
    $idpais     = 0;
    $idedo      = 0;
    $idmpio     = 0;
    
}
else if ( $accion == "cambio" ){
        $idpersona = $_REQUEST[ "idpersona" ];
        $sql = "SELECT * from personas where idpersona = '$idpersona'"; 
        $rs = query( $sql );
        $row = $rs->fetch_assoc();
        extract( $row );
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
        <a href="cerrar.php?c=<?=$c?>&s=<?=$s?>">
      <small>
        <i class='fas fa-sign-out-alt'> </i>
          Log out (<?= $_SESSION["correo"] ?>)
          </small>
      </a>
  
        <form action='./procesa.php'id='form-persona'> 


        <input type="hidden"name='accion'value="<?=$accion?>">
        <input type="hidden"name='idpersona'value="<?=$idpersona?>">
        <input type="hidden"name='c'value="<?=$c?>">
        <input type="hidden"name='s'value="<?=$s?>">

            <div class='row mt-4'>
                <div class='form-group col-md-2' id='group-nombre'>
                    <label for=""><strong>Nombre:</strong></label>
                    <input type='text' class='form-control' name='nombre' id='nombre'value="<?= $nombre?>" ></input>
                </div>
                <div class='form-group col-md-3'id='group-apellido'>
                    <label for=""><strong>Apellidos:</strong></label>
                    <input type='text' class='form-control' name='apellidos' id='apellidos'value='<?= $apellidos?>' ></input>
                </div>
                <div class='form-group col-md-4'id='group-correo'>
                    <label for=""><strong>Correo:</strong></label>
                    <input type='text' class='form-control' name='correo' id='correo'value='<?= $correo ?>'></input>
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
        <button type='reset'class='btn btn-lg btn-secondary'id='btn-restablecer'>
            <i class='fas fa-ban'></i>
            Restablecer
        </button>
        <a href="./lista.php?c=<?= $c ?>&s=<?= $s ?>" class='btn btn-lg btn-danger'>
            <i class='fas fa-times'></i>
            Cancelar
        </a>
    </form>
    </div>
</body>
</html>

<?php  
desconectar();
endif;
?>