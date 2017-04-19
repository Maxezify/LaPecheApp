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
	

	//echo $_POST['email'];
	//echo '<pre>';
	//echo $_POST['mdp'];


	if(!empty($_POST['email']) AND !empty($_POST['mdp']))
	{
		//hachage du mot de passe
		$mdp_hache = sha1($_POST['mdp']);

		$lecture=$bdd ->prepare('SELECT ID_utilisateurs, Prenom, Email 
								 FROM utilisateurs 
								 WHERE Email = :email AND Mot_de_passe = :mdp ');
		$lecture->execute(array(
			'email' => $_POST['email'],
			'mdp'=> $mdp_hache));	
		$resultat = $lecture->fetch();

		if(!$resultat)
		{
			echo 'Erreur de connexion (MDP ou email invalide).';
		}
		else
		{
			
	
			session_start();
			$_SESSION['ID'] = $resultat['ID_utilisateurs'];
			$_SESSION['prenom'] = $resultat['Prenom'];

			$identifiant = array();

			$identifiant['email'] = $resultat['Email'];
			$identifiant['prenom'] = $resultat['Prenom'];
			$identifiant['ID_utilisateurs'] = $resultat['ID_utilisateurs'];
			$identifiant['nombre'] = 42;

			sleep(1);
			echo json_encode($identifiant);
			


			
		}
			
		
	}
	else
	{
		echo 'Veuillez indiquer votre email ou/et votre mot de passe.' ;
	}




?>