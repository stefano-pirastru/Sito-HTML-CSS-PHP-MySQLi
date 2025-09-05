<?php
session_start();
include 'funzioni.php';
require 'connessione.php';

$is_logged_in = isset($_SESSION['username']);
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Controllo accesso admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    $_SESSION['error_message'] = "Accesso non autorizzato, non sei un admin!";
    header("Location: login.php");
    exit();
}

// Eliminazione utente se il form è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $utente_id = intval($_POST["utente_id"]);

    if (!empty($utente_id)) {
        // Controlla che l'utente non sia un admin per sicurezza
        $sql = "SELECT ruolo FROM utenti WHERE id = $utente_id";
        $risp = mysqli_query($conn, $sql);

        if (mysqli_num_rows($risp) > 0) {
            $row = mysqli_fetch_assoc($risp);
            $ruolo = $row['ruolo'];

            if ($ruolo !== "admin") {
                $sql = "DELETE FROM utenti WHERE id = $utente_id";
                if (mysqli_query($conn, $sql)) {
                    $success_message = "Utente eliminato con successo!";
                } else {
                    $error_message = "Errore durante l'eliminazione dell'utente.";
                }
            } else {
                $error_message = "Non puoi eliminare un altro admin!";
            }
        } else {
            $error_message = "Utente non trovato.";
        }
    } else {
        $error_message = "Seleziona un utente valido.";
    }
}

// Recupera tutti gli utenti NON amministratori per la selezione
$sql = "SELECT id, username FROM utenti WHERE ruolo != 'admin'";
$risp = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Elimina Utente") ?>

<body>
<?php
mostraHeader();
mostraNav($is_logged_in,$is_admin);
 ?>

<h2>Elimina un utente</h2>

<?php if (isset($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
<?php if (isset($success_message)) echo "<p class='success-message'>$success_message</p>"; ?>

<form method="post">
    <label>Seleziona Utente:</label>
    <select name="utente_id" required>
        <option value="">-- Seleziona --</option>
        <?php while ($row = mysqli_fetch_assoc($risp)):
            echo '<option value="' . $row['id'] . '">' . $row['username'] . '</option>';
          endwhile; ?>
    </select>
    <button type="submit">Elimina Utente</button>
</form>

<hr>
<?php mostraFooter(); ?>

</body>
</html>
