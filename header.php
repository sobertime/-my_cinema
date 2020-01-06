<?php
include_once 'dossier/pdo.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<title>my_cinema</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="styles.css">
	<script src="https://kit.fontawesome.com/85e28e81c5.js"></script>
</head>
<body>
	<header>
		<div class="top">
			<h1><i class="fas fa-video"></i> My Cinema</h1>
			<a href="index.php"><i class="fas fa-home"></i> Accueil</a>
			<a href="abonnement.php"><i class="fas fa-crown"></i> Abonnement</a>
			<a href="reduction.php"><i class="fas fa-percentage"></i> Réductions</a>
			<a href="membre.php"><i class="fas fa-users"></i> Membres</a>
			<div class="search">
				<form action="search.php" class="formulaire" method="GET">
					<input name="search" class="champ" type="text" placeholder="Rechercher un film..."/>
					<select name="genre">
						<option value="none">in all genre</option>
						<?php
						include_once "dossier/pdo.php";
						$retour = $conn->query('SELECT * FROM genre');
						$i=0;
						while ($row = $retour->fetch()){
							echo "<option value ='" . $i . "'>" . $row['nom'] ."</option>";
							$i++;
						}
						?>
					</select>
					<select name="distrib">
						<option value="none">in all distrib</option>
						<?php
						include "dossier/pdo.php";
						$retour = $conn->query('SELECT * FROM distrib');
						$i=0;
						while ($row = $retour->fetch()){
							echo "<option value ='" . $i . "'>" . $row['nom'] ."</option>";
							$i++;
						}
						?>
					</select>
					<button type="submit" name="submit-search"><i class="fas fa-search"></i> Rechercher</button>
					<select name="i">
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
					</select>
				</form>
			</div>
		</div>
	</header>
