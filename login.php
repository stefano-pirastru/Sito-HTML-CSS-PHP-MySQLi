<?php
session_start(); // Avvia la sessione
include 'funzioni.php';
require 'connessione.php';

// Mostra il messaggio di errore se presente nella sessione
if (isset($_SESSION['error_message'])) {
    echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
    unset($_SESSION['error_message']); // Elimina il messaggio dopo che è stato mostrato
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query per recuperare l'utente
    $sql = "SELECT id, username, password, ruolo FROM utenti WHERE username = '$username'";
    $risp = mysqli_query($conn, $sql);

    if (mysqli_num_rows($risp) === 1) {
        $row = mysqli_fetch_assoc($risp);

        // Verifica la password
        if (password_verify($password, $row['password'])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["ruolo"] = $row["ruolo"]; // Salva il ruolo nella sessione

            // Controlla se è un amministratore
            if ($row["ruolo"] === "admin") {
                $_SESSION["admin_logged_in"] = true;
                header("Location: admin_dashboard.php"); // Reindirizza alla dashboard admin
            } else {
                header("Location: servizi.php"); // Reindirizza alla pagina servizi-------------------------------------------------------------------------
            }
            exit();
        } else {
            // Memorizza il messaggio di errore nella sessione
            $_SESSION['error_message'] = "Password errata.";
            header("Location: login.php"); // Reindirizza alla pagina di login
            exit();
        }
    } else {
        // Memorizza il messaggio di errore nella sessione
        $_SESSION['error_message'] = "Username non trovato.";
        header("Location: login.php"); // Reindirizza alla pagina di login
        exit();
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Login"); ?>

<body>

<?php
mostraHeader();
mostraNav();
?>

<form action="login.php" method="post" id="login-form">
    <h2>Login</h2>

    <?php
    // Mostra il messaggio di errore se presente nella sessione
    if (isset($_SESSION['error_message'])) {
        echo "<p style='color: red;'>" . $_SESSION['error_message'] . "</p>";
        unset($_SESSION['error_message']); // Elimina il messaggio dopo che è stato mostrato
    }
    ?>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Accedi</button>
    <p>Non sei ancora registrato? <a href="registrazione.php">Registrati</a></p>
</form>

<hr>
<?php mostraFooter(); ?>

</body>
</html>
