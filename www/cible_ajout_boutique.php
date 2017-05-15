<?php
	//print_r($_POST);

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=application;charset=utf8','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	

	/*echo $_POST['nom_boutique'];
	echo '<pre>';
	echo $_POST['description'];
	echo '<pre>';
	echo $_POST['adresse'];
	echo '<pre>';
	echo $_POST['ville'];
	echo '<pre>';
	echo $_POST['horaire'];
	echo '<pre>';
	echo $_POST['id'];*/


	if(!empty($_POST['nom_boutique']) AND !empty($_POST['description']) AND !empty($_POST['adresse']) AND !empty($_POST['ville']) AND !empty($_POST['horaire']))
	{
		$res=$bdd ->prepare('INSERT INTO commercant(Nom_boutique, Description, Adresse, Ville, Horaire, ID_utilisateurs) 
							VALUES(:nom_boutique, :description, :adresse, :ville, :horaire, :ID_utilisateurs)');

		$res->execute(array(
				'nom_boutique'=>$_POST['nom_boutique'],
				'description'=>$_POST['description'],
				'adresse'=>$_POST['adresse'],
				'ville'=>$_POST['ville'],
				'horaire'=>$_POST['horaire'],
				'ID_utilisateurs'=>$_POST['id']));
			
		echo '<p>Ajout du commerce réussi ! </br> </p>';
	}
	else
	{
		echo'Veuillez renseigner les champs';
	}




?>