<?php
session_start(); // Avvia la sessione per verificare lo stato di login
include 'funzioni.php';
$is_logged_in = isset($_SESSION['username']); // Verifica se l'utente è loggato

// Verifica se l'utente è un admin
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true; // Verifica se l'utente è un admin
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Orari"); ?>

<body>
<?php
mostraHeader();
mostraNav($is_logged_in,$is_admin);
?>

<div id="orari">
    <h2>Orari di Apertura</h2>
    <table>
        <thead>
            <tr>
                <th>Giorno</th>
                <th>Orario</th>
            </tr>
        </thead>
        <tbody>
            <tr class="aperto">
                <td>Lunedì</td>
                <td>9:00 - 23:00</td>
            </tr>
            <tr class="aperto">
                <td>Martedì</td>
                <td>9:00 - 23:00</td>
            </tr>
            <tr class="aperto">
                <td>Mercoledì</td>
                <td>9:00 - 23:00</td>
            </tr>
            <tr class="aperto">
                <td>Giovedì</td>
                <td>9:00 - 23:00</td>
            </tr>
            <tr class="aperto">
                <td>Venerdì</td>
                <td>9:00 - 23:00</td>
            </tr>
            <tr class="aperto">
                <td>Sabato</td>
                <td>9:00 - 23:00</td>
            </tr>
            <tr class="chiuso">
                <td>Domenica</td>
                <td>Chiuso</td>
            </tr>
        </tbody>
    </table>
</div>

<hr>
<?php mostraFooter(); ?>

</body>
</html>
