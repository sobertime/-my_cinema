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
					<button type="submit" name="submit"><i class="fas fa-search"></i> Rechercher</button>
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
	<div class="dernierfilm">
		<h3 class="soustitre">Afficher le profil d'un User</h3>
		<div class="client">
			<?php
			$search = ($_GET["client"]);
			$page = isset($_GET['p']) ? ($_GET['p']) : 0;
			$items = isset($_GET['i']) ? ($_GET['i']) : 5;
			echo "<form action='user.php?i=".$items."&p=".$page."' method='GET'>"
			?>
			<input name="client" class="champ" type="text" placeholder="Rechercher le nom d'un client.."/>
			<button type="submit" name="submit"><i class="fas fa-search"></i> Rechercher</button>
		</form>
		<?php
		if($page > 0){
			echo "<form action='user.php?client=".$client."&i=".$items."&p=".($page - 1)."' class='formulaire' method='POST'>";
			echo "<button type='submit' name='prec' class='leftbutton'><i class='fas fa-arrow-left'></i>Page précédente</button>";
			echo "</form>";
		}
		echo "<form action='user.php?client=".$search."&i=".$items."&p=".($page + 1)."' class='formulaire' method='POST'>";
		echo "<button type='submit' name='suiv' class='rightbutton'>Page suivante  <i class='fas fa-arrow-right'></i></button>";
		echo"</form>";
		?>
	</div>
</div>
<div class="dernierfilm">
	<?php
	$search = ($_GET["client"]);
	$page = isset($_GET['p']) ? ($_GET['p']) : 0;
	$items = isset($_GET['i']) ? ($_GET['i']) : 5;
	$retour2 = $conn->query("SELECT *, abonnement.nom as abonnement, fiche_personne.nom as nome, fiche_personne.prenom as prenom from fiche_personne LEFT OUTER JOIN membre ON fiche_personne.id_perso=membre.id_fiche_perso LEFT OUTER JOIN abonnement ON membre.id_abo=abonnement.id_abo WHERE fiche_personne.nom LIKE '%$search%' or fiche_personne.prenom LIKE '%$search%' ORDER BY nome ASC LIMIT ".($page*$items).",".$items);
	while($row = $retour2->fetch()){
		$retour = $conn->query("SELECT * FROM abonnement order by id_abo ASC");
		echo "<div class='user'>";
		echo "<h3>Nom: " . $row["nome"] . "</h3>";
		echo "<h3>Prenom: " . $row["prenom"] . "</h3>";
		echo "<h4>Date de naissance: " . substr($row["date_naissance"],0,-9) . "</h4>";
		echo "<h4>ID: " . $row["id_membre"]. "</h4>";
		echo "<p>Ville: " . $row['ville'] . "</p>";
		echo "<p>Code postal: " . $row['cpostal'] . "</p>";
		echo "<p>Mail: " . $row['email'] . "</p>";
		echo "<br>";
		echo "<h4><i class='fas fa-user-edit'></i> Modifier l'abonnement</h4>";
		echo "<p>Abonnement actuel: " . $row["abonnement"] . "</p>";
		echo "<form action='subs.php?nom=".$row['nome']."&prenom=".$row['prenom']."' class='edit' method='POST'>";
		echo "<select name='subs'>";
		while ($row2 = $retour->fetch()){
			echo "<option value ='" . $row2['id_abo'] . "'>" . $row2['nom'] ."</option>";
		}
		echo "</select>";
		echo "<button type='submit' name='submit-valid'>Valider <i class='fas fa-check'></i></button>";
		echo "</form>";
		echo "<form action='edit.php?nom=".$row['nome']."&prenom=".$row['prenom']."' method='POST'>";
		echo "<button type='submit' name='submit-del'><i class='fas fa-trash-alt'></i>  Supprimer abonnement</button>";
		echo "</form>";
		echo "<br>";
		echo "<form action='historiquefilm.php?nom=".$row['nome']."&prenom=".$row['prenom']."&id=".$row['id_membre']."&i=5' method='POST'>";
		echo "<button type='submit' name='submit-del'><i class='fas fa-history'></i> Voir l'historique</button>";
		echo "</form>";
		echo "</div>";
	}
	?>
</div>
</body>
</html>
