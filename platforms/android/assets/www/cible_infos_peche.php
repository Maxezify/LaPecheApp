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
	

		//Recherche des infos du nombre de peche de l'utilisateur  connecté 
		$lecture=$bdd ->prepare('SELECT Nombre_peche 
							 FROM peche 
							 WHERE ID_utilisateurs = :ID_utilisateurs');

		$lecture->execute(array(
					'ID_utilisateurs' => $_SESSION['ID']));	

		$resultat = $lecture->fetch();

		//Recuperation des données sous forme de json
		$infos_peche = array();

		$infos_peche['Nombre_peche'] = $resultat['Nombre_peche'];

		echo json_encode($infos_peche);






?>