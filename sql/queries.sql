-- SFx1 - Authentifier
SELECT *
    FROM `users`
WHERE
    `users`.`username` = '$username'
AND
    `users`.`hash` = '$hash';

-- SFx2 - Rechercher une entreprise
-- Rechercher une entreprise avec le critère "nom_entreprise"
SELECT nom_entreprise FROM entreprises WHERE NOT hidden AND nom_entreprise like '%$nom_entreprise%' 

-- Rechercher une entreprise avec le critère "secteurs_activite"
SELECT
    `secteurs_activite`.`nom_secteur_activite`, 
    `entreprises`.`nom_entreprise` 
FROM 
    `secteurs_activite` LEFT JOIN `entreprise_secteur` USING (`id_secteur_activite`) LEFT JOIN `entreprises` USING (`id_entreprise`)
WHERE 
    `secteurs_activite`.`nom_secteur_activite` LIKE '%$secteur_activite%';

-- Rechercher une entreprise avec le critère "localites"
SELECT
    `localites`.`nom_localite`, 
    `entreprises`.`nom_entreprise` 
FROM 
    `localites` LEFT JOIN `entreprise_loc` USING (`id_localite`) LEFT JOIN `entreprises` USING (`id_entreprise`)
WHERE 
    `localites`.`nom_localite` LIKE '%$localite%';

-- Rechercher une entreprise avec le critère "nombre d'etudiant cesi"
SELECT 
    COUNT(`candidatures`.`evaluation`), `entreprises`.`nom_entreprise` 
FROM 
    `candidatures` LEFT JOIN `offres_stage` USING (`id_offre`) LEFT JOIN `entreprises` USING (`id_entreprise`) 
WHERE
    `evaluation` >= 3
GROUP BY
    `entreprises`.`id_entreprise`;


--Rechercher une entreprise avec le critère "evaluation"
SELECT 
    `candidatures`.`evaluation`, `entreprises`.`nom_entreprise` 
FROM 
    `candidatures` LEFT JOIN `offres_stage` USING (`id_offre`) LEFT JOIN `entreprises` USING (`id_entreprise`) 
WHERE 
    `candidatures`.`evaluation` = $evaluation;

-- SFx3 - Créer une entreprise
INSERT INTO `entreprises` (nom_entreprise, hidden) VALUES ('$nom_entreprise', '$hidden');
INSERT INTO `secteurs_activite` (nom_secteur_activite) VALUES ('$nom_secteur_activite');
INSERT INTO `entreprise_secteur` (`id_entreprise`, `id_secteur_activite`) VALUES ('$id_entreprise', '$id_secteur_activite');
INSERT INTO `localites` (nom_localite) VALUES ('$nom_localite');
INSERT INTO `entreprise_loc` (`id_entreprise`, `id_localite`) VALUES ('$id_entreprise', '$id_localite');

-- SFx4 - Modifier une entreprise
UPDATE `entreprises` 

-- SFx5 - Evaluer une entreprise


-- SFx6 - Rendre invisible pour les étudiants


-- SFx7 - Consulter les statistiques de l'entreprise