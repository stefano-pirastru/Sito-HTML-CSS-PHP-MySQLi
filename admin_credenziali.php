<?php
// La password che vuoi assegnare all'admin (ad esempio, "admin123")
$password_admin = "admin123"; // Cambia questa password con quella che desideri

// Hash della password
$hashed_password = password_hash($password_admin, PASSWORD_DEFAULT);

// Connessione al database
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "supernova";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}

// SQL per inserire l'admin con la password hashata
$sql = "INSERT INTO utenti (username, password, ruolo) VALUES ('admin', '$hashed_password', 'admin')";

// Esegui la query
$risp = mysqli_query($conn, $sql);

if ($risp) {
    echo "Admin creato con successo!";
} else {
    echo "Errore nella creazione dell'admin: " . mysqli_error($conn);
}

// Chiudi la connessione
mysqli_close($conn);
?>
