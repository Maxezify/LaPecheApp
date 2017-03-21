<?php
	//print_r($_POST);

	try
	{
		$bdd = new PDO('mysql:host=sql01.ouvaton.coop;dbname=07769_appli;charset=utf8','07769_appli','aqzsedrf1',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
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

		$lecture=$bdd ->prepare('SELECT ID_utilisateurs, Prenom 
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
	

			$identifiant = array();


			$identifiant['prenom'] = $resultat['Prenom'];
			$identifiant['ID_utilisateurs'] = $resultat['ID_utilisateurs'];
			//$identifiant['id_aleatoire'] = random_int(1,1000000);
			$identifiant['nombre'] = 1;

			sleep(2);
			echo json_encode($identifiant);
			//echo 'caca';


			
		}
			
		
	}
	else
	{
		echo'Veuillez indiquer votre email ou/et votre mot de passe.';
	}




?>