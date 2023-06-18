<?php

if($_POST){
    // Obtener datos del formulario y guardarlo en variables
    $nombre = $_POST['nombre'];
    $primerApellido = $_POST['primerApellido'];
    $segundoApellido = $_POST['segundoApellido'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $pass = $_POST['password'];

    // Datos de conexión a Mysql
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "cursosql";

    $conn = new mysqli ($servername, $username, $password, $dbname);

    // En caso de que falle la conexión
    if ($conn->connect_error) {
        die("La conexión falló: " . $conn->connect_error);
    }

    // Recuperamos los datos del email y login (usuario)
    $checkEmailQuery = "SELECT * FROM usuario WHERE email='$email'";
    $checkLoginQuery = "SELECT * FROM usuario WHERE login='$login'";


    $checkEmail = $conn->query($checkEmailQuery);
    if ($checkEmail->num_rows > 0) {
        $emailExists = TRUE;
    }
    $checkLogin = $conn->query($checkLoginQuery);
    if ($checkLogin->num_rows > 0) {
        $loginExists = TRUE;
    }

    // Validaciones
    if ($emailExists) {
        echo "<script>alert('El email ya está registrado. Ingrese otra dirección.');</script>";
        echo "<script>window.history.back();</script>";
    } elseif ($loginExists) {
        echo "<script>alert('El usuario ya está registrado. Ingrese otro nombre de usuario.');</script>";
        echo "<script>window.history.back();</script>";
    } elseif (empty($nombre) || empty($primerApellido) || empty($segundoApellido) || empty($email) || empty($login) || empty($pass)) {
        echo "<script>alert('Complete todos los campos del formulario.');</script>";
        echo "<script>window.history.back();</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('El formato de email no es válido. Vuelva a ingresar su dirección.');</script>";
        echo "<script>window.history.back();</script>";
    } elseif (strlen($pass) < 4 || strlen($pass) > 8) {
        echo "<p>La contraseña debe tener entre 4 y 8 caracteres</p><a href='index.html'><p>Volver</p></a>";
        echo "<script>alert('La contraseña debe tener entre 4 y 8 caracteres. Vuelva a ingresar su contraseña.');</script>";
        echo "<script>window.history.back();</script>";
    } else {
        $sql = "INSERT INTO usuario (nombre, primerApellido, segundoApellido, email, login, password) 
        VALUES ('$nombre', '$primerApellido', '$segundoApellido', '$email', '$login', '$pass')";
        if ($conn->query($sql) == TRUE) {
            echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Formulario PHP</title>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM' crossorigin='anonymous'>
            </head>
            <body>
                <div class='mx-auto mt-5 shadow p-3 mb-5 rounded border' style='width: 400px;'>
                    <h2><em>Formulario de Registro</em></h2>
                    <p class='fs-5 text-success text-center'>Registro completado con éxito</p>
                    <!-- Consulta -->
                    <div class='row'>
                        <a href='consulta.php' class='col'><p class='text-center m-0'>Consulta</p></a>
                        <a href='index.html' class='col'><p class='text-center m-0'>Volver</p></a>
                    </div>
                </div>
            </body>
            </html>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }

    $conn->close();
}

?>

