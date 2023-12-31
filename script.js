var butacas_seleccionadas = [];

$(document).ready(function () {
    $("#tabla_butacas .butaca_libre").click(function () {
        if (!butacas_seleccionadas.includes($(this).attr("id"))) {
            if (confirm("¿Desea reservar esta butaca?")) {
                $(this).css("background-color", "#ffA500");
                butacas_seleccionadas.push($(this).attr("id"));
            }
        }
        else{
            if (confirm("¿Desea no reservar esta butaca?")) {
                $(this).css("background-color", "#00ff00");
                if(butacas_seleccionadas.indexOf($(this).attr("id")) > -1){
                    butacas_seleccionadas.splice(butacas_seleccionadas.indexOf($(this).attr("id")), 1);
                }
            }
        }
    });
    $("#tabla_butacas .butaca_ocupada").click(function () {
        alert("Esta butaca ya está ocupada");
    });
    $("#boton_conf_entradas").click(function () {
        if(butacas_seleccionadas.length > 0){
            if (confirm("¿Desea confirmar la reserva de las butacas seleccionadas?")) {
                // Esto no funciona bien, hay que averiguar cómo hacerlo
                $.ajax({
                    type: 'POST',
                    url: 'controlador/controlador_butacas_selec.php',
                    data: { butacas_seleccionadas: butacas_seleccionadas },
                    success: function(response) {
                        console.log(response);
                        window.location.href = 'vista/test.php';
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        }
        else{
            alert("¡No se ha seleccionado ninguna butaca!");
        }
    });
});