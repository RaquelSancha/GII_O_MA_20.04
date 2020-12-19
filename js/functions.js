jQuery("#actualizar").click(function(){        
    //cogemos el valor del input
    var descr = jQuery("#desc").val();
    var idPuerta = jQuery('#idPuerta').val();
    //creamos array de parámetros que mandaremos por POST
    var params = {
        "descripcionNueva" : descr,
        "id" : idPuerta
    };

    //llamada al fichero PHP con AJAX
    $.ajax({
        data:  params,
        url:   'ajax/actualizaComentario.php',
        dataType: 'html',
        type:  'post',
        success:  function (response) {
            //mostramos salida del PHP
            jQuery("#resultado").html(response);

        }
    });
});