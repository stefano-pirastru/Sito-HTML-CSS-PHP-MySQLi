<?php
function mostraHead($titolo = "Supernova Filmhouse") {
    echo '<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>' . $titolo . '</title>
    </head>';
}

function mostraHeader() {
    echo '<header>
        <h1>
            <img id="logo" src="immagini/logo.png" alt="logo" title="logo"> Supernova Filmhouse
        </h1>
    </header>';
}

function mostraNav($is_logged_in = false, $is_admin = false) { // equivale a dire: se non mi passi nulla allora considero entrambi falsi = parametri opzionali
    echo '<nav>
    <ul>
        <li><a href="index.php">Homepage</a></li>
        <li><a href="programmazione.php">Programmazione</a></li>
        <li><a href="orari.php">Orari</a></li>
        <li><a href="servizi.php">Servizi</a></li>';

    if ($is_logged_in) {
        echo '<li><a href="logout.php">Logout</a></li>
              <li><a href="profilo.php">Profilo</a></li>
              <li><a href="ricerca.php">Ricerca</a></li>';

        if ($is_admin) {
            echo '<li><a href="admin_dashboard.php">Dashboard Admin</a></li>';
        }
    } else {
        echo '<li><a href="login.php">Login</a></li>';
    }

    echo '</ul>
    </nav>';
}

function mostraFooter() {
    echo '<footer>
        <p>&copy; 2025 Supernova Film House - Tutti i diritti riservati</p>
        <p>Vieni a scoprire il cinema come non l\'hai mai visto!</p>
        <p><strong>Indirizzo:</strong> Via dei Mulini, 25, San Giovanni delle Alpi, Torino, Italia</p>
        <p><strong>Telefono:</strong> +39 0123 456789</p>
    </footer>';
}
?>
