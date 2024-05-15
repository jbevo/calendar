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
        echo "<table> <tr><th>Nome</th><th>Cognome</th><th>Nazione</th><th>Data di nascita</th><th>Sesso</th></tr>";
        //lettura degli appuntamenti
        $handle = fopen("../data/userData.csv", "r");
        if ($handle) {
            // Leggi il file riga per riga
            while (($dati = fgetcsv($handle)) !== false) {
                echo "<tr>";
                foreach ($dati as $value) {
                    echo "<td>" .$value . "</td>";
                }
                echo "</tr>";
            }
        }
        //chiudo la tabella paerta inizialmente
        echo "</table>";
    ?>
    <a href="../index.html" class="button-link">torna alla home</a>
</div>
</body>
</html>