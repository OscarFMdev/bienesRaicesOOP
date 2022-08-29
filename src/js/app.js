document.addEventListener("DOMContentLoaded", function () { //Escuchar que se haya cargado el documento
    eventListeners();

    darkMode();
});


function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)')

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    if( prefiereDarkMode.matches ){
        document.body.classList.add('dark-mode')
    } else {
        document.body.classList.remove('dark-mode')
    }

    prefiereDarkMode.addEventListener('change', function() {
        if( prefiereDarkMode.matches ){
            document.body.classList.add('dark-mode')
        } else {
            document.body.classList.remove('dark-mode')
        }
    });

    botonDarkMode.addEventListener("click", function() {
        document.body.classList.toggle("dark-mode");
    })
}

function eventListeners () {
    const mobileMenu = document.querySelector(".mobile-menu");

    //Cuando creamos la función aparte solo tenemos que poner el nombre
    mobileMenu.addEventListener("click", navegacionResponsive);
}

function navegacionResponsive() {
    //Podemos poner un console log o alert para que aparezca al hacer click
    const navegacion = document.querySelector(".navegacion");

    //Para agregar y quitar clases al hacer click
    // if(navegacion.classList.contains(".mostrar")) {
    //     navegacion.classList.remove(".mostrar");
    // } else {
    //     navegacion.classList.add(".mostrar");
    // }

    //También podemos poner un toggle para quitar y poner
    navegacion.classList.toggle('mostrar');
    //Sirve para lo mismo pero nos ahorramos un if
}   