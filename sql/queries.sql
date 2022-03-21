-- SFx1 - Authentifier
SELECT *
    FROM `users`
WHERE
    `users`.`username` = '$username'
AND
    `users`.`hash` = '$hash';
-- SFx2 - Rechercher une entreprise (en faisant une reqûete par critères)
SELECT nom_entreprise FROM entreprises WHERE NOT hidden





-- SFx3 - Créer une entreprise