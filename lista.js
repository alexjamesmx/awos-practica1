$(document).ready( function(){
    
    //Evento click de boton borrar de cada registro
    $( ".btn-borrar" ).click( function() {
       
        $( "#nombre-persona-borrar" ).html( $( this ).attr( "data-nombre-persona"));
        $( "#btn-borrar-confirmar" ).attr(
            "data-idpersona",
            $( this ).attr( "data-idpersona" )

        );
    });
    //Evento click del boton eliminar de la ventana modal
    $( "#btn-borrar-confirmar" ).click( function() {
       
        $( location ).attr( "href",
        "procesa.php?accion=baja&idpersona=" + 
        $( this ).attr( "data-idpersona" )  +
        "&c=" + appData.c +
        "&s=" + appData.s
        );
    });

});