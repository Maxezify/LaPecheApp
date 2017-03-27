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
	

	echo $_POST['nom_boutique'];
	echo '<pre>';
	echo $_POST['description'];
	/*echo '<pre>';
	echo $_POST['adresse'];
	echo '<pre>';
	echo $_POST['ville'];
	echo '<pre>';
	echo $_POST['horaire'];
	echo '<pre>';*/
	

	//Modification Nom de la boutique 
	if(!empty($_POST['nom_boutique']))
	{
		$req=$bdd ->prepare('UPDATE commercant
							 SET Nom_boutique = :nom_boutique
							 WHERE ID_utilisateurs = :ID_utilisateurs'); 
						
		$req->execute(array(
				'nom_boutique'=>$_POST['nom_boutique'],
				'ID_utilisateurs' => $_SESSION['ID']));
			
		echo '<p>Modif reussi ! </br> </p>';
	}
	else
	{
		echo'Veuillez renseigner le champ Nom de la boutique';
	}

	//Modification de la description
	if(!empty($_POST['description']))
	{
		$req=$bdd ->prepare('UPDATE commercant
							 SET Description = :description
							 WHERE ID_utilisateurs = :ID_utilisateurs'); 
						
		$req->execute(array(
				'description'=>$_POST['description'],
				'ID_utilisateurs' => $_SESSION['ID']));
			
		echo '<p>Modif reussi ! </br> </p>';
	}
	else
	{
		echo'Veuillez renseigner le champ Description';
	}

	//Modification de l'adresse
	if(!empty($_POST['adresse']))
	{
		$req=$bdd ->prepare('UPDATE commercant
							 SET Adresse = :adresse
							 WHERE ID_utilisateurs = :ID_utilisateurs'); 
						
		$req->execute(array(
				'adresse'=>$_POST['adresse'],
				'ID_utilisateurs' => $_SESSION['ID']));
			
		echo '<p>Modif reussi ! </br> </p>';
	}
	else
	{
		echo'Veuillez renseigner le champs adresse';
	}

	/*//Modification de la ville 
	if(!empty($_POST['ville']))
	{
		$req=$bdd ->prepare('UPDATE commercant
							 SET Ville = :ville
							 WHERE ID_utilisateurs = :ID_utilisateurs'); 
						
		$req->execute(array(
				'ville'=>$_POST['ville'],
				'ID_utilisateurs' => $_SESSION['ID']));
			
		echo '<p>Modif reussi ! </br> </p>';
	}
	else
	{
		echo'Veuillez renseigner le champs';
	}

	//Modification des horaires
	if(!empty($_POST['horaire']))
	{
		$req=$bdd ->prepare('UPDATE commercant
							 SET Horaire = :horaire
							 WHERE ID_utilisateurs = :ID_utilisateurs'); 
						
		$req->execute(array(
				'horaire'=>$_POST['horaire'],
				'ID_utilisateurs' => $_SESSION['ID']));
			
		echo '<p>Modif reussi ! </br> </p>';
	}
	else
	{
		echo'Veuillez renseigner le champs';
	}*/








?>