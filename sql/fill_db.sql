INSERT INTO `entreprises` (`id_entreprise`, `nom_entreprise`, `hidden`) VALUES
('1', 'Meta', '0'),
('2', 'Lamborghini', '0'),
('3', 'Amazon', '0'),
('4', 'Carrefour', '1'),
('5', 'Auchan', '0'),
('6', 'Match', '0'),
('7', 'BUT', '0'),
('8', 'IKEA', '0'),
('9', 'H&M', '0'),
('10', 'Zara', '0'),
('11', 'Zwarowski', '1'),
('12', 'Ford', '0'),
('13', 'Michelin', '0'),
('14', 'Leroy-Merlin', '0'),
('15', 'Bouygues', '1'),
('16', 'Lafarge', '0'),
('17', 'Bret''s', '0'),
('18', 'Lays', '0'),
('19', 'Vico', '0');

INSERT INTO `secteurs_activite` (`id_secteur_activite`, `nom_secteur_activite`) VALUES
('1', 'Service'),
('2', 'Commerce'),
('3', 'Automobile'),
('4', 'Industrie'),
('5', 'BTP'),
('6', 'Cosmetique'),
('7', 'Production'),
('8', 'Alimentation'),
('9', 'IT'),
('10', 'Immobilier'),
('11', 'Industrie Textile');

INSERT INTO `entreprise_secteur` (`id_secteur_activite`, `id_entreprise`) VALUES
('9', '1'),
('4', '1'),
('3', '2'),
('6', '2'),
('2', '3'),
('1', '3'),
('2', '4'),
('7', '4'),
('10', '4'),
('2', '5'),
('2', '6'),
('2', '7'),
('2', '8'),
('11', '9'),
('11', '10'),
('6', '11'),
('3', '12'),
('4', '13'),
('5', '14'),
('5', '15'),
('5', '16'),
('8', '17'),
('8', '18'),
('8', '19');

INSERT INTO `localites` (`id_localite`, `nom_localite`) VALUES
('1', 'Lille'),
('2', 'Paris - La Defense'),
('3', 'Rouen'),
('4', 'Marseille'),
('5', 'Toulouse'),
('6', 'Brest'),
('7', 'Mulhouse'),
('8', 'Toulouse'),
('9', 'Bordeaux'),
('10', 'Orléans'),
('11', 'Strasbourg'),
('12', 'Londres'),
('13', 'Lyon'),
('14', 'Nice'),
('15', 'Calais'),
('16', 'Bruxelles'),
('17', 'France');

INSERT INTO `entreprise_loc` (`id_entreprise`, `id_localite`) VALUES
('1', '1'),
('1', '3'),
('1', '4'),
('1', '5'),
('1', '6'),
('2', '7'),
('3', '4'),
('4', '9'),
('5', '6'),
('6', '1'),
('7', '3'),
('8', '4'),
('9', '2'),
('10', '13'),
('11', '16'),
('12', '15'),
('13', '12'),
('14', '9'),
('15', '8'),
('16', '14'),
('17', '2'),
('18', '10'),
('19', '11');

INSERT INTO `offres_stage` (`id_offre`, `nom_poste_offre`, `duree_stage`, `base_remuneration`, `date_stage`, `nbr_places_offre`, `id_entreprise`) VALUES
('1', 'Developpeur Backend H/F', '3', '5.92', '2022-04-05', '3', '1'),
('2', 'Developpeur Frontend H/F', '3', '5.42', '2022-04-05', '3', '1'),
('3', 'Ingénieur Réseau', '5', '6', '2022-07-04', '10', '2');

INSERT INTO `offre_loc` (`id_offre`, `id_localite`) VALUES
('1', '17'),
('2', '17'),
('3', '1');

INSERT INTO `competences` (`id_competence`, `nom_competence`) VALUES
('1', '.NET'),
('2', 'CCNA'),
('3', 'C++'),
('4', 'Python'),
('5', 'Java'),
('6', 'JavaScript'),
('7', 'HTML'),
('8', 'CSS');

INSERT INTO `offre_competence` (`id_offre`, `id_competence`) VALUES
('1', '1'),
('1', '5'),
('1', '6'),
('2', '6'),
('2', '7'),
('2', '8'),
('3', '2');

INSERT INTO `centres` (`id_centre`, `nom_centre`) VALUES
('1', 'Lille'),
('2', 'Arras');

INSERT INTO `roles` (`id_role`, `nom_role`) VALUES
('0', 'Administrateur'),
('1', 'Pilote'),
('2', 'Délégué'),
('3', 'Etudiant');

INSERT INTO `permissions` (`id_permission`, `nom_permission`) VALUES
('1', 'auth'),
('2', 'entreprise_search'),
('3', 'entreprise_add'),
('4', 'entreprise_edit'),
('5', 'entreprise_rate'),
('6', 'entreprise_delete'),
('7', 'entreprise_stats'),
('8', 'offre_search'),
('9', 'offre_add'),
('10', 'offre_edit'),
('11', 'offre_delete'),
('12', 'offre_stats'),
('13', 'pilote_search'),
('14', 'pilote_add'),
('15', 'pilote_edit'),
('16', 'pilote_delete'),
('17', 'delegue_search'),
('18', 'delegue_add'),
('19', 'delegue_edit'),
('20', 'delegue_delete'),
('21', 'delegue_stats'),
('22', 'etudiant_search'),
('23', 'etudiant_add'),
('24', 'etudiant_edit'),
('25', 'etudiant_delete'),
('26', 'etudiant_stats'),
('27', 'wishlist_add'),
('28', 'wishlist_delete'),
('29', 'offre_apply'),
('30', 'notify_step1'),
('31', 'notify_step2'),
('32', 'notify_step3'),
('33', 'notify_step4'),
('34', 'notify_step5');

INSERT INTO `promotions` (`id_promo`, `nom_promo`) VALUES
('1', 'A1 Lille'),
('2', 'A2 Informatique Lille'),
('3', 'A3 Informatique Lille'),
('4', 'A4 Informatique Lille'),
('5', 'A5 Informatique Lille'),
('6', 'A2 Généralistes Lille'),
('7', 'A1 Arras'),
('8', 'A2 Informatique Arras'),
('9', 'A3 Informatique Arras'),
('10', 'A4 Informatique Arras'),
('11', 'A5 Informatique Arras'),
('12', 'A2 Généralistes Arras'),
('13', 'A3 Généralistes Arras'),
('14', 'A4 Généralistes Arras'),
('15', 'A5 Généralistes Arras');

INSERT INTO `promos_concernees` (`id_offre`, `id_promo`) VALUES
('1', '4'),
('1', '5'),
('1', '10'),
('1', '11'),
('2', '2'),
('2', '3'),
('2', '8'),
('2', '9'),
('3', '5');

INSERT INTO `users` (`id_user`, `username`, `hash`, `nom_user`, `prenom_user`, `id_role`) VALUES
('0', 'root', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2', 'root', 'root', '0'),
('1', 'remi.marseault', '5d083861cf64d72b6306317e8abf95a544d090319c46bf060e9e97b1aa502796', 'Marseault', 'Rémi', '2'),
('2', 'brieuc.dumortier', '730ca90d64d84f08b2466a09be3c8443bf1830bd9d7e4cb86b22e225f8ad56a8', 'Dumortier', 'Brieuc', '3'),
('3', 'kevin.laurent', '444d435509a86d00d181715c450654e4f50f5f738270eee53ad463a056802984', 'Laurent', 'Kevin', '3'),
('4', 'sikken', '5b69af90e51a98d8e49d70f7bccaf2eff4eb91634772432a2e481caebe545a50', 'Ikken', 'Sonia', '1'),
('5', 'tperquis', '41bec361357d00d680c55f6955c01005c7837bcd77c47d49bf219cf52eb296b1', 'Perquis', 'Thibault', '1');

INSERT INTO `user_centre` (`id_user`, `id_centre`) VALUES
('1', '1'),
('2', '1'),
('3', '1'),
('4', '1'),
('5', '2');

INSERT INTO `user_promo` (`id_user`, `id_promo`) VALUES
('1', '2'),
('2', '2'),
('3', '2'),
('4', '2'),
('4', '3'),
('5', '8'),
('5', '9');

INSERT INTO `user_permission` (`id_user`, `id_permission`, `is_enabled`) VALUES
('1', '1', '1'),
('1', '2', '1'),
('1', '3', '1'),
('1', '4', '1'),
('1', '5', '1'),
('1', '6', '1'),
('1', '7', '1'),
('1', '8', '1'),
('1', '9', '1'),
('1', '10', '1'),
('1', '11', '1'),
('1', '12', '1'),
('1', '13', '1'),
('1', '14', '1'),
('1', '15', '1'),
('1', '16', '1'),
('1', '17', '1'),
('1', '18', '1'),
('1', '19', '1'),
('1', '20', '1'),
('1', '21', '1'),
('1', '22', '1'),
('1', '23', '1'),
('1', '24', '1'),
('1', '25', '1'),
('1', '26', '1'),
('1', '27', '1'),
('1', '28', '1'),
('1', '29', '1'),
('1', '30', '1'),
('1', '31', '1'),
('1', '32', '1'),
('1', '33', '1'),
('1', '34', '1');