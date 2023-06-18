const formularioRegistro = document.getElementById("formulario");
formularioRegistro.addEventListener("submit", function(event) {
    event.preventDefault();

    const nombre = document.getElementById("nombre").value;
    const primerApellido = document.getElementById("primerApellido").value;
    const segundoApellido = document.getElementById("segundoApellido").value;
    const email = document.getElementById("email").value;
    const login = document.getElementById("login").value;
    const password = document.getElementById("password").value;

    if (nombre.trim() === "" || primerApellido.trim() === "" || segundoApellido.trim() === "" || email.trim() === "" || login.trim() === "" || password.trim() === "") {
        formularioRegistro.reset();
        alert("Complete todos los campos del formulario.");
        return;    
    } else {
        formularioRegistro.submit();
    }

});
