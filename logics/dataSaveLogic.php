<?php

function isRecordDuplicate($filename, $newRecord) {
    if (!file_exists($filename)) {
        return false;
    }

    if (($file = fopen($filename, 'r')) !== FALSE) {
        while (($data = fgetcsv($file, 1000)) !== FALSE) {
            if (implode(',', $data) == $newRecord) {
                //echo "ritorna vero";
                fclose($file);
                return true;
            }
        }
        fclose($file);
    }
    //echo "ritorna falso";
    return false;
}

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //usate quando si passano i parametri con il form
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $nazione = $_POST['nazione'];
    $dataNascita = $_POST['dataNascita'];
    $genere = $_POST['genere'];

    //aggiungere controllo per non avere doppi utenti
    if(isset($cognome) && isset($nome) && isset($nazione) && isset($dataNascita) && isset($genere)){
        $fd=fopen("../data/userData.csv","a+");
        $utente = "";
        $utente =  $nome ."," .$cognome ."," .$nazione ."," .$dataNascita ."," .$genere;
        //echo $utente . "<br>";

        $filename = "../data/userData.csv";

        if(isRecordDuplicate($filename, $utente)) {
            header('Location: dataSaveLogic.php?dropdown=' . $cognome . "-" . $nome);
        }else{
            fputs($fd, "$utente" . "\n");
        }

        fclose($fd);
    }else{
        $utente = "jone, doe, america, 1/1/1111, m";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') { //usate quando si passano i parametri con il form
    $nomeCognome = $_GET['dropdown'];
    //dividere nome e congome
    $data_splited = explode("-", $nomeCognome, 1000);
    $nome = $data_splited[0];
    //echo $nome;
    $cognome = $data_splited[1];
    //echo $cognome;
}

if (!empty($cognome)) {
    $_SESSION['cognome'] = $cognome;
}
if (!empty($nome)) {
    $_SESSION['nome'] = $nome;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../generalcss.css">
    <title>post</title> 
</head>
<style>
    <?php include 'generalcss.css'; ?>
</style>
<body>
<?php
if (isset($cognome) && isset($nome)) {
    echo
    "<form action='calendarLogic.php' class='centerdbody' method='POST'>
        <p>salve " .$cognome . " " .$nome ."<br>". "richieda data e ora per l'appuntamento</p>
        <label for='data_ora'>Data e ora:</label>
        <input type='datetime-local' id='data_ora' name='data_ora' required>
        <br>
        <input type='submit' value='Invia'>
        <a href='../index.html' class='button-link'>torna alla home</a>
    </form><br>";
}
?>
</body>
</html>