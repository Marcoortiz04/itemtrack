<?php
$host = "sql207.infinityfree.com";
$user = "if0_41930525";
$pass = "04050628MOa"; 
$db   = "if0_41930525_itemtrack";

$conn = mysqli_connect($host, $user, $pass, $db);

// ESTA ES LA LÍNEA MÁGICA PARA LAS TILDES:
mysqli_set_charset($conn, "utf8");

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>