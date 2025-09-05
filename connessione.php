<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "supernova";

// Connessione al database
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Controlla se ci sono errori di connessione
if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}
?>
