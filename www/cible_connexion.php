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

		$lecture=$bdd ->prepare('SELECT ID_utilisateurs, Nom, Prenom, Email 
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
			$_SESSION['nom'] = $resultat['Nom'];

			$identifiant = array();

			$identifiant['email'] = $resultat['Email'];
			$identifiant['prenom'] = $resultat['Prenom'];
			$identifiant['nom'] = $resultat['Nom'];
			$identifiant['ID_utilisateurs'] = $resultat['ID_utilisateurs'];
			$identifiant['nombre'] = 42;


			// Verification que la personne n'a pas de boutique pour que lors de la première connexion, il soit redirigé vers la page création boutique
			$lecture2=$bdd ->prepare('SELECT ID_commercant, Nom_boutique, Description, Adresse, Ville, Horaire
								 FROM commercant 
								 WHERE ID_utilisateurs = :ID_utilisateurs');

			$lecture2->execute(array('ID_utilisateurs' => $_SESSION['ID']));	

			if($resultat2 = $lecture2->fetch())
			{
				$rien = 1;
			}
			else
			{
				$rien = 0;
			}
			
			$identifiant['rien'] = $rien;


			sleep(1);
			echo json_encode($identifiant);
			


			
		}
			
		
	}
	else
	{
		echo 'Veuillez indiquer votre email ou/et votre mot de passe.' ;
	}




?>