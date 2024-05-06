<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <link rel="stylesheet" href="generalcss.css">
</head>
<style>
    <?php include 'generalcss.css'; ?>
</style>
<body>
    <form action="dataSaveLogic.php" method="POST">
        Nome: <input type="text" name="nome" id="nome "placeholder="inserisci il tuo nome" size="20"><br>

        Cognome: <input type="text" name="cognome" id="cognome" placeholder="inserisci il tuo cognome" size="20"><br>

        Nazione: <select size="1" name="nazione" id="nazione"> 
            <option value="ch">Svizzera</option>
            <option value="it">Italia</option>
            <option value="fr">Francia</option>
        </select><br>

        Data di nascita: <input type="date" id="dataNascita" name="dataNascita" required><br>
        
        Genere: <input type="radio" name="genere" id="genere" value="F">F
        <input type="radio" name="genere" value="M" checked>M<br>

        <input type="submit" value="invia">
    </form>

    
</body>
</html>