<?php
require_once("./helper.php");
$mysqli = conectar();
session_start();
extract($_REQUEST); // recuperar usuario (correo) y sesion

if (!sesion_valida($c, $s)) :
    desconectar();
    header("location:.?iderror=2");
else :
    $sql = "select p.idpersona, p.nombre, p.apellidos, p.correo, nompais, 
nomestado, nommpio from personas as p 
left join paises using ( idpais )
left join estados using ( idpais, idedo )
left join municipios using ( idpais, idedo, idmpio )
order by apellidos, nombre";
    $rs = query($sql);
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
        <script src='./lista.js'></script>
        <!-- <link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome-free-5.15.4-web/css/all.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./bootstrap-5.1.3-dist/js/bootstrap.min.js"></script> -->
    </head>

    <body>

        <div class="container-fluid mt-2 mb-4">
            <h3>Practica 1 Ajaxx y sesiones</h3>

      <a href="cerrar.php?c=<?=$c?>&s=<?=$s?>">
      <small>
        <i class='fas fa-sign-out-alt'> </i>
          Log out (<?= $_SESSION["correo"] ?>)
          </small>
      </a>
            <?php
            if ($rs->num_rows > 0) :
            ?>

                <table class='table table-bordered table-hover mt-3'>
                    <thead>
                        <tr class='bg-secondary text-white'>
                            <th>Nombre completo</th>
                            <th>Apellidos </th>
                            <th>Correo</th>
                            <th>Pais</th>
                            <th>Estado/provincia</th>
                            <th>Municipio/condado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($row = $rs->fetch_assoc()) :
                            // die( var_dump($row));
                            extract($row);
                        ?>
                            <tr>
                                <td><?= $nombre ?></td>
                                <td><?= $apellidos ?></td>
                                <td><?= $correo ?></td>
                                <td><?= $nompais ?></td>
                                <td><?= $nomestado ?></td>
                                <td><?= $nommpio ?></td>
                                <td class='text-center d-flex justify-content-around'>
                                    <a class='btn btn-primary' href='./formulario.php?accion=cambio&idpersona=<?= $idpersona ?>'>
                                        <i class='fas fa-user-edit'></i>
                                    </a>
                                    <button class='btn btn-danger btn-borrar' type='button' data-bs-toggle='modal' data-bs-target='#modal-bajas' data-idpersona='<?= $idpersona ?>' data-nombre-persona="<?= "$nombre $apellidos" ?>">
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
            else :
            ?>
                <div class='alert alert-warning alert-dismissible fade show mt-3 col-md-8' role='alert'>
                    <strong>ADVERTENCIA!</strong> No hay datos de personas registradas.
                    <button type='button' class='btn-close' data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            <?php
            endif;
            ?>


            <a class='btn btn-success btn-lg mt-3' href='./formulario.php?accion=alta'>
                <i class='fas fa-user-plus fa-2x'></i>
                Agregar persona
            </a>

        </div>


        <!-- Modal -->
        <div class="modal fade" id="modal-bajas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete person <strong id='nombre-persona-borrar'></strong></h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id='btn-borrar-confirmar'>
                            <i class='fas fa-trash'></i>
                            Yes
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class='fas fa-times'></i>
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </body>

    </html>

<?php
    desconectar();

endif;
?>