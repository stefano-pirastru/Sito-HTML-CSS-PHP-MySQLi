<?php
session_start(); // Avvia la sessione per verificare lo stato di login (solo per coerenza)
include 'funzioni.php';
$is_logged_in = isset($_SESSION['username']); // Verifica se l'utente è loggato

// Verifica se l'utente è un admin
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true; // Verifica se l'utente è un admin

// Se l'utente non è loggato, reindirizza alla pagina di login
if (!$is_logged_in) {
    header("Location: login.php");
    exit(); // ferma l'esecuzione del codice successivo
}
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Programmazione"); ?>

<body>
<?php
mostraHeader();
mostraNav($is_logged_in,$is_admin);
?>

<section id="programmazione">
    <div class="film">
        <img src="immagini/Joker.jpg" alt="Joker film" title="Joker">
        <div class="descrizione-film">
            <h2>Joker</h2>
            <p>Un dramma psicologico che esplora le origini del celebre villain della DC Comics, un uomo in difficoltà che si trasforma in una figura simbolica di ribellione e caos.</p>
            <p><strong>Orario:</strong> 9:00 - 23:00</p>
        </div>
    </div>

    <div class="film">
        <img src="immagini/Avatar.jpg" alt="Avatar Film" title="Avatar">
        <div class="descrizione-film">
            <h2>Avatar</h2>
            <p>Un epico viaggio in un mondo alieno, Pandora, dove un ex marine si unisce a un popolo indigeno per difendere la loro terra dalle forze umane che vogliono distruggerla.</p>
            <p><strong>Orario:</strong> 9:00 - 23:00</p>
        </div>
    </div>

    <div class="film">
        <img src="immagini/InsideOut.jpg" alt="InsideOut film" title="InsideOut">
        <div class="descrizione-film">
            <h2>Inside Out 2</h2>
            <p>Il sequel di Inside Out, che esplora le emozioni di una ragazza più grande mentre affronta nuove sfide della vita, con nuove emozioni da scoprire e gestire.</p>
            <p><strong>Orario:</strong> 9:00 - 23:00</p>
        </div>
    </div>

    <div class="film">
        <img src="immagini/Oppenheimer.jpg" alt="Oppenheimer film" title="Oppenheimer">
        <div class="descrizione-film">
            <h2>Oppenheimer</h2>
            <p>Il biografico su J. Robert Oppenheimer, il "padre della bomba atomica", che racconta il suo ruolo cruciale nello sviluppo della prima arma nucleare e le sue implicazioni morali.</p>
            <p><strong>Orario:</strong> 9:00 - 23:00</p>
        </div>
    </div>
</section>

<hr>
<?php mostraFooter(); ?>

</body>
</html>
