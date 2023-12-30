function mostrarContenedor(idContenedorNuevo, idContenedorViejo) {
    var contenedorMostrar = document.getElementById(idContenedorNuevo);
    var contenedorOcultar = document.getElementById(idContenedorViejo);

    contenedorOcultar.classList.add("hide");
    contenedorMostrar.classList.remove("hide");
}