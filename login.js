var expcorreo = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

$(document).ready(function () {
  setTimeout(function () {
    $(".alert").fadeOut("slow");
  }, 8000);

  $("#form-login").submit(function (e) {
    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove();

    if ($("#correo").val() == "") {
      error_formulario("correo", "Empty email");
      return false;
    } else if (!expcorreo.test($("#correo").val())) {
      error_formulario(
        "correo",
        "Wrong mail format:<strong>user@domain.com</strong>"
      );
      return false;
    } else if ($("#contrasenia").val() == "") {
      error_formulario("contrasenia", "Empty password");
      return false;
    }
    return true;
  });
  $("#form-modal-registro").submit(function () {
    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove();

    if ($("#modal-nombre").val() == "") {
      error_formulario("modal-nombre", "Required name");
      return false;
    } else if ($("#modal-apellidos").val() == "") {
      error_formulario("modal-apellidos", "Required last name");
      return false;
    } else if ($("#modal-correo").val() == "") {
      error_formulario("modal-correo", "Required email");
      return false;
    } else if (!expcorreo.test($("#modal-correo").val())) {
      error_formulario(
        "modal-correo",
        "Wrong mail format:<strong>user@domain.com</strong>"
      );
      return false;
    } else if ($("#modal-contrasenia").val() == "") {
      error_formulario("modal-contrasenia", "Required password");
      return false;
    } else if ($("#modal-contrasenia-2").val() == "") {
      error_formulario("modal-contrasenia-2", "Required password");
      return false;
    } else if (
      $("#modal-contrasenia").val() != $("#modal-contrasenia-2").val()
    ) {
      error_formulario("modal-contrasenia-2", "Both passwords dont match");
      return false;
    }
    return true;
  });

  $("a[data-bs-toggle='modal']").click(function () {
    $(".is-invalid").removeClass("is-invalid");
    $(".invalid-feedback").remove();

    $(
      "#modal-nombre,#modal-apellidos ,#modal-correo,#modal-contrasenia,#modal-contrasenia-2"
    ).val("");
    $("#group-modal-contrasenia-2").hide();
  });
  $("#modal-contrasenia").keyup(function () {
    if ($(this).val() != "") {
      $("#group-modal-contrasenia-2").show();
    }
  });

  $("#modal-contrasenia-2").keyup(function () {
    $("#modal-contrasenia-2").removeClass("is-invalid");
    $("#group-modal-contrasenia-2 .invalid-feedback").remove();

    if ($("#modal-contrasenia").val() != "" &&
       $("#modal-contrasenia").val() != $("#modal-contrasenia-2").val()) {
      error_formulario("modal-contrasenia-2", "Both passwords dont match");
    } else {
      $("#modal-contrasenia-2").removeClass("is-invalid");
      $("#group-modal-contrasenia-2 .invalid-feedback").remove();
    }
  });
});
