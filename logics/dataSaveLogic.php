<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //usate quando si passano i parametri con il form
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $nazione = $_POST['nazione'];
    $dataNascita = $_POST['dataNascita'];
    $genere = $_POST['genere'];

    if (!empty($cognome)) {
        $_SESSION['cognome'] = $cognome;
    }
    if (!empty($nome)) {
        $_SESSION['nome'] = $nome;
    }

    //aggiungere controllo per non avere doppi utenti
    $fd=fopen("../data/userData.csv","a+");
    $utente = "";
    if(isset($cognome) && isset($nome) && isset($nazione) && isset($dataNascita) && isset($genere)){
        $utente = $cognome ."," .$nome ."," .$nazione ."," .$dataNascita ."," .$genere. "\n";
    }else{
        $utente = "jone, doe, america, 1/1/1111, m";
    }
    fputs($fd, "$utente");
    fclose($fd);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') { //usate quando si passano i parametri con il form
    $nomeCognome = $_GET['dropdown'];
    //dividere nome e congome
    $data_splited = explode("-", $nomeCognome, 1000);
    $nome = $data_splited[0];
    $cognome = $data_splited[1];
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