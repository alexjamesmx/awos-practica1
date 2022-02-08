var nombre;
var apellidos;
var correo;
var expcorreo = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

$(document).ready(function () {
  nombre = $("#nombre").val();
  apellidos = $("#apellidos").val();
  correo = $("#correo").val();

  $.ajax({
    url: "./cargapaises.php",
    dataType: "json",
  })
    .done(function (json) {
      $("#idpais").html("");
      $("#idpais").append(
        $("<option>", {
          text: "-- Seleccione pais",
          value: 0,
        })
      );

      $.each(json, function (i, pais) {
        $("#idpais").append(
          $("<option>", {
            text: pais[1],
            value: pais[0],
          })
        );
      });
      $("#idpais").val($("#idpais-hidden").val());
      carga_edos($("#idpais-hidden").val());
    })
    .fail(function () {
      alert("ERROR: Something happened ");
    });

  // Evento change del pais
  $("#idpais").change(function () {
    carga_edos($(this).val());
    limpia_idmpio();
  });

  //Evento change del estado
  $("#idedo").change(function () {
    carga_mpios($("#idpais").val(), $(this).val());
    limpia_idmpio();
  });
  //Evento click restablecer
  $("button[type='reset']").click(function (e) {
    e.preventDefault();
    $("#nombre").val(nombre);
    $("#apellidos").val(apellidos);
    $("#correo").val(correo);
    $("#idpais").val($("#idpais-hidden").val());
    carga_edos($("#idpais-hidden").val());
    carga_mpios($("#idpais-hidden").val(), $("#idedo-hidden").val());
  });

  $("#form-persona").submit(function () {
    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove();

    if ($("#nombre").val() == "") {
      error_formulario("nombre", "Required name");
      return false;
    } else if ($("#apellidos").val() == "") {
      error_formulario("apellidos", "Required last name");
      return false;
    } else if ($("#correo").val() == "") {
      error_formulario("correo", "Required email");
      return false;
    } else if (!expcorreo.test($("#correo").val())) {
      error_formulario(
        "correo",
        "Wrong mail format:<strong>user@domain.com</strong>"
      );
      return false;
    }
    else if ($("#idpais").val() == 0) {
        error_formulario("idpais", "Required country");
        return false;
      } 
      else if ($("#idedo").val() == 0) {
        error_formulario("idedo", "Required state");
        return false;
      } 
      else if ($("#idmpio").val() == 0 && $( "#idpais").val() != 3 ) {
        error_formulario("idmpio", "Required city");
        return false;
      } 

    return true;
  });
}); //FIN DEL READY

//FUNCIONES EXTERNAS ( no se ejecutan al cargar la pagina)
function carga_edos(idpais) {
  $.ajax({
    url: "./cargaestados.php",
    dataType: "json",
    type: "post",
    data: {
      idpais: idpais,
    },
  })
    .done(function (json) {
      $("#idedo").html("");
      $("#idedo").append(
        $("<option>", {
          text: "-- Selecciona estado/provincia",
          value: 0,
        })
      );
      $.each(json, function (i, edo) {
        $("#idedo").append(
          $("<option>", {
            text: edo[1],
            value: edo[0],
          })
        );
      });
      if ($("#idpais").val() == $("#idpais-hidden").val()) {
        $("#idedo").val($("#idedo-hidden").val());
        carga_mpios($("#idpais").val(), $("#idedo").val());
      } else {
        carga_mpios($("#idpais-hidden").val(), $("#idedo-hidden").val());
      }
    })

    .fail(function () {
      alert("ERROR: Something happened b");
    });
}

function carga_mpios(idpais, idedo) {
  $.ajax({
    url: "./cargamunicipio.php",
    dataType: "json",
    type: "post",
    data: {
      idpais: idpais,
      idedo: idedo,
    },
  })
    .done(function (json) {
      limpia_idmpio();

      $.each(json, function (i, mpio) {
        $("#idmpio").append(
          $("<option>", {
            text: mpio[1],
            value: mpio[0],
          })
        );
      });
      if (
        $("#idpais").val() == $("#idpais-hidden").val() &&
        $("#idedo").val() == $("#idedo-hidden").val()
      ) {
        $("#idmpio").val($("#idmpio-hidden").val());
      }
    })

    .fail(function () {
      alert("ERROR: Something happened");
    });
}

function limpia_idmpio() {
  $("#idmpio").html("");
  $("#idmpio").append(
    $("<option>", {
      text: "-- Selecciona estado/provincia",
      value: 0,
    })
  );
}
