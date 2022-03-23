-- SFx1 - Authentifier
SELECT *
    FROM `users`
WHERE
    `users`.`username` = '$username'
AND
    `users`.`hash` = '$hash';

-- Gestion des entreprises
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

-- Rechercher une entreprise avec le critère "nom_localite"
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
    `candidatures`.`evaluation` = `$evaluation`;

-- SFx3 - Créer une entreprise
INSERT INTO 
    `entreprises` (`nom_entreprise`, `hidden`) 
VALUES 
    ('$nom_entreprise', '$hidden');

INSERT INTO 
    `secteurs_activite` (`nom_secteur_activite`) 
VALUES 
    ('$nom_secteur_activite');

INSERT INTO 
    `entreprise_secteur` (`id_entreprise`, `id_secteur_activite`) 
VALUES 
    ('$id_entreprise', '$id_secteur_activite');

INSERT INTO 
    `localites` (`nom_localite`) 
VALUES 
    ('$nom_localite');

INSERT INTO 
    `entreprise_loc` (`id_entreprise`, `id_localite`) 
VALUES 
    ('$id_entreprise', '$id_localite');

-- SFx4 - Modifier une entreprise
UPDATE 
    `entreprises` 
SET 
    nom_entreprise = '$nom_entreprise', hidden = '$hidden' 
WHERE 
    id_entreprise = $id_entreprise;

UPDATE 
    `secteurs_activite` 
SET 
    nom_secteur_activite = '$nom_secteur_activite' 
WHERE 
    id_secteur_activite = $id_secteur_activite;

UPDATE 
    `localites` 
SET 
    nom_localite = `$nom_localite` 
WHERE 
    
    id_localite = $id_localite;

-- SFx5 - Evaluer une entreprise
UPDATE `candidature` SET evaluation = '$evaluation' WHERE id_offre = $id_offre; 

-- SFx6 - Rendre invisible pour les étudiants


-- SFx7 - Consulter les statistiques de l'entreprise


-- Gestion des offres de stage
-- SFx8 - Rechercher une offre
-- Rechercher une offre avec le critère "nom_competence"
SELECT
    `competences`.`nom_competence`, 
    `offres_stage`.`nom_poste_offre` 
FROM 
    `competences` LEFT JOIN `offre_competence` USING (`id_competence`) LEFT JOIN `offres_stage` USING (`id_offre`)
WHERE 
    `competences`.`nom_competence` LIKE '%$nom_competence%';

-- Rechercher une offre avec le critère "nom_localite"
SELECT
    `localites`.`nom_localite`, 
    `offres_stage`.`nom_poste_offre` 
FROM 
    `localites` LEFT JOIN `offre_loc` USING (`id_localite`) LEFT JOIN `offres_stage` USING (`id_offre`)
WHERE 
    `localites`.`nom_localite` LIKE '%$nom_localite%';

-- Rechercher une offre avec le critère "nom_entreprise"
SELECT
    `entreprises`.`nom_entreprise`, 
    `offres_stage`.`nom_poste_offre` 
FROM 
    `entreprises` LEFT JOIN `offres_stage` USING (`id_entreprise`)
WHERE 
    `entreprises`.`nom_entreprise` LIKE '%$nom_entreprise%';

-- Rechercher une offre avec le critère "duree_stage"
SELECT 
	`duree_stage`,`nom_poste_offre`
FROM 
    `offres_stage`
WHERE 
    `offres_stage`.`duree_stage` like '%$duree_stage%';

-- Rechercher une offre avec le critère "base_remuneration"
SELECT 
	`base_remuneration`,`nom_poste_offre`
FROM 
    `offres_stage`
WHERE 
    `offres_stage`.`base_remuneration` like '%$base_remuneration%';

-- Rechercher une offre avec le critère "date_stage"
SELECT 
	`date_stage`,`nom_poste_offre`
FROM 
    `offres_stage`
WHERE 
    `offres_stage`.`date_stage` like '%$date_stage%';

-- Rechercher une offre avec le critère "nbr_places_offre"
SELECT 
	`nbr_places_offre`,`nom_poste_offre`
FROM 
    `offres_stage`
WHERE 
    `offres_stage`.`nbr_places_offre` like '%$nbr_places_offre%';

-- SFx9 - Créer une offre
INSERT INTO 
    `offres_stage` (`nom_poste_offre`, `duree_stage`,`base_remuneration`,`date_stage`,`nbr_places_offre`) 
VALUES 
    (`$nom_poste_offre`, `$duree_stage`,`$base_remuneration`,`$date_stage`,`$nbr_places_offre`);

INSERT INTO 
    `competences` (`nom_competence`) 
VALUES 
    (`$nom_competence`);

INSERT INTO 
    `offre_competence` (`id_competence`, `id_offre`) 
VALUES 
    (`$id_competence`, `$id_offre`);

-- SFx10 - Modifier une offre
UPDATE 
    `offres_stage` 
SET 
    nom_poste_offre = '$nom_poste_offre', duree_stage = '$duree_stage', base_remuneration = '$base_remuneration', date_stage = '$date_stage', nbr_places_offre = '$nbr_place_offre'
WHERE 
    id_offre = $id_offre;

UPDATE 
    `competences` 
SET 
    nom_competence = '$nom_competence' 
WHERE 
    id_competence = $id_competence;

-- SFx11 - Supprimer une offre
DELETE FROM `offres_stage` WHERE `id_offre` = `$id_offre`;

-- SFx12 - Consulter les statistiques des offres


-- Gestion des pilotes de promotions
-- SFx13 - Rechercher un compte pilote
-- Rechercher un pilote avec le critère "nom_user"
SELECT
    `users`.`nom_user`, 
    `roles`.`nom_role` 
FROM 
    `users` 
    LEFT JOIN `roles` USING (`id_role`)
WHERE 
    `users`.`nom_user` LIKE '%$nom_user%' 
AND 
    `roles`.`nom_role` like '%pilote%';

-- Rechercher un pilote avec le critère "prenom_user"
SELECT
    `users`.`prenom_user`, 
    `roles`.`nom_role` 
FROM 
    `users` 
    LEFT JOIN `roles` USING (`id_role`)
WHERE 
    `users`.`prenom_user` LIKE '%$prenom_user%' 
AND 
    `roles`.`nom_role` LIKE '%pilote%';

-- Rechercher un pilote avec le critère "nom_centre"
SELECT
    `users`.`prenom_user`,
    `roles`.`nom_role`,
    `centres`.`nom_centre` 
FROM 
    `users` 
    LEFT JOIN `user_centre` USING (`id_user`) 
    LEFT JOIN `centres` USING (`id_centre`) 
    LEFT JOIN `roles` USING (`id_role`)
WHERE 
    `centres`.`nom_centre` LIKE '%$nom_centre%' 
AND 
	`roles`.`nom_role` LIKE '%pilote%';

--Rechercher un pilote avec le critère "promo concernee"


-- SFx14 - Créer un compte pilote
INSERT INTO 
    `users` (`nom_user`, `prenom_user`, `username`, `hash`)
VALUES 
    (`$nom_user`, `$prenom_user`, `$username`, `$hash`);

INSERT INTO
    `roles` (`nom_role`)
VALUES 
    (`$nom_role`);

INSERT INTO 
    `centres` (`nom_centre`)
VALUES 
    (`$nom_centre`);

INSERT INTO 
    `user_centre` (`id_ user`, `id_centre`)
VALUES 
    (`$id_ user`, `$id_centre`);
--manque promo concernée

-- SFx 15 - Modifier un compte pilote

