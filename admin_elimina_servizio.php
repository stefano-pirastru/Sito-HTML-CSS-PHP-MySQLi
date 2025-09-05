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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servizio_id = intval($_POST["servizio_id"]); // converte un valore in intero

    if (!empty($servizio_id)) {
        $sql = "DELETE FROM servizi WHERE id = $servizio_id";
        $risp = mysqli_query($conn, $sql);

        if ($risp) {
            $success_message = "Servizio eliminato con successo!";
        } else {
            $error_message = "Errore durante l'eliminazione del servizio.";
        }
    } else {
        $error_message = "Seleziona un servizio valido.";
    }
}

// Recupera tutti i servizi per la selezione
$sql = "SELECT id, nome FROM servizi";
$risp = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Elimina Servizio"); ?>

<body>

<?php
mostraHeader();
mostraNav($is_logged_in,$is_admin);
 ?>

    <h2>Elimina un servizio</h2>

    <?php if (isset($error_message)) echo "<p class='error-message'>$error_message</p>"; ?>
    <?php if (isset($success_message)) echo "<p class='success-message'>$success_message</p>"; ?>

    <form method="post">
        <label>Seleziona Servizio:</label>
        <select name="servizio_id" required>
            <option value="">-- Seleziona --</option>
            <?php while ($row = mysqli_fetch_assoc($risp)):
                   echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
                 endwhile; ?>
        </select>
        <button type="submit">Elimina</button>
    </form>

    <hr>
    <?php mostraFooter(); ?>

</body>
</html>
