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
        function removeRowFromCSV($filename, $targetValue){
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

            $nome = htmlspecialchars($_POST['nome']);
            $cognome = htmlspecialchars($_POST['cognome']);

            $updatedRows = array();
            foreach ($rows as $row) {
                // Supponiamo che il valore target sia nella prima colonna
                if ($row[0] != $cognome && $row[1] != $nome) {
                    print_r($row);
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

            $nome = htmlspecialchars($_POST['nome']);
            $cognome = htmlspecialchars($_POST['cognome']);

            $targetValue = [$nome, $cognome];

            // Nome del file CSV
            $filename = '../data/userData.csv';

            // Rimuovi la riga e mostra il risultato
            if (removeRowFromCSV($filename, $targetValue)) {
                echo "l'utente '$cognome' è stata rimosso";
            } else {
                echo "utente $cognome non esiste";
            }
            //echo $_POST["nome"];
            //echo $_POST["cognome"];
        }
        ?>
        <br>
        <a href="../index.html" class="button-link">torna alla home</a>
        <a href="../logics/viewUsers.php" class="button-link">visualizza utenti</a>
    </div>

</body>
</html>