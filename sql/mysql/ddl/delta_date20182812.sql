





CREATE TABLE da_infosmedical (id INT AUTO_INCREMENT NOT NULL, candidat_id INT DEFAULT NULL, qstmedical_id INT DEFAULT NULL, commentaire VARCHAR(200) DEFAULT NULL, reponse INT DEFAULT 0, status INT DEFAULT 1 NOT NULL, activate INT DEFAULT 1 NOT NULL, archive INT DEFAULT 0 NOT NULL, createdDate DATETIME DEFAULT NULL, updatedDate DATETIME DEFAULT NULL, deletedDate DATETIME DEFAULT NULL, activatedDate DATETIME DEFAULT NULL, deactivatedDate DATETIME DEFAULT NULL, archivedDate DATETIME DEFAULT NULL, restoredDate DATETIME DEFAULT NULL, removedDate DATETIME DEFAULT NULL, undoArhivedDate DATETIME DEFAULT NULL, createdBy INT DEFAULT NULL, updatedBy INT DEFAULT NULL, removedBy INT DEFAULT NULL, deletedBy INT DEFAULT NULL, restoredBy INT DEFAULT NULL, activatedBy INT DEFAULT NULL, deactivatedBy INT DEFAULT NULL, archivedBy INT DEFAULT NULL, undoarchivedBy INT DEFAULT NULL, INDEX IDX_AB30CE8D0EB82 (candidat_id), INDEX IDX_AB30CECF990A3A (qstmedical_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE da_qstmedical (id INT AUTO_INCREMENT NOT NULL, etablissement_id INT DEFAULT NULL, description VARCHAR(200) DEFAULT NULL, actif INT DEFAULT 0, status INT DEFAULT 1 NOT NULL, activate INT DEFAULT 1 NOT NULL, archive INT DEFAULT 0 NOT NULL, createdDate DATETIME DEFAULT NULL, updatedDate DATETIME DEFAULT NULL, deletedDate DATETIME DEFAULT NULL, activatedDate DATETIME DEFAULT NULL, deactivatedDate DATETIME DEFAULT NULL, archivedDate DATETIME DEFAULT NULL, restoredDate DATETIME DEFAULT NULL, removedDate DATETIME DEFAULT NULL, undoArhivedDate DATETIME DEFAULT NULL, createdBy INT DEFAULT NULL, updatedBy INT DEFAULT NULL, removedBy INT DEFAULT NULL, deletedBy INT DEFAULT NULL, restoredBy INT DEFAULT NULL, activatedBy INT DEFAULT NULL, deactivatedBy INT DEFAULT NULL, archivedBy INT DEFAULT NULL, undoarchivedBy INT DEFAULT NULL, anneeScolaire_id INT DEFAULT NULL, INDEX IDX_8B87A937FB76EC81 (anneeScolaire_id), INDEX IDX_8B87A937FF631228 (etablissement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE da_infosmedical ADD CONSTRAINT FK_AB30CE8D0EB82 FOREIGN KEY (candidat_id) REFERENCES da_candidat (id);
ALTER TABLE da_infosmedical ADD CONSTRAINT FK_AB30CECF990A3A FOREIGN KEY (qstmedical_id) REFERENCES da_qstmedical (id);
ALTER TABLE da_qstmedical ADD CONSTRAINT FK_8B87A937FB76EC81 FOREIGN KEY (anneeScolaire_id) REFERENCES un_annee_scolaire (id);
ALTER TABLE da_qstmedical ADD CONSTRAINT FK_8B87A937FF631228 FOREIGN KEY (etablissement_id) REFERENCES un_etablissement (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F42FB76EC81 FOREIGN KEY (anneeScolaire_id) REFERENCES un_annee_scolaire (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F4222115CBB FOREIGN KEY (classePedagogique_id) REFERENCES un_classe_pedagogique (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F42133C791C FOREIGN KEY (classePhysique_id) REFERENCES un_classe_physique (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F42A5522701 FOREIGN KEY (discipline_id) REFERENCES un_discipline (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F42FF631228 FOREIGN KEY (etablissement_id) REFERENCES un_etablissement (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F42BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES un_professeur (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F427A45358C FOREIGN KEY (groupe_id) REFERENCES un_groupe (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F42B3E9C81 FOREIGN KEY (niveau_id) REFERENCES un_niveau (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F4269420F13 FOREIGN KEY (disciplineOption_id) REFERENCES un_discipline_option (id);
ALTER TABLE un_cours_planifie ADD CONSTRAINT FK_6F556F42F3E75638 FOREIGN KEY (sousDiscipline_id) REFERENCES un_sous_discipline (id);
ALTER TABLE da_candidat DROP natureRegime, DROP traitementMedical, DROP natureTraitementMedical, DROP alergie, DROP nomAllergie, DROP nomMaladie, DROP maladie, DROP nomTraitementAllergique, DROP traitementAllergique, DROP handicap, DROP nomHandicap, DROP nomAutresDifficultees, DROP autresDifficultees, DROP nomMaladiesChroniques, DROP maladiesChroniques, DROP regimeAliment;
ALTER TABLE un_matiere_prof ADD CONSTRAINT FK_D8096FA7A5522701 FOREIGN KEY (discipline_id) REFERENCES un_discipline (id);
ALTER TABLE un_matiere_prof ADD CONSTRAINT FK_D8096FA7BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES un_professeur (id);
ALTER TABLE un_matiere_prof ADD CONSTRAINT FK_D8096FA7FB76EC81 FOREIGN KEY (anneeScolaire_id) REFERENCES un_annee_scolaire (id);

Updating database schema...
