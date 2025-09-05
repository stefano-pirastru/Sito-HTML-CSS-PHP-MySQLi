<?php
session_start();
include 'funzioni.php';
require 'connessione.php'; // Connessione al database

$is_logged_in = isset($_SESSION['username']);
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true; // Verifica se l'utente è un admin

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$sql = "SELECT username, cognome, email, data_nascita, telefono FROM utenti WHERE username = '$username'";
$risp = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($risp);

// Aggiornamento della password
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['new_password']) && !empty($_POST['conf_password'])) {
        $new_password = $_POST['new_password'];
        $conf_password = $_POST['conf_password'];

        if ($new_password === $conf_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $sql = "UPDATE utenti SET password = '$hashed_password' WHERE username = '$username'";
            if (mysqli_query($conn, $sql)) {
                $message = "Password aggiornata con successo!";
            } else {
                $message = "Errore durante l'aggiornamento.";
            }
        } else {
            $message = "Le password non corrispondono!";
        }
    } else {
        $message = "Compila tutti i campi!";
    }
}

?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Profilo Utente") ?>

<body>
<?php
mostraHeader();
mostraNav($is_logged_in,$is_admin);
?>

<div id="profilo-container">
    <h2>Profilo Utente</h2>

    <div class="profilo-section">
        <h3>Informazioni Personali</h3>
        <p><strong>Nome:</strong> <?php echo ($row['username']); ?></p>
        <p><strong>Cognome:</strong> <?php echo ($row['cognome']); ?></p>
        <p><strong>Data di Nascita:</strong> <?php echo ($row['data_nascita']); ?></p>
        <p><strong>Telefono:</strong> <?php echo ($row['telefono']); ?></p>
    </div>

    <div class="profilo-section">
        <h3>Credenziali</h3>
        <p><strong>Username:</strong> <?php echo ($row['username']); ?></p>
        <p><strong>Email:</strong> <?php echo ($row['email']); ?></p>

        <h3>Cambia Password</h3>
        <?php if (!empty($message)) echo "<p class='message'>$message</p>"; ?>
        <form method="POST" id="profilo-form">
            <label for="new_password">Nuova Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="conf_password">Conferma Password:</label>
            <input type="password" id="conf_password" name="conf_password" required>

            <button type="submit">Aggiorna Password</button>
        </form>
    </div>
</div>
<hr>
<?php
 mostraFooter();
 mysqli_close($conn);
 ?>

</body>
</html>
