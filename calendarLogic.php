<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Controlla se il campo data e ora è stato inviato
    if (isset($_POST["data_ora"])) {
        $data_ora = $_POST["data_ora"];
        echo $data_ora;
        // Puoi fare altre operazioni con la data e l'ora qui
    } else {
        $data_ora = 0;
    }
    $cognome = $_POST['cognome'];
    echo $cognome;
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
echo '<table border="1">';
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
            $currentDateFormat = new DateTime($currentDate);
            $dateToColorFormat = new DateTime($dateToColor);
            $cellClass = '';

            if ($dayCounter == date("d", strtotime($dateToColor))) {
                $cellClass = 'highlight';
                //echo ("in");
            }


            // Stampare la cella con la classe CSS appropriata
            echo '<td class="' . $cellClass . '">' . $dayCounter . '</td>';
            $dayCounter++;
        }
    }

    echo '</tr>';
}

// Chiudi la tabella
echo '</table>';
?>
