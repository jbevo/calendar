<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') { //usate quando si passano i parametri con il form
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $nazione = $_POST['nazione'];
    $dataNascita = $_POST['dataNascita'];
    $genere = $_POST['genere'];
}

$fd=fopen("userData.csv","a+");
$utente = $cognome ."," .$nome ."," .$nazione ."," .$dataNascita ."," .$genere. "\n";
fputs($fd, "$utente");
fclose($fd);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="generalcss.css">
    <title>post</title> 
</head>
<style>
    <?php include 'generalcss.css'; ?>
</style>
<body>
<?php
echo 
"<form action='calendarLogic.php' method='POST'>
    <p>salve " .$cognome ." " .$nome ."<br>". "richieda data e ora per l'appuntamento</p>
    <label for='data_ora'>Data e ora:</label>
    <input type='datetime-local' id='data_ora' name='data_ora' required>
    <input class='hidename' type='string' id='cognome' name='cognome' value='$cognome'>
    <br>
    <input type='submit' value='Invia'>
</form><br>";

?>
</body>
</html>