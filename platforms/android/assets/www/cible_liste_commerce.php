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
	

		//cretion d'un tableau qui contiadra les infos d'une boutique boutiques
		$infos_commerce = array();
		//creation d'un second tableau qui regroupera toutes les infos de toutes les boutqies + le compteur
		$tab = array();
		// initialisation de la varible i qui conptrara le place de la boutique dans la bdd
		$i=1;
		//initialisation de la variable cpt qui comptera le nombre total de boutique enregistré dans la bdd
		$cpt=0;


		//Recherche de toutes infos concernat les commerces
		$lecture=$bdd ->query('SELECT ID_commercant, Nom_boutique, Description, Ville, Adresse, Horaire, ID_utilisateurs
							 	 FROM commercant');

		while($resultat = $lecture->fetch())
		{
			$cpt++;

			$i=$resultat["ID_commercant"];
			$infos_commerce['Nom_boutique']=$resultat['Nom_boutique'];
			$infos_commerce['Description']=$resultat['Description'];
			$infos_commerce['Ville']=$resultat['Ville'];
			$infos_commerce['Adresse']=$resultat['Adresse'];
			$infos_commerce['Horaire']=$resultat['Horaire'];


			$tab[$i]=$infos_commerce;



			/*echo $resultat['Nom_boutique'];
			echo $resultat['Description'];
			echo $resultat['Ville'];
			echo $resultat['Adresse'];
			echo $resultat['Horaire'];*/


		}
		
		//on rentre le nombre total de commerce dans la premiere valeur du tableau avant meme les infos des commerces
		$tab[0]=$cpt;

		//print_r($tab);

		//$infos_peche['Nombre_peche'] = $resultat['Nombre_peche'];
		//Recuperation des données sous forme de json
		

		echo json_encode($tab);



?>