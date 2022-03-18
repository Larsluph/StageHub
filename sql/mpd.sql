#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: entreprises
#------------------------------------------------------------

CREATE TABLE entreprises(
        id_entreprise  Int  Auto_increment  NOT NULL ,
        nom_entreprise Varchar (50) NOT NULL ,
        hidden         Bool NOT NULL
	,CONSTRAINT entreprises_PK PRIMARY KEY (id_entreprise)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: offres_stage
#------------------------------------------------------------

CREATE TABLE offres_stage(
        id_offre          Int  Auto_increment  NOT NULL ,
        nom_poste_offre   Varchar (50) NOT NULL ,
        duree_stage       Int NOT NULL ,
        base_remuneration DECIMAL (15,3)  NOT NULL ,
        date_stage        Datetime NOT NULL ,
        nbr_places_offre  Int NOT NULL ,
        id_entreprise     Int NOT NULL
	,CONSTRAINT offres_stage_PK PRIMARY KEY (id_offre)

	,CONSTRAINT offres_stage_entreprises_FK FOREIGN KEY (id_entreprise) REFERENCES entreprises(id_entreprise)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: competences
#------------------------------------------------------------

CREATE TABLE competences(
        id_competence  Int  Auto_increment  NOT NULL ,
        nom_competence Varchar (30) NOT NULL
	,CONSTRAINT competences_AK UNIQUE (nom_competence)
	,CONSTRAINT competences_PK PRIMARY KEY (id_competence)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: localites
#------------------------------------------------------------

CREATE TABLE localites(
        id_localite  Int  Auto_increment  NOT NULL ,
        nom_localite Varchar (30) NOT NULL
	,CONSTRAINT localites_AK UNIQUE (nom_localite)
	,CONSTRAINT localites_PK PRIMARY KEY (id_localite)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: roles
#------------------------------------------------------------

CREATE TABLE roles(
        id_role  Int  Auto_increment  NOT NULL ,
        nom_role Varchar (20) NOT NULL
	,CONSTRAINT roles_PK PRIMARY KEY (id_role)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: users
#------------------------------------------------------------

CREATE TABLE users(
        id_user     Int  Auto_increment  NOT NULL ,
        hash        Char (64) NOT NULL ,
        nom_user    Varchar (30) NOT NULL ,
        prenom_user Varchar (30) NOT NULL ,
        username    Varchar (24) NOT NULL ,
        id_role     Int NOT NULL
	,CONSTRAINT users_AK UNIQUE (username)
	,CONSTRAINT users_PK PRIMARY KEY (id_user)

	,CONSTRAINT users_roles_FK FOREIGN KEY (id_role) REFERENCES roles(id_role)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: promotions
#------------------------------------------------------------

CREATE TABLE promotions(
        id_promo  Int  Auto_increment  NOT NULL ,
        nom_promo Varchar (20) NOT NULL
	,CONSTRAINT promotions_AK UNIQUE (nom_promo)
	,CONSTRAINT promotions_PK PRIMARY KEY (id_promo)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: centres
#------------------------------------------------------------

CREATE TABLE centres(
        id_centre  Int  Auto_increment  NOT NULL ,
        nom_centre Varchar (20) NOT NULL
	,CONSTRAINT centres_AK UNIQUE (nom_centre)
	,CONSTRAINT centres_PK PRIMARY KEY (id_centre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: secteurs_activite
#------------------------------------------------------------

CREATE TABLE secteurs_activite(
        id_secteur_activite  Int  Auto_increment  NOT NULL ,
        nom_secteur_activite Varchar (50) NOT NULL
	,CONSTRAINT secteurs_activite_AK UNIQUE (nom_secteur_activite)
	,CONSTRAINT secteurs_activite_PK PRIMARY KEY (id_secteur_activite)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: permissions
#------------------------------------------------------------

CREATE TABLE permissions(
        id_permission  Int  Auto_increment  NOT NULL ,
        nom_permission Varchar (30) NOT NULL
	,CONSTRAINT permissions_PK PRIMARY KEY (id_permission)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: offre_competence
#------------------------------------------------------------

CREATE TABLE offre_competence(
        id_competence Int NOT NULL ,
        id_offre      Int NOT NULL
	,CONSTRAINT offre_competence_PK PRIMARY KEY (id_competence,id_offre)

	,CONSTRAINT offre_competence_competences_FK FOREIGN KEY (id_competence) REFERENCES competences(id_competence)
	,CONSTRAINT offre_competence_offres_stage0_FK FOREIGN KEY (id_offre) REFERENCES offres_stage(id_offre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: entreprise_loc
#------------------------------------------------------------

CREATE TABLE entreprise_loc(
        id_localite   Int NOT NULL ,
        id_entreprise Int NOT NULL
	,CONSTRAINT entreprise_loc_PK PRIMARY KEY (id_localite,id_entreprise)

	,CONSTRAINT entreprise_loc_localites_FK FOREIGN KEY (id_localite) REFERENCES localites(id_localite)
	,CONSTRAINT entreprise_loc_entreprises0_FK FOREIGN KEY (id_entreprise) REFERENCES entreprises(id_entreprise)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: offre_loc
#------------------------------------------------------------

CREATE TABLE offre_loc(
        id_offre    Int NOT NULL ,
        id_localite Int NOT NULL
	,CONSTRAINT offre_loc_PK PRIMARY KEY (id_offre,id_localite)

	,CONSTRAINT offre_loc_offres_stage_FK FOREIGN KEY (id_offre) REFERENCES offres_stage(id_offre)
	,CONSTRAINT offre_loc_localites0_FK FOREIGN KEY (id_localite) REFERENCES localites(id_localite)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: promos_concernees
#------------------------------------------------------------

CREATE TABLE promos_concernees(
        id_promo Int NOT NULL ,
        id_offre Int NOT NULL
	,CONSTRAINT promos_concernees_PK PRIMARY KEY (id_promo,id_offre)

	,CONSTRAINT promos_concernees_promotions_FK FOREIGN KEY (id_promo) REFERENCES promotions(id_promo)
	,CONSTRAINT promos_concernees_offres_stage0_FK FOREIGN KEY (id_offre) REFERENCES offres_stage(id_offre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user_promo
#------------------------------------------------------------

CREATE TABLE user_promo(
        id_promo Int NOT NULL ,
        id_user  Int NOT NULL
	,CONSTRAINT user_promo_PK PRIMARY KEY (id_promo,id_user)

	,CONSTRAINT user_promo_promotions_FK FOREIGN KEY (id_promo) REFERENCES promotions(id_promo)
	,CONSTRAINT user_promo_users0_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user_centre
#------------------------------------------------------------

CREATE TABLE user_centre(
        id_user   Int NOT NULL ,
        id_centre Int NOT NULL
	,CONSTRAINT user_centre_PK PRIMARY KEY (id_user,id_centre)

	,CONSTRAINT user_centre_users_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
	,CONSTRAINT user_centre_centres0_FK FOREIGN KEY (id_centre) REFERENCES centres(id_centre)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: candidatures
#------------------------------------------------------------

CREATE TABLE candidatures(
        id_offre          Int NOT NULL ,
        id_user           Int NOT NULL ,
        is_in_wishlist    Bool ,
        statut_reponse    Int NOT NULL ,
        evaluation        Float NOT NULL ,
        cv                Blob NOT NULL ,
        lettre_motivation Blob NOT NULL ,
        fiche_validation  Blob NOT NULL ,
        convention_stage  Blob NOT NULL
	,CONSTRAINT candidatures_PK PRIMARY KEY (id_offre,id_user)

	,CONSTRAINT candidatures_offres_stage_FK FOREIGN KEY (id_offre) REFERENCES offres_stage(id_offre)
	,CONSTRAINT candidatures_users0_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user_permission
#------------------------------------------------------------

CREATE TABLE user_permission(
        id_permission Int NOT NULL ,
        id_user       Int NOT NULL ,
        is_enabled    Bool NOT NULL
	,CONSTRAINT user_permission_PK PRIMARY KEY (id_permission,id_user)

	,CONSTRAINT user_permission_permissions_FK FOREIGN KEY (id_permission) REFERENCES permissions(id_permission)
	,CONSTRAINT user_permission_users0_FK FOREIGN KEY (id_user) REFERENCES users(id_user)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: entreprise_secteur
#------------------------------------------------------------

CREATE TABLE entreprise_secteur(
        id_secteur_activite Int NOT NULL ,
        id_entreprise       Int NOT NULL
	,CONSTRAINT entreprise_secteur_PK PRIMARY KEY (id_secteur_activite,id_entreprise)

	,CONSTRAINT entreprise_secteur_secteurs_activite_FK FOREIGN KEY (id_secteur_activite) REFERENCES secteurs_activite(id_secteur_activite)
	,CONSTRAINT entreprise_secteur_entreprises0_FK FOREIGN KEY (id_entreprise) REFERENCES entreprises(id_entreprise)
)ENGINE=InnoDB;

