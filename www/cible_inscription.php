<?php
	//print_r($_POST);

	try
	{
		$bdd = new PDO('mysql:host=maxencegcordova.mysql.db;dbname=maxencegcordova;charset=utf8','maxencegcordova','Azerty123',
		array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	

	echo $_POST['pseudo'];
	echo '<pre>';
	echo $_POST['mdp'];


	if(!empty($_POST['pseudo']) AND !empty($_POST['mdp']))		
	{



				//echo 'Le ' . $_POST['telephone'] . ' est un numéro <strong>valide</strong> !';
							
				//hachage du mot de passe
				//$mdp_hache = sha1($_POST['mdp']);
				
				//insertion dans la bdd
		$reponse =$bdd->prepare('INSERT INTO membres(nom,mdp) VALUES(:nom,:mdp)');
				
		$reponse->execute(array(
				'nom'=>$_POST['pseudo'],
				'mdp'=>$_POST['mdp']));

				echo '<p>Vous vous êtes inscrit correctement ! </br> </p>';

			
	}
	else
	{
		echo 'Vou n\'avez pas rempli tous les champs, recommencez !';
	}




?>