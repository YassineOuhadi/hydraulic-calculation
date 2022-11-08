
<?php   
function fct_bdd(){
    
$monfichier = fopen('../file.txt', 'r+');
$cas = fgets($monfichier);
fclose($monfichier); 
    
if($cas==0){       
$servername = 'localhost';
$username = 'root';
$password = '';           
try{  
$dbco = new PDO("mysql:host=$servername", $username, $password);
$dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);               
$sql = "
CREATE DATABASE jesa;
USE jesa;
--
-- Base de données : `jesa`
--

-- --------------------------------------------------------

--
-- Structure de la table `adjoindre`
--

CREATE TABLE `adjoindre` (
  `id` int(11) NOT NULL,
  `id_trajet` int(11) DEFAULT NULL,
  `id_piece` int(11) DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `k` float DEFAULT NULL,
  `Diametre` float DEFAULT NULL,
  `D` float DEFAULT NULL,
  `D1` float DEFAULT NULL,
  `D2` float DEFAULT NULL,
  `langueur` float DEFAULT NULL,
  `angle` float DEFAULT NULL,
  `rayon` float DEFAULT NULL,
  `cote_depart` float DEFAULT NULL,
  `perte_charge` float DEFAULT NULL,
  `cote_arrivee` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `categorie_id` int(11) NOT NULL,
  `categorie_libelle` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categorie_id`, `categorie_libelle`) VALUES
(1, 'ELEMENTS DROITS'),
(2, 'VANNES ET ROBINETS'),
(3, 'COUDES'),
(4, 'CONES'),
(5, 'CHANGEMENTS'),
(6, 'TÉS'),
(7, 'Autres');

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id_compte` int(11) NOT NULL,
  `email` mediumtext DEFAULT NULL,
  `password` mediumtext DEFAULT NULL,
  `image` mediumtext DEFAULT NULL,
  `username` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `pieces`
--

CREATE TABLE `pieces` (
  `id_piece` int(11) NOT NULL,
  `nom_piece` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pieces`
--

INSERT INTO `pieces` (`id_piece`, `nom_piece`, `image`, `categorie_id`) VALUES
(1, 'ROBINETS VANNES', 'ROBINETS VANNES.png', 2),
(2, 'VANNE A PAPILLON', 'ROBINETS A PAPILLON.png', 2),
(3, 'ROBINETS A TOURNANT', 'ROBINETS A TOURNANT.png', 2),
(4, 'COUDE ARRONDI', 'COUDE ARRONDI.png', 3),
(5, 'COUDE BRUSQUE', 'COUDE BRUSQUE.png', 3),
(6, 'BRANCHEMENT DE PRISE', 'BRANCHEMENT DE PRISE.png', 6),
(7, 'BRANCHEMENT D\'AMENÉE', 'BRANCHEMENT D’AMENÉE.png', 6),
(8, 'CONE DIVERGENT', 'CONE DIVERGENT.png', 4),
(9, 'CONE CONVERGENT', 'CONE CONVERGENT.gif', 4),
(10, 'ÉLARGISSEMENT BRUSQUE', 'CHANGEMENT BRUSQUE  ÉLARGISSEMENT.png', 5),
(11, 'RÉTRÉCISSEMENT BRUSQUE', 'CHANGEMENT BRUSQUE  RÉTRÉCISSEMENT.png', 5),
(13, 'ElÉMENT DROIT', 'Conduite.png', 1),
(15, 'VANNE DE RÉGLAGE', 'VANNE DE RÉGLAGE.png', 2),
(16, 'Débitmètre', 'Débitmètre.png', 7),
(17, 'Crépine', 'Crépine.png', 7),
(18, 'Départ', 'Départ.png', 7),
(19, 'Arrivée', 'Arrivée.png', 7);

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE `projet` (
  `id_projet` int(11) NOT NULL,
  `titre_projet` varchar(45) DEFAULT NULL,
  `id_compte` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

CREATE TABLE `trajet` (
  `id_trajet` int(11) NOT NULL,
  `nom_trajet` varchar(45) DEFAULT NULL,
  `debit` float DEFAULT NULL,
  `rugosite` float DEFAULT NULL,
  `temperature` float DEFAULT NULL,
  `id_projet` int(11) DEFAULT NULL,
  `cote_depart` float DEFAULT NULL,
  `perte_charge` float DEFAULT NULL,
  `cote_arrivee` float DEFAULT NULL,
  `type` enum('Refoulement','Gravitaire') NOT NULL DEFAULT 'Gravitaire',
  `sens` enum('Amont-Aval','Aval-Amont') NOT NULL DEFAULT 'Amont-Aval',
  `hauteur` float DEFAULT NULL,
  `puissance` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adjoindre`
--
ALTER TABLE `adjoindre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adjoindre_ibfk_1` (`id_trajet`),
  ADD KEY `adjoindre_ibfk_2` (`id_piece`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorie_id`);

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_compte`);

--
-- Index pour la table `pieces`
--
ALTER TABLE `pieces`
  ADD PRIMARY KEY (`id_piece`),
  ADD KEY `pieces_ibfk_1` (`categorie_id`);

--
-- Index pour la table `projet`
--
ALTER TABLE `projet`
  ADD PRIMARY KEY (`id_projet`),
  ADD KEY `id_compte` (`id_compte`);

--
-- Index pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD PRIMARY KEY (`id_trajet`),
  ADD KEY `trajet_ibfk_1` (`id_projet`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adjoindre`
--
ALTER TABLE `adjoindre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `categorie_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id_compte` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pieces`
--
ALTER TABLE `pieces`
  MODIFY `id_piece` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `projet`
--
ALTER TABLE `projet`
  MODIFY `id_projet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `trajet`
--
ALTER TABLE `trajet`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adjoindre`
--
ALTER TABLE `adjoindre`
  ADD CONSTRAINT `adjoindre_ibfk_1` FOREIGN KEY (`id_trajet`) REFERENCES `trajet` (`id_trajet`),
  ADD CONSTRAINT `adjoindre_ibfk_2` FOREIGN KEY (`id_piece`) REFERENCES `pieces` (`id_piece`);

--
-- Contraintes pour la table `pieces`
--
ALTER TABLE `pieces`
  ADD CONSTRAINT `pieces_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`categorie_id`);

--
-- Contraintes pour la table `projet`
--
ALTER TABLE `projet`
  ADD CONSTRAINT `projet_ibfk_1` FOREIGN KEY (`id_compte`) REFERENCES `compte` (`id_compte`);

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `trajet_ibfk_1` FOREIGN KEY (`id_projet`) REFERENCES `projet` (`id_projet`);
COMMIT;
";
$dbco->exec($sql);
}
catch(PDOException $e){
echo "Erreur : " . $e->getMessage();
};
    
$monfichier = fopen('../file.txt', 'r+');     
$pages_vues=1; // On augmente de 1 ce nombre de pages vues
fseek($monfichier, 0); // On remet le curseur au début du fichier
fputs($monfichier, $pages_vues); // On écrit le nouveau nombre de pages vues
fclose($monfichier);
};
    
try{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=localhost;dbname=jesadatabase','root','',$pdo_options);
}
catch(Exception $e){
		die('Erruer : '.$e->getMessage());
}
return $bdd;   
};   
?>