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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $tipo = $_POST['tipo'];
    $genere = $_POST['genere'];
    $luogo = $_POST['luogo'];
    $data = $_POST['data'];
    $prezzo = $_POST['prezzo'];
    $descrizione = $_POST['descrizione'];
    // ricordati di quando hai scritto "l'opportunità di..." l'apostrofo causa un problema perché MySQL pensa che l'apice chiuda il valore troppo presto, generando un errore di sintassi SQL.
    // soluzione=> $descrizione = str_replace("'", "''", $_POST['descrizione']); Sostituisco gli apostrofi con 2 apici

    // Inserisci i dati nel database, senza specificare il campo immagine
    $sql = "INSERT INTO servizi (nome, tipo, genere, luogo, data, prezzo, descrizione)
            VALUES ('$nome', '$tipo', '$genere', '$luogo', '$data', '$prezzo', '$descrizione')";

    $risp = mysqli_query($conn, $sql);

    if ($risp) {
        echo "<p style='color: green;'>Servizio aggiunto con successo!</p>";
    } else {
        echo "<p style='color: red;'>Errore nell'aggiunta del servizio: " . mysqli_error($conn) . "</p>";
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Aggiungi Servizio") ?>

<body>

<?php
mostraHeader();
mostraNav($is_logged_in, $is_admin);
?>

<h2>Aggiungi un nuovo servizio</h2>
<form action="admin_aggiungi_servizio.php" method="post">
    Nome: <input type="text" name="nome" required><br>
    Tipo: <input type="text" name="tipo"><br>
    Genere: <input type="text" name="genere"><br>
    Luogo: <input type="text" name="luogo"><br>
    Data: <input type="date" name="data"><br>
    Prezzo: <input type="number" step="0.01" name="prezzo" required><span>€</span><br>
    Descrizione: <textarea name="descrizione"></textarea><br>
    <button type="submit">Aggiungi</button>
</form>

<hr>
<?php mostraFooter(); ?>

</body>
</html>
