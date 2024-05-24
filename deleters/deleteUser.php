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
<form class="centerdbody" action="deleteUserLogic.php" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" placeholder="inserisci il tuo nome" size="20" required><br>

    <label for="cognome">Cognome: </label>
    <input type="text" name="cognome" id="cognome" placeholder="inserisci il tuo cognome" size="20" required><br>
    <input type="submit" value="invia">
    <a href="../index.html" class="button-link">torna alla home</a>
</form>

</body>
</html>