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
    <form class="centerdbody" action="Logics/dataSaveLogic.php" method="POST">
        <label for="nome ">Nome: </label><input type="text" name="nome" id="nome " placeholder="inserisci il tuo nome" size="20"><br>

        <label for="cognome">Cognome: </label><input type="text" name="cognome" id="cognome" placeholder="inserisci il tuo cognome" size="20"><br>

        <label for="nazione">Nazione: </label><select size="1" name="nazione" id="nazione">
            <option value="ch">Svizzera</option>
            <option value="it">Italia</option>
            <option value="fr">Francia</option>
        </select><br>

        <label for="dataNascita">Data di nascita: </label><input type="date" id="dataNascita" name="dataNascita" required><br>

        Genere:<br>
        <label>
            <input type="radio" name="genere" value="f">
        </label>F<br>
        <label>
            <input type="radio" name="genere" value="M" checked>
        </label>M<br>

        <input type="submit" value="invia">
    </form>

    
</body>
</html>