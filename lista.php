<?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
require_once( "./helper.php" );
$mysqli = conectar();
$sql = "select p.idpersona, p.nombre, p.apellidos, p.correo, nompais, 
nomestado, nommpio from personas as p 
left join paises using ( idpais )
left join estados using ( idpais, idedo )
left join municipios using ( idpais, idedo, idmpio )
order by apellidos, nombre";
$rs = query( $sql );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1</title>
<link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="./node_modules/fontawesome-free-5.15.4-web/css/all.min.css">
    <script src='./node_modules/jquery/jquery.min.js'></script>
    <script src='./node_modules/bootstrap/dist/js/bootstrap.min.js'></script>
    <!-- <link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome-free-5.15.4-web/css/all.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./bootstrap-5.1.3-dist/js/bootstrap.min.js"></script> -->
</head>
    <body>
        
        <div class="container-fluid mt-2 mb-4">
            <h3>Practica 1 Ajaxx y sesiones</h3>
            <?php
            if( $rs->num_rows > 0):
            ?>

            <table class='table table-bordered table-hover mt-3'>
                <thead>
                    <tr class='bg-secondary text-white'>     
                        <th>Nombre completo</th>
                        <th>Correo</th>
                        <th>Pais</th>
                        <th>Estado/provincia</th>
                        <th>Municipio/condado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
        
            <tbody>
            <?php
            while($row = $rs->fetch_assoc()):
            // die( var_dump($row));
                extract( $row );
            ?>
            <tr>
                <td><?= $nombre ?></td>
                <td><?= $correo ?></td>
                <td><?= $nompais ?></td>
                <td><?= $nomestado?></td>
                <td><?= $nommpio ?></td>
                <td class='text-center d-flex justify-content-around'>
                    <a class='btn btn-primary'
                    href='./formulario.php?accion=cambio&idpersona=<?= $idpersona ?>'>
                        <i class='fas fa-user-edit'></i>
                    </a>
                    <button class='btn btn-danger'type='button'>
                        <i class='fas fa-user-times'></i>
                    </button>
                </td>
            </tr>
                <?php 
                endwhile; 
                ?>
            </tbody>
            </table>
            <?php
            else:
            ?>
                <div class='alert alert-warning alert-dismissible fade show mt-3 col-md-8' role='alert' >
                    <strong>ADVERTENCIA!</strong> No hay datos de personas registradas.
                    <button type='button' class='btn-close' data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            <?php
            endif;
            ?>


            <a class='btn btn-success btn-lg mt-3'
            href='./formulario.php?accion=alta'>
                <i class='fas fa-user-plus fa-2x'></i>
                Agregar persona
            </a>

        </div>
    </body>
</html>

<?php  
desconectar();
?>