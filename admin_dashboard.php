<?php
session_start();
include 'funzioni.php';

$is_logged_in = isset($_SESSION['username']);
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Controlla se l'utente è loggato come admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Mostra il messaggio di errore
    $_SESSION['error_message'] = "Accesso non autorizzato, non sei un admin!";
    // Reindirizza al login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Dashboard Admin"); ?>

<body>

<?php
mostraHeader();
mostraNav($is_logged_in,$is_admin);
?>

<h2 id="admin-bentornato">Benvenuto, Admin!</h2>
<p id="admin-descrizione">In questa sezione puoi gestire i servizi, gli utenti e altro.</p>

<!-- Sezione per aggiungere, modificare o eliminare i servizi -->
<h3 class="admin-sezione-titolo">Gestione Servizi</h3>
<a href="admin_aggiungi_servizio.php" class="admin-link">Aggiungi un nuovo servizio</a>
<br>
<a href="admin_elimina_servizio.php" class="admin-link">Elimina un servizio</a>
<br>
<a href="admin_modifica_servizio.php" class="admin-link">Modifica un servizio</a>

<hr id="admin-separatore">

<h3 class="admin-sezione-titolo">Gestione Utenti</h3>
<a href="admin_elimina_utente.php" class="admin-link">Elimina un utente</a>

<hr>
<?php mostraFooter(); ?>

</body>
</html>
