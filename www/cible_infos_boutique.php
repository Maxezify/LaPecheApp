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
	



		//Recherche des infos du commerce dans la table commercant en fonction de la personne connecté
		$lecture=$bdd ->prepare('SELECT Nom_boutique, Description, Adresse, Ville, Horaire
							 FROM commercant 
							 WHERE ID_utilisateurs = :ID_utilisateurs');

		$lecture->execute(array(
					'ID_utilisateurs' => $_SESSION['ID']));	

		$resultat = $lecture->fetch();

		//Recuperation des données sous forme de json
		$infos_boutique = array();

		$infos_boutique['Nom_boutique'] = $resultat['Nom_boutique'];
		$infos_boutique['Description'] = $resultat['Description'];
		$infos_boutique['Adresse'] = $resultat['Adresse'];
		$infos_boutique['Ville'] = $resultat['Ville'];
		$infos_boutique['Horaire'] = $resultat['Horaire'];

		echo json_encode($infos_boutique);







?>