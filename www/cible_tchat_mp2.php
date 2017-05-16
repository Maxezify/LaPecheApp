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
	

	echo $_POST['nom_commerce_mp'];
	//echo '<pre>';

	/*if(!empty($_POST['nom_commerce_mp']))
	{

		//Recherche  de l'id  du commercant corrspondant aux nom de la boutique entré par l'utilisateur
		$req = $bdd ->prepare('SELECT ID_commercant, Nom_boutique, ID_utilisateurs
			   FROM commercant
			   WHERE Nom_boutique = :nom_boutique');

		$req->execute(array("nom_boutique"=>$_POST['nom_commerce_mp']));

		$resultat = $req->fetch();

		$id_utilisateurs_du_commercant =  $resultat['ID_utilisateurs'];

		//Verif avec ce if si le nom de la boutique existe dans la bdd
		if($_POST['nom_commerce_mp'] == $resultat['Nom_boutique'])
		{
		
			//verif si l'utilisateur ne choisit pas sa propre boutique pour se parler à lui même
			if($_POST['nom_commerce_utili_co']!=$resultat['Nom_boutique'])
			{
					
				echo 'rien';
			}
			else
			{
				echo 'Veuillez ne pas choisir votre magasin.';
			}

		}
		else
		{
			echo 'Veuillez rentrer un nom de Boutique correspondant à la liste.';
		}
	}
	else
	{
		echo 'Le champs n\'a pas été rempli, veuillez vérifier.';
	}
*/





?>