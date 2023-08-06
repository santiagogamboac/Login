<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "test";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$conn) {
	die("No hay conexión: " . mysqli_connect_error());
}

$usuario = $_POST["txtusuario"];
$password = $_POST["txtpassword"];

// Utilizando declaraciones preparadas para evitar la inyección SQL.
$stmt = $conn->prepare("SELECT * FROM login WHERE usuario = ? AND password = ?");
$stmt->bind_param("ss", $usuario, $password);
$stmt->execute();

$result = $stmt->get_result();
$nr = $result->num_rows;

if ($nr == 1) {
	// Si el usuario y contraseña coinciden, redirigir a home.html
	// header("Location: home.html");
	echo "Bienvenido " .$usuario;
} else {
	// Si no coinciden, mostrar mensaje de error y redirigir a index.html
	echo "<script> alert('Error: Usuario o contraseña incorrectos.'); window.location = 'login.html'; </script>";
}

?>