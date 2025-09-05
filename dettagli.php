<?php
session_start();
include 'funzioni.php';
require 'connessione.php';
$is_logged_in = isset($_SESSION['username']);
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true; // Verifica se l'utente è un admin

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fase 1: Verifico se sono stati selezionati dei servizi
if (isset($_POST['selezionati']) && is_array($_POST['selezionati']) && !empty($_POST['selezionati'])) {
    $selezionati = $_POST['selezionati'];
    $servizi = [];  // Array che conterrà i risultati

    // Esegui una query per ogni ID selezionato
    foreach ($selezionati as $id) {
        // Query per ogni servizio selezionato
        $sql = "SELECT * FROM servizi WHERE id = $id";
        $risp = mysqli_query($conn, $sql);

        // Aggiungi il risultato all'array dei servizi se ci sono risultati
        if (mysqli_num_rows($risp) > 0) {
            while ($row = mysqli_fetch_assoc($risp)) {
                $servizi[] = $row;
            }
        }
    }
} else {
    $servizi = [];
}

?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Dettagli Servizi"); ?>
  <body>
<?php
mostraHeader();
mostraNav($is_logged_in,$is_admin);
 ?>

    <div id="dettagli">
        <h2>Dettagli Servizi Selezionati</h2>

        <?php
        if (count($servizi) > 0) {
            foreach ($servizi as $servizio) {
                echo '<div class="dettagli-servizi">';
                echo '<ul>';
                echo '<li><strong>Nome:</strong> ' . $servizio['nome'] . '</li>';
                echo '<li><strong>Tipo:</strong> ' . $servizio['tipo'] . '</li>';
                echo '<li><strong>Genere:</strong> ' . $servizio['genere'] . '</li>';
                echo '<li><strong>Luogo:</strong> ' . $servizio['luogo'] . '</li>';
                echo '<li><strong>Data:</strong> ' . $servizio['data'] . '</li>';
                echo '<li><strong>Prezzo:</strong> € ' . $servizio['prezzo'] . '</li>';
                echo '<li><strong>Descrizione:</strong> ' . $servizio['descrizione'] . '</li>';
                echo '<li><strong>Immagine:</strong><br><img src="immagini/' . $servizio['immagine'] . '" style="width: 200px; height: 200px; object-fit: cover;"></li>';
                echo '</ul>';
                echo '</div>';
            }
        } else {
            echo '<p>Nessun servizio selezionato o disponibile.</p>';
        }
        ?>


    </div>

    <hr>

    <?php
    mostraFooter();
    mysqli_close($conn);
    ?>

  </body>
</html>
