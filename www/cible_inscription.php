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
	

	//echo $_POST['nom'];
	//echo '<pre>';
	//echo $_POST['prenom'];
	//echo '<pre>';
	//echo $_POST['email'];
	//echo '<pre>';
	//echo $_POST['mdp'];

	if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['mdp']))
	{


		if(!empty($_POST['email']))
		{
			// verification doublon email
			$email=$_POST['email'];
				
			$sql = "SELECT ID_utilisateurs
					FROM utilisateurs
					WHERE Email = '$email'";
			$res = $bdd -> query($sql);
			$row = $res ->fetch();
			

			if(!empty($row))
			{	
				echo'Email déjà utilisé.';
			}
			elseif(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['mdp']))
			{

				
									
				//hachage du mot de passe
				$mdp_hache = sha1($_POST['mdp']);
				
						
				//insertion dans la table utilisateurs des infos de la personne lors de son inscription
				$reponse =$bdd->prepare('INSERT INTO utilisateurs(Nom,Prenom,Email,Mot_de_passe,Membre_depuis) 
										 VALUES(:nom,:prenom,:email,:mdp,:date_creation)');
						
				$reponse->execute(array(
						'nom'=>$_POST['nom'],
						'prenom'=>$_POST['prenom'],
						'email'=>$_POST['email'],
						'mdp'=>$mdp_hache,
						'date_creation'=>date("Y-m-d H:i:s")));


				//Recherche de l'id utilisateur pour le mettre dans la table peche
				$lecture=$bdd ->prepare('SELECT ID_utilisateurs, Prenom 
										 FROM utilisateurs 
										 WHERE Email = :email AND Mot_de_passe = :mdp ');
				$lecture->execute(array(
					'email' => $_POST['email'],
					'mdp'=> $mdp_hache));	
				$resultat = $lecture->fetch();


				//Initialisation du porte monnaie de peche de la personne (peche = 20)
				$reponse2 =$bdd->prepare('INSERT INTO peche(Nombre_peche,ID_utilisateurs) 
										 VALUES(:nombre_peche,:ID_utilisateurs)');
				$reponse2->execute(array(
						'nombre_peche'=>20,
						'ID_utilisateurs'=>$resultat['ID_utilisateurs']));


				sleep(1);
				echo 'Vous vous êtes inscrit correctement !';

				
			}
			else
			{
				echo 'Vous n\'avez pas rempli tous les champs, recommencez !';
			}
		}
	}
	else
	{
		echo 'Vous n\'avez pas rempli tous les champs, recommencez !';
	}




?>