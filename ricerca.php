<?php
session_start();
include 'funzioni.php';
require 'connessione.php';
$is_logged_in = isset($_SESSION['username']);
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Recupera i valori distinti per tipo e genere
$sql_tipo = "SELECT DISTINCT tipo FROM servizi";
$sql_genere = "SELECT DISTINCT genere FROM servizi";
$tipi = mysqli_query($conn, $sql_tipo);
$generi = mysqli_query($conn, $sql_genere);
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Ricerca") ?>

<body>
<?php
mostraHeader();
mostraNav($is_logged_in,$is_admin)
 ?>

<div id="ricerca">
    <h2>Cerca Servizi</h2>

    <?php
    // --- FASE 2: Esecuzione della ricerca e visualizzazione dei risultati -----------------------------------------------------------------------------------------------------------
    if (!empty($_POST['tipo']) || !empty($_POST['genere'])) {
      $tipo = $_POST['tipo'];
      $genere = $_POST['genere'];

      // CASO 1: entrambi selezionati
      if ($tipo != "" && $genere != "") {
          $sql = "SELECT * FROM servizi WHERE tipo = '$tipo' AND genere = '$genere'";
      }
      // CASO 2: solo tipo
      elseif ($tipo != "") {
          $sql = "SELECT * FROM servizi WHERE tipo = '$tipo'";
      }
      // CASO 3: solo genere
      elseif ($genere != "") {
          $sql = "SELECT * FROM servizi WHERE genere = '$genere'";
      }

        // Eseguiamo la query
        $risp = mysqli_query($conn, $sql);

        // Mostriamo i risultati
        if (mysqli_num_rows($risp) > 0) {
            echo "<h3>Risultati della ricerca:</h3>";
            echo "<form method='POST' action='dettagli.php'>";
            echo "<ul>";
            while ($row = mysqli_fetch_assoc($risp)) {
                echo "<li><input type='checkbox' name='selezionati[]' value='" . $row['id'] . "'> " . ($row['nome']) . "</li>"; // SELEZIONATI !!! ----------------------------------------
            }
            echo "</ul>";
            echo "<button type='submit'>Vedi Dettagli Selezionati</button>";
            echo "</form>";
        } else {
            echo "<p>Nessun servizio trovato con i criteri di ricerca.</p>";
        }
    } else {
        // --- FASE 1: Visualizzazione del modulo di ricerca x la prima volta (scelta tipo e genere) -------------------------------------------------------------------------------------------------------------
        ?>
        <form method="POST" action="ricerca.php">
            <label for="tipo">Tipo di Servizio:</label>
            <select name="tipo" id="tipo">
                <option value="">Seleziona Tipo</option>
                <?php
                while ($row = mysqli_fetch_assoc($tipi)) {
                    echo "<option value='" . $row['tipo'] . "'>" . $row['tipo'] . "</option>"; // valore che verrà inviato al server; valore che l'utente vedrà nel menù a tendina
                }
                ?>
            </select><br>

            <label for="genere">Genere:</label>
            <select name="genere" id="genere">
                <option value="">Seleziona Genere</option>
                <?php
                while ($row = mysqli_fetch_assoc($generi)) {
                    echo "<option value='" . $row['genere'] . "'>" . $row['genere'] . "</option>";
                }
                ?>
            </select><br>

            <button type="submit">Cerca</button>
        </form>
        <?php
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
