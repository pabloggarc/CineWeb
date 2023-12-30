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
});