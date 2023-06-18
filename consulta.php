<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cursosql";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La conexión falló: ". $conn->connect_error);
}

$sql = "SELECT * FROM usuario";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Nombre</th><th>Primer Apellido</th><th>Segundo Apellido</th><th>Email</th><th>Usuario</th><th>Contraseña</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nombre"]. "</td>";
        echo "<td>" . $row["primerApellido"]. "</td>";
        echo "<td>" . $row["segundoApellido"]. "</td>";
        echo "<td>" . $row["email"]. "</td>";
        echo "<td>" . $row["login"]. "</td>";
        echo "<td><p>Private</p></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<a href='index.html'><p class='text-right m-0'>Volver</p></a>";

} else {
    echo "<script>alert('No hay registros por el momento');</script>";
    echo "<script>window.history.back();</script>";
}

$conn->close();
?>