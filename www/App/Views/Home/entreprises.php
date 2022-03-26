<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
</head>
<body>
<?php
foreach ($entreprises as $entreprise) {
    echo "<pre>$entreprise[nom_entreprise]\n";

    echo "    Localités :\n";
    foreach ($entreprise['localites'] as $localite) {
        echo "        $localite\n";
    }

    echo "    Secteurs d'activité :\n";
    foreach ($entreprise['secteurs_activite'] as $secteur_activite) {
        echo "        $secteur_activite\n";
    }
    echo "</pre>";
} ?>
</body>
</html>