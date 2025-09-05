<?php
session_start(); // Avvia la sessione per verificare se l'utente è loggato
include 'funzioni.php';
// Controlla se l'utente è loggato e se è admin
$is_logged_in = isset($_SESSION['username']); // Verifica se l'utente è loggato
$is_admin = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true; // Verifica se l'utente è un admin
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Homepage"); ?>

<body>
<?php
mostraHeader();
mostraNav($is_logged_in, $is_admin);
?>

<div id="gigantografia">
    <img src="immagini/Location.jpg" alt="Sala di un cinema" title="Location">
    <div class="descrizione">
        <p>
        Nel 2015, un piccolo sogno si è concretizzato nel cuore della provincia di Torino. Nella pittoresca zona di <strong>San Giovanni delle Alpi</strong>, più precisamente in <strong>Via dei Mulini, 25</strong>, è nato il <strong>Supernova Filmhouse</strong>, un cinema che ha subito catturato l'immaginario degli appassionati del grande schermo. Questa zona, conosciuta per le sue tranquille colline e l'atmosfera quasi surreale, è sempre stata un rifugio per chi cercava un angolo di pace lontano dal caos cittadino, ma mai avrebbe pensato di diventare la culla di una delle realtà cinematografiche più interessanti della regione.
        </p>

        <p>
        Il Supernova Film House è un cinema che non ha paura di osare. Con le sue tre sale dedicate al cinema d'autore e ai blockbuster, è riuscito a offrire qualcosa di speciale a ogni tipo di spettatore. La sala principale, la <strong>Stellar Vision</strong>, ospita le proiezioni più affollate, con una capienza di 250 posti e un <strong>impianto audio Dolby Atmos</strong> che rende ogni esperienza cinematografica unica. La seconda sala, la <strong>Galactic Screen</strong>, più intima, con soli 50 posti, è dedicata a film indipendenti e rassegne particolari, ed è famosa per la sua particolare architettura che crea un'atmosfera "immersiva" durante ogni film.
        </p>

        <p>
        In questo cinema si può respirare la storia del cinema in ogni angolo. Nella terza sala, la <strong>Retro Theater</strong>, l'esperienza cinematografica è un viaggio nel passato, dove vengono proiettati film classici che hanno fatto la storia del cinema mondiale. Con i suoi vecchi poltroni in velluto e il suo <strong>telo di proiezione vintage</strong>, è il posto ideale per chi vuole vivere un'esperienza autentica, come se si fosse tornati indietro nel tempo.
        </p>

        <p>
        Ma il Supernova non è solo film: è anche un punto di riferimento per tutti gli amanti della cultura cinematografica. La sua <strong>cinematografica libreria</strong> al piano superiore offre una vasta selezione di libri, riviste e memorabilia del mondo del cinema. Inoltre, grazie ai suoi spazi dedicati agli eventi, il cinema ospita regolarmente incontri con registi, attori e critici cinematografici. La zona circostante, pur essendo tranquilla, è ben servita da <strong>caffè e ristoranti tematici</strong> che rievocano scene iconiche di film leggendari, per un'esperienza a 360°.
        </p>

        <p>
        Il cinema non si ferma mai, e con il suo continuo impegno verso l'innovazione, il Supernova ha progettato nuovi servizi per il pubblico, che saranno esplicitati nella <strong>pagina successiva</strong>, dedicata alla programmazione. A breve verranno introdotte anche nuove <strong>firme di qualità</strong> e collaborazioni con altre realtà cinematografiche internazionali, per arricchire ulteriormente l’offerta culturale e renderla ancora più completa.
        </p>
    </div>
</div>

<hr>
<?php mostraFooter(); ?>

</body>
</html>
