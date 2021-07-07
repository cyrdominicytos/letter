-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Listage de la structure de la table letterbox. appel
CREATE TABLE IF NOT EXISTS `appel` (
  `id_appel` int(11) NOT NULL AUTO_INCREMENT,
  `fki_courrier_app` int(11) NOT NULL COMMENT 'Clé de la table courrier',
  `provenance` varchar(50) NOT NULL,
  `numero` varchar(20) NOT NULL COMMENT 'Numéro de l''appelant',
  `objet_appel` varchar(255) NOT NULL,
  `message_appel` varchar(255) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL COMMENT 'Action requise suite à l''appel',
  `mention` varchar(50) NOT NULL,
  PRIMARY KEY (`id_appel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.appel : ~0 rows (environ)
/*!40000 ALTER TABLE `appel` DISABLE KEYS */;
/*!40000 ALTER TABLE `appel` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. courrier
CREATE TABLE IF NOT EXISTS `courrier` (
  `id_courrier` int(11) NOT NULL AUTO_INCREMENT,
  `num_courrier` varchar(50) NOT NULL,
  `fki_dossier` varchar(50) NOT NULL,
  `fki_type_courrier` int(11) NOT NULL,
  `courier_lier` varchar(50) NOT NULL,
  `categorie_courrier` varchar(50) NOT NULL,
  `priorite_courrier` varchar(50) NOT NULL,
  `date_courrier` date NOT NULL COMMENT 'Date inscrite sur le courrier à enregistrer',
  `date_arrivee` date NOT NULL,
  `date_limite` datetime DEFAULT NULL COMMENT 'Date limite de traitement du courrier',
  `date_relance` datetime NOT NULL COMMENT 'Date relance du courrier lorsque le courrier n''est pas encore traité',
  `nature_courrier` varchar(50) NOT NULL,
  `objet_courrier` varchar(255) NOT NULL,
  `exp_courrier` int(11) NOT NULL COMMENT 'Celui qui enregistre le courrier dans le système',
  `service_dest` int(11) NOT NULL,
  `courrier_exp` int(11) NOT NULL,
  `confidentiel` varchar(50) NOT NULL,
  `info` varchar(50) NOT NULL,
  `mot_cle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_courrier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.courrier : ~0 rows (environ)
/*!40000 ALTER TABLE `courrier` DISABLE KEYS */;
/*!40000 ALTER TABLE `courrier` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. diffusion
CREATE TABLE IF NOT EXISTS `diffusion` (
  `id_dif` int(11) NOT NULL AUTO_INCREMENT,
  `fki_courrier_dif` int(11) NOT NULL,
  `fki_user_dif` int(11) NOT NULL,
  `fki_statut_dif` int(11) NOT NULL,
  `transferer_par` int(11) DEFAULT NULL,
  `archiver_par` int(11) DEFAULT NULL,
  `date_dif` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_dif`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.diffusion : ~0 rows (environ)
/*!40000 ALTER TABLE `diffusion` DISABLE KEYS */;
/*!40000 ALTER TABLE `diffusion` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. doc
CREATE TABLE IF NOT EXISTS `doc` (
  `id_doc` int(11) NOT NULL AUTO_INCREMENT,
  `fki_courrier_doc` int(11) NOT NULL,
  `entite` varchar(50) NOT NULL,
  `chemin` varchar(100) NOT NULL,
  PRIMARY KEY (`id_doc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.doc : ~0 rows (environ)
/*!40000 ALTER TABLE `doc` DISABLE KEYS */;
/*!40000 ALTER TABLE `doc` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. dossier
CREATE TABLE IF NOT EXISTS `dossier` (
  `id_dossier` int(11) NOT NULL AUTO_INCREMENT,
  `code_dossier` varchar(50) NOT NULL,
  `nom_dossier` varchar(100) NOT NULL,
  `type_dossier` varchar(100) NOT NULL,
  `date_dossier` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fki_suc_dos` int(11) NOT NULL,
  `supprimer_dos` int(11) DEFAULT '0',
  PRIMARY KEY (`id_dossier`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.dossier : ~2 rows (environ)
/*!40000 ALTER TABLE `dossier` DISABLE KEYS */;
INSERT INTO `dossier` (`id_dossier`, `code_dossier`, `nom_dossier`, `type_dossier`, `date_dossier`, `fki_suc_dos`, `supprimer_dos`) VALUES
	(1, 'DOSSIER_001', 'DOSSIER_SBEE', 'COURRIER', '2020-10-06 11:35:48', 1, 1),
	(2, 'DOSSIER_002', 'DOSSIER_CENA', 'AUTRE', '2020-10-06 13:16:09', 1, 1),
	(4, 'DOSSIER_003', 'DOSSIER_SONEB', 'COURRIER', '2020-10-06 19:02:43', 1, 0),
	(5, 'DOSSIER_003', 'DOSSIER_ASSI', 'AUTRE', '2020-11-12 09:34:15', 1, 1);
/*!40000 ALTER TABLE `dossier` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. expediteur
CREATE TABLE IF NOT EXISTS `expediteur` (
  `id_exp` int(11) NOT NULL AUTO_INCREMENT,
  `nomcomplet` varchar(50) NOT NULL,
  `tel_exp` varchar(50) NOT NULL,
  `email_exp` varchar(50) NOT NULL,
  `supprimer_exp` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_exp`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.expediteur : ~2 rows (environ)
/*!40000 ALTER TABLE `expediteur` DISABLE KEYS */;
INSERT INTO `expediteur` (`id_exp`, `nomcomplet`, `tel_exp`, `email_exp`, `supprimer_exp`) VALUES
	(1, 'ASSII', '98989899', 'assii@gmail.com', 1),
	(2, 'ARCEP', '68676767', 'arcep@gmail.com', 1),
	(3, 'ADN', '67121212', 'adn@gmail.com', 1);
/*!40000 ALTER TABLE `expediteur` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. facture
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `fki_courrier_fact` int(11) NOT NULL COMMENT 'La clé de la table courrier',
  `provenance_fact` varchar(100) NOT NULL COMMENT 'provenance de la facture',
  `montant_fact` float NOT NULL,
  `date_paie` date NOT NULL COMMENT 'Date à laquelle la facture doit être payée',
  `type_facture` varchar(100) NOT NULL,
  PRIMARY KEY (`id_facture`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.facture : ~0 rows (environ)
/*!40000 ALTER TABLE `facture` DISABLE KEYS */;
/*!40000 ALTER TABLE `facture` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. pays
CREATE TABLE IF NOT EXISTS `pays` (
  `id_pays` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_pays` varchar(50) NOT NULL,
  `code_pays` varchar(5) NOT NULL,
  PRIMARY KEY (`id_pays`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.pays : ~2 rows (environ)
/*!40000 ALTER TABLE `pays` DISABLE KEYS */;
INSERT INTO `pays` (`id_pays`, `libelle_pays`, `code_pays`) VALUES
	(1, 'BENIN', 'BJ'),
	(2, 'TOGO', 'TG');
/*!40000 ALTER TABLE `pays` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. privileges
CREATE TABLE IF NOT EXISTS `privileges` (
  `id_priv` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_priv` varchar(50) NOT NULL,
  `courrier_priv` int(11) NOT NULL,
  `user_priv` int(11) NOT NULL,
  `service_priv` int(11) NOT NULL,
  `dossier_priv` int(11) NOT NULL,
  `group_priv` int(11) NOT NULL,
  `priv_priv` int(11) NOT NULL,
  `supprimer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_priv`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.privileges : ~3 rows (environ)
/*!40000 ALTER TABLE `privileges` DISABLE KEYS */;
INSERT INTO `privileges` (`id_priv`, `libelle_priv`, `courrier_priv`, `user_priv`, `service_priv`, `dossier_priv`, `group_priv`, `priv_priv`, `supprimer`) VALUES
	(1, 'ADMINISTRATEUR', 1, 1, 1, 1, 1, 1, 1),
	(2, 'UTILISATEUR', 1, 0, 0, 0, 0, 0, 1);
/*!40000 ALTER TABLE `privileges` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. profil
CREATE TABLE IF NOT EXISTS `profil` (
  `id_profil` int(11) NOT NULL AUTO_INCREMENT,
  `menu_profil` varchar(100) NOT NULL,
  `priv_profil` varchar(255) NOT NULL,
  `priv_service` varchar(120) NOT NULL,
  `priv_user` varchar(120) NOT NULL,
  `priv_courrier` varchar(120) NOT NULL,
  `libelle_profil` varchar(120) NOT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.profil : ~2 rows (environ)
/*!40000 ALTER TABLE `profil` DISABLE KEYS */;
INSERT INTO `profil` (`id_profil`, `menu_profil`, `priv_profil`, `priv_service`, `priv_user`, `priv_courrier`, `libelle_profil`) VALUES
	(1, 'a:5:{i:0;s:6:"profil";i:1;s:4:"user";i:2;s:7:"service";i:3;s:7:"employe";i:4;s:8:"courrier";}', 'a:5:{s:4:"list";s:1:"1";s:3:"add";s:1:"1";s:4:"edit";s:1:"1";s:3:"del";s:1:"1";s:3:"val";i:0;}', 'a:5:{s:4:"list";s:1:"1";s:3:"add";s:1:"1";s:4:"edit";s:1:"1";s:3:"del";s:1:"1";s:3:"val";i:0;}', 'a:5:{s:4:"list";s:1:"1";s:3:"add";s:1:"1";s:4:"edit";s:1:"1";s:3:"del";s:1:"1";s:3:"val";i:0;}', 'a:5:{s:4:"list";s:1:"1";s:3:"add";s:1:"1";s:4:"edit";s:1:"1";s:3:"del";s:1:"1";s:3:"val";s:1:"1";}', 'Test'),
	(2, 'a:3:{i:0;s:6:"profil";i:1;s:7:"employe";i:2;s:8:"courrier";}', 'a:5:{s:4:"list";s:1:"1";s:3:"add";s:1:"1";s:4:"edit";i:0;s:3:"del";i:0;s:3:"val";i:0;}', 'a:5:{s:4:"list";i:0;s:3:"add";i:0;s:4:"edit";i:0;s:3:"del";i:0;s:3:"val";i:0;}', 'a:5:{s:4:"list";s:1:"1";s:3:"add";s:1:"1";s:4:"edit";i:0;s:3:"del";i:0;s:3:"val";i:0;}', 'a:5:{s:4:"list";s:1:"1";s:3:"add";s:1:"1";s:4:"edit";i:0;s:3:"del";i:0;s:3:"val";i:0;}', 'JoseProfil');
/*!40000 ALTER TABLE `profil` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. service
CREATE TABLE IF NOT EXISTS `service` (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `code_service` varchar(50) NOT NULL,
  `libelle_service` varchar(50) NOT NULL,
  `id_suc_serv` int(11) NOT NULL,
  `supprimer_serv` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_service`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.service : ~6 rows (environ)
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` (`id_service`, `code_service`, `libelle_service`, `id_suc_serv`, `supprimer_serv`) VALUES
	(1, 'INFO', 'INFORMATIQUE', 1, 1),
	(2, 'ADMIN', 'ADMINISTRATIF', 1, 1),
	(3, 'DG', 'DIRECTION GENERALE', 1, 1),
	(4, 'OPS', 'OPERATIONS', 1, 1),
	(5, 'COMPTA', 'COMPTABILITE/FISCALITE', 1, 1),
	(6, 'COM', 'COMMERCIALE  MARKETING', 1, 1);
/*!40000 ALTER TABLE `service` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. statut
CREATE TABLE IF NOT EXISTS `statut` (
  `id_statut` int(11) NOT NULL AUTO_INCREMENT,
  `libelle_statut` varchar(50) NOT NULL,
  PRIMARY KEY (`id_statut`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.statut : ~4 rows (environ)
/*!40000 ALTER TABLE `statut` DISABLE KEYS */;
INSERT INTO `statut` (`id_statut`, `libelle_statut`) VALUES
	(1, 'A TRAITER'),
	(2, 'TRANSFERER'),
	(3, 'ARCHIVER'),
	(4, 'EN COPIE');
/*!40000 ALTER TABLE `statut` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. surccusale
CREATE TABLE IF NOT EXISTS `surccusale` (
  `id_suc` int(11) NOT NULL AUTO_INCREMENT,
  `fki_pays` int(11) NOT NULL,
  `libelle_suc` varchar(50) NOT NULL,
  `supprimer_suc` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_suc`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.surccusale : ~2 rows (environ)
/*!40000 ALTER TABLE `surccusale` DISABLE KEYS */;
INSERT INTO `surccusale` (`id_suc`, `fki_pays`, `libelle_suc`, `supprimer_suc`) VALUES
	(1, 1, 'AKASI-BENIN', 1),
	(2, 2, 'AKASI-TOGO', 1);
/*!40000 ALTER TABLE `surccusale` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. type_courrier
CREATE TABLE IF NOT EXISTS `type_courrier` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `fki_suc_typ` int(11) NOT NULL,
  `libelle_type` varchar(50) NOT NULL,
  `delai_traitement` int(11) NOT NULL,
  `delai_relance` int(11) NOT NULL,
  `supprimer_typ` int(11) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.type_courrier : ~11 rows (environ)
/*!40000 ALTER TABLE `type_courrier` DISABLE KEYS */;
INSERT INTO `type_courrier` (`id_type`, `fki_suc_typ`, `libelle_type`, `delai_traitement`, `delai_relance`, `supprimer_typ`) VALUES
	(1, 1, 'INFO', 2, 3, 0),
	(2, 1, 'INFON', 2, 2, 0),
	(3, 1, 'INFONN', 2, 22, 0),
	(4, 1, 'SECU', 3, 5, 0),
	(5, 1, 'AZERTY', 2, 3, 0),
	(6, 1, 'DAO', 2, 2, 1),
	(7, 1, 'APPEL', 3, 3, 1),
	(8, 1, 'INFORMATION', 4, 4, 1),
	(9, 1, 'SECURITE', 5, 5, 1),
	(10, 1, 'RECOUVREMENT', 6, 6, 1),
	(11, 1, 'FACTURE', 7, 7, 1);
/*!40000 ALTER TABLE `type_courrier` ENABLE KEYS */;

-- Listage de la structure de la table letterbox. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `fki_suc_us` int(11) NOT NULL,
  `fki_profil_us` int(11) NOT NULL,
  `fki_service_us` int(11) NOT NULL,
  `nom_user` varchar(50) NOT NULL,
  `prenom_user` varchar(50) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) DEFAULT NULL,
  `date_user` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Listage des données de la table letterbox.user : ~2 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `fki_suc_us`, `fki_profil_us`, `fki_service_us`, `nom_user`, `prenom_user`, `titre`, `email`, `pass`, `date_user`, `statut`) VALUES
	(1, 1, 1, 1, 'ADMIN', 'Admin', 'ADMIN', 'admin@akasigroup.com', '$2y$10$qBRvqNCDFptqqBcIjSm55.2qZ.wTzEjizLMP/Iywigj69HLgUFa1C', '2020-09-26 00:04:45', 1),
	(16, 1, 2, 3, 'HOUDAGBA', 'Pierre', 'DG', 'phoudagba@akasigroup.com', '$2y$10$.ER4.CXonpb.il106UjEP.8wC5DW8332W7bqKR/vQwO1pbOshQQB6', '2020-11-26 09:40:08', 1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
