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
        <?php foreach ($users as $user) {
            echo "<li>$user[id_user] | $user[username]</li>";
        } ?>
    </ul>
</body>
</html>