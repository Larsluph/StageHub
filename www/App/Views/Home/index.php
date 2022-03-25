<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
</head>
<body>
    <ul>
        <?php foreach ($entreprises as $entreprise) {
            echo "<li>$entreprise[nom_entreprise]<ul>";
            echo "<li>$entreprise[localites]</li>";
            echo "<li>$entreprise[secteurs_activite]</li></ul></li>";
        } ?>
    </ul>
</body>
</html>