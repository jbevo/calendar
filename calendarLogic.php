<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se il campo data e ora è stato inviato
    if (isset($_POST["data_ora"])) {
        $data_ora = $_POST["data_ora"];
        //echo $data_ora;
        // Puoi fare altre operazioni con la data e l'ora qui
    } else {
        $data_ora = 0;
    }
    $cognome = $_POST['cognome'];
    //echo $cognome;

    $fd = fopen("./data/apointments.csv", "a+");
    $appuntamento = $cognome . "," . $data_ora . "\n";
    fputs($fd, "$appuntamento");
    fclose($fd);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    <?php include 'generalcss.css'; ?>
</style>
<body>
<?php
// Imposta la zona oraria
date_default_timezone_set('Europe/Rome');

// Ottieni la data da colorare dalla richiesta POST
$dateToColor = isset($_POST["data_ora"]) ? $_POST["data_ora"] : null;

//lettura date inserite in precedenza
$file_path = 'data/apointments.csv';

// Se la data da colorare è fornita e nel formato corretto, convertila in un oggetto DateTime
$dateToColorObject = null;
if ($dateToColor) {
    $dateToColorObject = DateTime::createFromFormat('Y-m-d', $dateToColor);
}

// Ottieni il numero del mese e dell'anno corrente
$currentMonth = date('n');
$currentYear = date('Y');

// Ottieni il numero di giorni nel mese corrente
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

// Ottieni il primo giorno della settimana del mese corrente
$firstDayOfMonth = date('N', strtotime("$currentYear-$currentMonth-01"));

// HTML per iniziare il calendario
echo '<table>';
echo '<tr><th colspan="7">' . date('F Y') . '</th></tr>';
echo '<tr><th>Lun</th><th>Mar</th><th>Mer</th><th>Gio</th><th>Ven</th><th>Sab</th><th>Dom</th></tr>';

// Inizializza il contatore per i giorni
$dayCounter = 1;

// Loop per stampare le righe del calendario
for ($row = 1; $row <= 6; $row++) {
    echo '<tr>';

    // Loop per stampare le colonne del calendario
    for ($col = 1; $col <= 7; $col++) {
        // Se il giorno corrente è maggiore del numero di giorni nel mese, esci dal loop
        if ($dayCounter > $daysInMonth) {
            break;
        }

        // Se la riga è la prima e la colonna è minore del primo giorno del mese, stampa una cella vuota
        if ($row == 1 && $col < $firstDayOfMonth) {
            echo '<td></td>';
        } else {
            // Altrimenti, verifica se la data corrente corrisponde alla data da colorare
            $currentDate = $currentYear.'-'.$currentMonth.'-'.$dayCounter;
            try {
                $currentDateFormat = new DateTime($currentDate);
                $dateToColorFormat = new DateTime($dateToColor);
            } catch (Exception $e) {
            }
            $cellClass = '';

            $handle = fopen($file_path, 'r');
            if ($handle) {
                // Leggi il file riga per riga
                while (($dati = fgetcsv($handle)) !== false) {
                    // Accedi al secondo dato (indice 1) di ogni riga
                    $secondo_dato = $dati[1];
                    $data_splited = explode("T", $secondo_dato, 5);
                    $data_temp = $data_splited[0];

                    //echo($data_temp[0]);

                    if(($dayCounter == date("d", strtotime($data_temp)))){
                        $cellClass = 'highlight';
                        //echo "dentro\n";
                    }
                }
            }

            //lettura data appena inserita
            if ($dayCounter == date("d", strtotime($dateToColor))) {
                $cellClass = 'highlightJustDid';
                //echo ("in");
            }

            // Stampare la cella con la classe CSS appropriata
            echo '<td class="' . $cellClass . '">' . $dayCounter . '</td>';
            $dayCounter++;
            fclose($handle);
        }
    }
    echo '</tr>';
}


// Chiudi la tabella
echo '</table>';
?>
