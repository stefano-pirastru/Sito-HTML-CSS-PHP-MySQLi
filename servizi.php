<?php
session_start();
include 'funzioni.php';
require 'connessione.php';

$is_logged_in = isset($_SESSION['username']);
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Servizi"); ?>

<body>
<?php
mostraHeader();
mostraNav($is_logged_in, $is_admin);
?>

<div id="servizi">
    <h2>Servizi Offerti</h2>

    <?php if ($is_logged_in): ?>
        <h4>Benvenuto! Di seguito i servizi disponibili per te:</h4>

        <?php
        $sql = "SELECT * FROM servizi";
        $risp = mysqli_query($conn, $sql);

        if (mysqli_num_rows($risp) > 0) {
            while ($row = mysqli_fetch_assoc($risp)) {
                // Se il campo immagine è vuoto, usa un'immagine di default
                if (!empty($row['immagine'])) {
                    $img = $row['immagine'];
                } else {
                    $img = 'default.jpg'; // immagine generica nella cartella immagini/
                }

                echo '<div class="servizio">';
                echo '<img src="immagini/' . $img . '" alt="' . ($row['nome']) . '">';
                echo '<div class="descrizione-servizio">';
                echo '<h3>' . ($row['nome']) . '</h3>';
                echo '<p>' . ($row['descrizione']) . '</p>';
                echo '<p><strong>Prezzo:</strong> €' . number_format($row['prezzo'], 2, ',', '.') . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>Nessun servizio disponibile.</p>";
        }

        mysqli_close($conn);
        ?>

    <?php else: ?>
        <p id="avviso-servizi">
            I servizi sono accessibili esclusivamente agli utenti registrati. I dettagli aggiuntivi, come i servizi extra, i prezzi e le descrizioni complete, saranno disponibili solo dopo il
            <a href="login.php">login</a>.
        </p>

        <div class="servizio">
            <img src="immagini/biglietto-premium.jpg" alt="Biglietto Premium">
            <div class="descrizione-servizio">
                <h3>Biglietto Premium</h3>
                <p>Maggiori informazioni solo per gli <a href="login.php">utenti loggati</a>.</p>
            </div>
        </div>

        <div class="servizio">
            <img src="immagini/supernovapass.jpg" alt="SupernovaPass">
            <div class="descrizione-servizio">
                <h3>SupernovaPass</h3>
                <p>Maggiori informazioni solo per gli <a href="login.php">utenti loggati</a>.</p>
            </div>
        </div>

        <div class="servizio">
            <img src="immagini/esperienza-vip.jpg" alt="Esperienza VIP">
            <div class="descrizione-servizio">
                <h3>Esperienza VIP</h3>
                <p>Maggiori informazioni solo per gli <a href="login.php">utenti loggati</a>.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<hr>
<?php mostraFooter(); ?>

</body>
</html>
