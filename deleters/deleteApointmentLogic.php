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
<div class="centerdbody">
    <?php
    function removeApointmentFromCSV($filename, $targetValue){
        // Leggi il contenuto del file CSV in un array e creo array per facilitare lettura e modifica
        $rows = array();
        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
                $rows[] = $data;
            }
            fclose($handle);
        } else {
            echo "Errore nell'apertura del file.";
            return false;
        }

        $updatedRows = array();
        foreach ($rows as $row) {
            // Supponiamo che il valore target sia nella prima colonna
            $temp = str_replace(" ", "", implode(",", $row));
            if (str_replace(" ", "", implode(",", $row)) != $targetValue) {
                $updatedRows[] = $row;
            }
        }

        // Scrivi l'array aggiornato di nuovo nel file CSV
        if (($handle = fopen($filename, 'w')) !== FALSE) {
            foreach ($updatedRows as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
            return true;
        } else {
            echo "Errore nell'apertura del file per la scrittura.";
            return false;
        }
    }

    // Verifica se la richiesta è di tipo POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ricevi il valore dal form


        $targetValue = $_POST["dropdown"];

        // Nome del file CSV
        $filename = '../data/apointments.csv';

        // Rimuovi la riga e mostra il risultato
        if (removeApointmentFromCSV($filename, $targetValue)) {
            echo "appuntamento  '$targetValue' è stato rimosso";
        }
        //echo $_POST["dropdown"];
        //echo $_POST["cognome"];
    }
    ?>
    <br>
    <a href="../index.html" class="button-link">torna alla home</a>
    <a href="../viewers/calendarLogic.php" class="button-link">visualizza appuntamenti</a>
</div>

</body>
</html>