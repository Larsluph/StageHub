-- SFx1
SELECT *
    FROM `users`
WHERE
    `users`.`username` = '$username'
AND
    `users`.`hash` = '$hash';
-- SFx2
SELECT nom_entreprise FROM entreprises WHERE NOT hidden
