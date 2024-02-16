<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script defer src="/Hacker_Poulette/scripts/script.js"></script>
	<script src="https://cdn.tailwindcss.com"></script>
	<script src="https://www.google.com/recaptcha/enterprise.js" async defer></script>
	<title>Hacker Poulette</title>
</head>

<body>
	<?php
	$servername = "localhost";
	$username = "root"; // kuctthjq_user
	$password = ""; // mmhh5hZh7L7K55S7SL
	$dbname = "instruction"; //kuctthjq_db

	try {
		// On se connecte à MySQL
		$bdd = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (Exception $e) {
		// En cas d'erreur, on affiche un message et on arrête tout
		echo "Erreur : " . $e->getMessage();
	}

	// Récupération des données de la table Météo


	$selectQuery = "SELECT * FROM costumer_info";
	$selectStatement = $bdd->prepare($selectQuery);
	$selectStatement->execute();
	$costumerData = $selectStatement->fetchAll(PDO::FETCH_ASSOC);

	// Traitement de la suppression des noms dans le formulaire
	if (isset($_POST['delete'])) {
		$deleteQuery = "DELETE FROM costumer_info WHERE nom = :nomToDelete";
		$deleteStatement = $bdd->prepare($deleteQuery);
		$deleteStatement->bindParam(':nomToDelete', $_POST['delete']);
		$deleteStatement->execute();
	}

	$selectQuery = "SELECT * FROM costumer_info";
	$selectStatement = $bdd->prepare($selectQuery);
	$selectStatement->execute();
	$costumer_infoData = $selectStatement->fetchAll(PDO::FETCH_ASSOC);
	?>

	<table class="max-w-md mx-auto relative overflow-hidden z-10 bg-white p-8 rounded-lg shadow-md before:w-24 before:h-24 before:absolute before:bg-purple-500 before:rounded-full before:-z-10 before:blur-2xl after:w-32 after:h-32 after:absolute after:bg-sky-400 after:rounded-full after:-z-10 after:blur-xl after:top-24 after:-right-12">
		<h1 class="text-2xl text-sky-900 text-center font-bold mb-6">Dashboard</h1>
		<tr>
			<th class="pl-2 py-2">Nom</th>
			<th class="py-2">Prénom</th>
			<th class="py-2">E-mail</th>
			<th class="py-2">Fichier</th>
			<th class="py-2">Description</th>
			<th class="py-2">Action</th>
		</tr>
		<?php foreach ($costumerData as $data) : ?>
			<tr class="py-8 border-y-4 border-slate-400/25 border-collapse">
				<td class="pl-2 pb-2"><?= $data['nom'] ?></td>
				<td class="pb-2"><?= $data['prenom'] ?></td>
				<td class="pb-2"><?= $data['mail'] ?></td>
				<td class="pb-2"><?= $data['file'] ?></td>
				<td class="pr-2"><?= $data['description'] ?></td>
				<td>
                    <form class="[background:linear-gradient(144deg,#af40ff,#5b42f3_50%,#00ddeb)] m-1 text-white px-4 py-2 mt-3 font-bold rounded-md hover:opacity-80 bg-sky-500 hover:bg-sky-700" method="post" action="">
                        <input type="hidden" name="delete" value="<?= $data['nom'] ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
			</tr>
		<?php endforeach; ?>
	</table>

</body>

</html>