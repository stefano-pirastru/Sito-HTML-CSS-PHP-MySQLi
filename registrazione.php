<?php
session_start();
include 'funzioni.php';
require 'connessione.php';
// form di registrazione
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Raccogle i dati dal form
    $cognome = $_POST['cognome'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];
    $data_nascita = $_POST['data_nascita'];
    $telefono = $_POST['telefono'];

    // 1. Verifica che tutti i campi siano riempiti
    if (empty($cognome) || empty($username) || empty($email) || empty($password) || empty($conf_password) || empty($data_nascita) || empty($telefono)) {
        echo "Tutti i campi sono obbligatori.";
        exit();
    }

    // 2. Verifica che la password sia lunga almeno 8 caratteri
    if (strlen($password) < 8) {
        echo "La password deve contenere almeno 8 caratteri.";
        exit();
    }

    // 3. Verifica che la password e la conferma corrispondano
    if ($password !== $conf_password) {
        echo "Le password non corrispondono.";
        exit();
    }

    // 4. Verifica che il numero di telefono sia lungo almeno 10 caratteri
    if (strlen($telefono) < 10) {
        echo "Il numero di telefono deve contenere almeno 10 caratteri.";
        exit();
    }

    // 5. Verifica che l'username, l'email e il numero di telefono non siano già registrati
    $sql = "SELECT * FROM utenti WHERE username = '$username' OR email = '$email' OR telefono = '$telefono'";
    $risp = mysqli_query($conn, $sql);

    if (mysqli_num_rows($risp) > 0) {
        echo "Username, email o numero di telefono già occupati.";
        mysqli_close($conn);
        exit();
    }

    // 6. Hash della password prima di salvarla
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 7. Salvataggio dei dati nel database
    $sql = "INSERT INTO utenti (cognome, username, email, password, data_nascita, telefono)
            VALUES ('$cognome', '$username', '$email', '$hashed_password', '$data_nascita', '$telefono')";

    if (mysqli_query($conn, $sql)) {
        echo "Registrazione avvenuta con successo!";
    } else {
        echo "Errore durante la registrazione: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="it">
<?php mostraHead("Registrati") ?>

    <body>
<?php
mostraHeader();
mostraNav();
?>

    <div class="RegistratiForm">
        <h2>Registrati al nostro sito</h2>
        <form action="registrazione.php" method="POST">

           <label for="username">Nome:</label>
           <input type="text" id="username" name="username" required><br><br>

           <label for="cognome">Cognome:</label>
           <input type="text" id="cognome" name="cognome" required><br><br>


           <label for="email">Email:</label>
           <input type="email" id="email" name="email" required><br><br>

           <label for="data_nascita">Data di nascita:</label>
           <input type="date" id="data_nascita" name="data_nascita" required>

           <label for="telefono">Telefono:</label>
           <input type="tel" id="telefono" name="telefono" required>

           <label for="password">Password (min. 8 caratteri):</label>
           <input type="password" id="password" name="password" required><br><br>

           <label for="conf_password">Conferma Password:</label>
           <input type="password" id="conf_password" name="conf_password" required><br><br>

          <button type="submit">Registrati</button>
        </form>
        <p>Hai già un account? <a href="login.php">Accedi qui</a></p>
    </div>



    <hr>
   <?php mostraFooter(); ?>

      </body>
    </html>
