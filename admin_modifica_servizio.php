<?php
session_start();
include 'funzioni.php';
require 'connessione.php';

$is_logged_in = isset($_SESSION['username']);
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

if (!$is_admin) {
    $_SESSION['error_message'] = "Accesso non autorizzato, non sei un admin!";
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $genere = $_POST['genere'];
    $luogo = $_POST['luogo'];
    $data = $_POST['data'];
    $prezzo = $_POST['prezzo'];
    $descrizione = $_POST['descrizione'];


    $sql = "UPDATE servizi
            SET nome='$nome', tipo='$tipo', genere='$genere', luogo='$luogo', data='$data', prezzo='$prezzo', descrizione='$descrizione'
            WHERE id='$id'";

    $risp = mysqli_query($conn, $sql);

    if ($risp) {
        echo "<p style='color: green;'>Servizio aggiornato con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore nell'aggiornamento del servizio: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Modifica Servizio"); ?>

<body>
<?php
mostraHeader();
mostraNav($is_logged_in, $is_admin);
?>

<h2>Modifica un servizio</h2>
<form action="admin_modifica_servizio.php" method="post">
    ID Servizio: <input type="number" name="id" required><br>
    Nome: <input type="text" name="nome" required><br>
    Tipo: <input type="text" name="tipo"><br>
    Genere: <input type="text" name="genere"><br>
    Luogo: <input type="text" name="luogo"><br>
    Data: <input type="date" name="data"><br>
    Prezzo: <input type="number" step="0.01" name="prezzo" required><span>€</span><br>
    Descrizione: <textarea name="descrizione"></textarea><br>
    <button type="submit">Modifica</button>
</form>

<hr>
<?php mostraFooter(); ?>

</body>
</html>
