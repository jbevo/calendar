<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    <?php include '../generalcss.css'; ?>
</style>
<body>
<div class="centerdbody">
    <?php

    function confrontaGiorni($days1, $days2){
        if(date("d", strtotime($days1)) == date("d", strtotime($days2))){
            return true;
        }else{
            return false;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $data = $_GET['data'];
        //echo $data . "<br>";
        //creazione prima parte della tabella
        echo "<table> <tr><th>persona</th><th>ora</th></tr>";
        //lettura degli appuntamenti
        $handle = fopen("../data/apointments.csv", "r");
        $controllo = true;
        if ($handle) {
            // Leggi il file riga per riga
            while (($dati = fgetcsv($handle)) !== false) {
                //prende il gionro
                $dato = $dati[1];
                $data_splited = explode("T", $dato, 5);
                $giorno = $data_splited[0];
                $ora = $data_splited[1];
                if(confrontaGiorni($data, $giorno)){
                    //vado a creare una riga della colonna con dentro la persona e poi l'ora del appuntamento
                    echo "<tr><td>" .$dati[0] . "</td><td> ". $ora . "</td></tr>";
                    $controllo = false;
                }
            }
        }
        //chiudo la tabella paerta inizialmente
        echo "</table>";
    }
    ?>
    <a href="../index.html" class="button-link">torna alla home</a>
</div>
</body>
</html>