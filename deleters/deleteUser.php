<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    <?php include '..\generalcss.css'; ?>
</style>
<body>
<form class="centerdbody" action="deleteUserLogic.php" method="POST">
    <label for="dropdown">selezione utente da cancellare</label><select id="dropdown" name="dropdown">
        <?php
        // Percorso del file CSV
        $filename = '../data/userData.csv';

        // Apri il file in modalità lettura
        if (($file = fopen($filename, 'r')) !== FALSE) {
            // Leggi ed elabora il file CSV riga per riga
            while (($data = fgetcsv($file, 1000, ',')) !== FALSE) {
                // Supponiamo che la prima colonna sia il valore e la seconda colonna sia il testo dell'opzione
                $text = htmlspecialchars($data[0] . "-" . $data[1]);
                $value = htmlspecialchars($data[0] . " " . $data[1]);
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