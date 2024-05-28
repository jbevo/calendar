<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <link rel="stylesheet" href="../generalcss.css">
</head>
<style>
    <?php include 'generalcss.css'; ?>
</style>
<body>
    <form action="dataSaveLogic.php" method="GET" class="centerdbody">
        <label for="dropdown">Seleziona utente da registrare:</label>
        <select id="dropdown" name="dropdown">
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["alert"] == "true") {
                echo '<script type="text/javascript">';
                echo 'alert("appuntamento esistente, scegliere altro utente o altro giorno");';
                echo '</script>';

            }

            session_start();
            // Percorso del file CSV
            $filename = '../data/userData.csv';

            // Apri il file in modalità lettura
            if (($file = fopen($filename, 'r')) !== FALSE) {
                // Leggi ed elabora il file CSV riga per riga
                while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
                    // Supponiamo che la prima colonna sia il valore e la seconda colonna sia il testo dell'opzione
                    $text = htmlspecialchars($data[1] . "-" . $data[0]);
                    $value = htmlspecialchars($data[1] . " " . $data[0]);
                    echo "<option value=$text>$value</option>";
                }
                // Chiudi il file
                fclose($file);
            } else {
                echo '<option value="">Errore nell\'apertura del file CSV.</option>';
            }
            ?>
        </select>
        <input type="submit" value="Invia">
        <a href="../index.html" class="button-link">torna alla home</a>
    </form>

</body>
</html>