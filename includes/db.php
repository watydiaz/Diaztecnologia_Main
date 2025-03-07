<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "diaztecnologia";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar conexión
if (!$conn) {
    die("<p>Conexión fallida: " . mysqli_connect_error() . "</p>");
} else {
}
?>
