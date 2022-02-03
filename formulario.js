


$( document ).ready( function() {
    $.ajax({
        "url"       :   "./cargapaises.php",
        "dataType"  :   "json"
    })
    .done( function( json ) {
            $( "#idpais" ).html( "" );
            $( "#idpais" ).append( $( "<option>",{
                "text"  : "-- Seleccione pais",
                "value" : 0
            }));

            $.each( json, function( i, pais ){
                $( "#idpais" ).append($( "<option>",{
                    "text"  : pais[1],
                    "value" : pais[0]
                }));
            });

            $( "#idpais" ).val( $( "#idpais-hidden" ).val() );

    })
    .fail(function(){
        alert( "ERROR: Something happened"); 
    });  

    carga_edos( $("#idpais-hidden" ).val());
    carga_mpios( $( "#idpais-hidden" ).val(), $( "#idedo-hidden" ).val());

    // Evento change del pais
    $( "#idpais" ).change( function() {
    carga_edos( $( this ).val() ); 
    })
});

//FUNCIONES EXTERNAS ( no se ejecutan al cargar la pagina)
function carga_edos( idpais ){
    $.ajax({
        "url" : "./cargaestados.php",
        "dataType" :"json",
        "type" : "post" ,
        "data" : {
            "idpais" : idpais 
        }
    })
    .done( function( json ){
        $( "#idedo" ).html( "" );
        $( "#idedo" ).append( $("<option>", {
            "text" : "-- Selecciona estado/provincia",
            "value": 0
        }));
        $.each( json, function( i,edo ){
            $( "#idedo" ).append( $("<option>", {
             "text" : edo[ 1 ],
             "value" : edo[ 0 ] 
            }));
        });

       $( "#idedo" ).val( $( "#idedo-hidden" ).val()); 
    })

    .fail( function() { 
        alert( "ERROR: Something happened" );
    })
}

function carga_mpios( idpais, idedo){
    $.ajax({
        "url" : "./cargamunicipio.php",
        "dataType" :"json",
        "type" : "post" ,
        "data" : {
            "idpais" : idpais,
            "idedo" : idedo
        }
    })
       .done( function( json ){
        $( "#idmpio" ).html( "" );
        $( "#idmpio" ).append( $("<option>", {
            "text" : "-- Selecciona estado/provincia",
            "value": 0
        }));
        $.each( json, function( i,mpio ){
            $( "#idmpio" ).append( $("<option>", {
             "text" : mpio[ 1 ],
             "value" : mpio[ 0 ] 
            }));
        });

       $( "#idmpio" ).val( $( "#idmpio-hidden" ).val()); 
    })

    .fail( function() { 
        alert( "ERROR: Something happened" );
    })
}

 