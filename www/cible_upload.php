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
	

	echo $_FILES['file']['name'];

	if ($_FILES['file']['error'] > 0) 
	{
		echo "Erreur lors du transfert";
	}
	else
	{
		if ($_FILES['file']['size'] > 1048576) 
		{
			echo "Le fichier est trop gros";
		}
		else
		{

			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
			//1. strrchr renvoie l'extension avec le point (« . »).
			//2. substr(chaine,1) ignore le premier caractère de chaine.
			//3. strtolower met l'extension en minuscules.
			$extension_upload = strtolower(  substr(  strrchr($_FILES['file']['name'], '.')  ,1)  );

			//comparaison des l'extension upload avec ceux dans le tableau extension valid
			if (in_array($extension_upload,$extensions_valides)) 
			{
				echo "Extension correcte";

				//Créer un dossier 'fichiers/1/'
				mkdir('avatars/1/', 0777, true);




				/*$sourcePath = $_FILES['file']['tmp_name'];
				$targetPath = "upload/".$_FILES['file']['name'];
				move_uploaded_file($sourcePath,$targetPath);
				echo 'Reussi';*/


				$nom = "avatars/1/jean.{$extension_upload}";
				$resultat = move_uploaded_file($_FILES['file']['tmp_name'],$nom);

				if ($resultat) 
				{
					echo "Transfert réussi";
				}

			}
			else
			{
				echo 'Extension incorrecte' ;
			}
		}
	}









?>