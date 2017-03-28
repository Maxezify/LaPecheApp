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
	

	echo $_POST['nom'];
	echo '<pre>';
	echo $_POST['prenom'];
	echo '<pre>';
	echo $_POST['email'];
	echo '<pre>';
	echo $_POST['mdp'];


	if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['mdp']))		
	{
							
		//hachage du mot de passe
		$mdp_hache = sha1($_POST['mdp']);
				
		//insertion dans la bdd
		$reponse =$bdd->prepare('INSERT INTO utilisateurs(Nom,Prenom,Email,Mot_de_passe,Membre_depuis) 
								 VALUES(:nom,:prenom,:email,:mdp,:date_creation)');
				
		$reponse->execute(array(
				'nom'=>$_POST['nom'],
				'prenom'=>$_POST['prenom'],
				'email'=>$_POST['email'],
				'mdp'=>$mdp_hache,
				'date_creation'=>date("Y-m-d H:i:s")));

				echo '<p>Vous vous êtes inscrit correctement ! </br> </p>';

			
	}
	else
	{
		echo 'Vou n\'avez pas rempli tous les champs, recommencez !';
	}




?>