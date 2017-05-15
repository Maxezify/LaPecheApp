<?php
	//print_r($_POST);
	session_start();

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=application;charset=utf8','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	


	/*il faut savoir que le plugin autcomplete de jquery UI, lorsqu'il ouvre le cible_paiement.php, envoie dans le même temps une variable superglobale de type GET, qui s'appelle term. Elle contient la chaîne de caractère tapée par l'utilisateur. Le principe va donc être de récupérer cette variable, et d'effectuer une requête sur notre base de données grâce à elle !
	
	cf openclassroom*/

	$term = $_GET['term'];


	//Recherche de toutes infos concernant les commerces
	// j'effectue ma requête SQL grâce au mot-clé LIKE
	$req = $bdd ->prepare('SELECT ID_commercant, Nom_boutique, Description, Ville, Adresse, 							  Horaire, ID_utilisateurs
							   FROM commercant
							   WHERE Nom_boutique LIKE :term');

	//Le mot-clé LIKE permet d’effectuer une recherche sur un modèle particulier. Il est par exemple possible de rechercher les enregistrements dont la valeur d’une colonne commence par telle ou telle lettre.
	//cf http://sql.sh/cours/where/like

	//LIKE ‘%a%’ : ce modèle est utilisé pour rechercher tous les enregistrement qui utilisent le caractère « a », ici ca sera la lettre que l'utilisateur aura rentrer dans $term

	$req->execute(array('term' => '%'.$term.'%'));

	$array = array(); // on créé le tableau

	while($donnee = $req->fetch()) // on effectue une boucle pour obtenir les données
	{

	    array_push($array, $donnee['Nom_boutique']); // et on ajoute celles-ci à notre tableau

	}
	sort($array);//regle par ordre alphabetique le nom des boutique dans la liste déroulante


	echo json_encode($array); // il n'y a plus qu'à convertir en JSON





?>