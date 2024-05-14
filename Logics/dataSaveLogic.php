<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //usate quando si passano i parametri con il form
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $nazione = $_POST['nazione'];
    $dataNascita = $_POST['dataNascita'];
    $genere = $_POST['genere'];
}

if (!empty($cognome)) {
    $_SESSION['cognome'] = $cognome;
}
if (!empty($nome)) {
    $_SESSION['nome'] = $nome;
}

$fd=fopen("../data/userData.csv","a+");
$utente = "";
if(isset($cognome) && isset($nome) && isset($nazione) && isset($dataNascita) && isset($genere)){
    $utente = $cognome ."," .$nome ."," .$nazione ."," .$dataNascita ."," .$genere. "\n";
}else{
    $utente = "jone, doe, america, 1/1/1111, m";
}
fputs($fd, "$utente");
fclose($fd);
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
echo 
"<form action='calendarLogic.php' class='centerdbody' method='POST'>
    <p>salve " .$cognome ." " .$nome ."<br>". "richieda data e ora per l'appuntamento</p>
    <label for='data_ora'>Data e ora:</label>
    <input type='datetime-local' id='data_ora' name='data_ora' required>
    <br>
    <input type='submit' value='Invia'>
</form><br>";
?>
</body>
</html>