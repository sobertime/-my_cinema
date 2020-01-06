<?php
include 'header.php';
?>
<div class="dernierfilm">
	<h3 class="soustitre">Afficher le profil d'un User</h3>
	<div class="client">
		<form action="user.php" method="GET">
			<input name="client" class="champ" type="text" placeholder="Rechercher le nom d'un user.."/>
			<button type="submit" name="submit"><i class="fas fa-search"></i> Rechercher</button>
		</form>
	</div>
</div>
</body>
</html>
