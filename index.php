<?php

extract($_REQUEST) //DETECTAR ERROR
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Practica 1</title>
  <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./node_modules/fontawesome-free-5.15.4-web/css/all.min.css">

  <script src='./node_modules/jquery/jquery.min.js'></script>
  <script src='./node_modules/bootstrap/dist/js/bootstrap.min.js'></script>
  <script src="./login.js"></script>
</head>

<body>

  <div class='container mt-2 mb-4'>
    <h3>Practica 1 Ajax y sesiones</h3>
    <div class='row mt-3'>
      <div class='col-md-3'></div>

      <div class='col-md-6'>
        <div class='card'>
          <div class='card-header bg-secondary text-white text-center'>
            <h4> Bienvenido a practica 1 </h4>
          </div>
          <div class='card-body '>

            <form action="./inicio.php" method='post'>

              <div class='form-group' id='group-correo'>
                <label for=""><strong>Correo:</strong></label>
                <input type="text" class='form-control' name='correo' id='correo' />
              </div>

              <div class='form-group' id='group-contrasenia'>
                <label for=""><strong>Password:</strong></label>
                <input type="password" class='form-control' name='contrasenia' id='contrasenia' />
              </div>

              <button type='submit' class='btn btn-info btn-lg mt-3 mb-3'>
                <i class='fas fa-sign-in-alt fa2x'></i>
                Ingresar
              </button>
            </form>
          </div>
          <div class='card-footer bg-info bg-opacity-50 text-center'>
            <a href="#"> <i class='fas fa-user-plus'></i>
              Registra usuario</a>
          </div>
        </div>
      </div>
    </div>

    <div class='row p-4'>
      <div class='col-md-3'></div>

      <?php
      if (isset($iderror)) :
        switch ($iderror) {
          case 1:
            $mensaje = "User or email field are incorrect";
            break;
          case 2:
            $mensaje = "Invalid session";
            break;
          default:
            $mensaje = "Error desconocido paso";
        }

      ?>

        <div class="alert alert-danger alert-dismissible fade show col-md-6" role="alert">
          <strong>ERROR:</strong> <?= $mensaje ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php
      endif;
      ?>
    </div>
  </div>
</body>

</html>