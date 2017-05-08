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
	



		$lecture2=$bdd ->prepare('SELECT ID_commercant
							 	  FROM commercant 
							 	  WHERE ID_utilisateurs = :ID_utilisateurs');

		$lecture2->execute(array(
					'ID_utilisateurs' => $_SESSION['ID']));	

		$resultat2 = $lecture2->fetch();

		//Recuperation des données sous forme de json
		$infos_boutique = array();
		$infos_boutique['ID_commercant'] = $resultat2['ID_commercant'];


	//echo $_POST['id_commerce'];
	//echo '<pre>';



		//cretion d'un tableau qui contiendra les infos concernat les bons plans
		$infos_bon_plan = array();
		//creation d'un second tableau qui regroupera toutes les infos de toute les bons plans + le compteur
		$tab = array();
		// initialisation de la varible i qui conptera le place de la boutique dans la bdd
		$i=1;
		//initialisation de la variable cpt qui comptera le nombre total de bon plan enregistré dans la bdd
		$cpt=0;

		//Recherche des bons plans en focntion du commerce de l'utilisateurconnecté
		$lecture=$bdd ->prepare('SELECT ID_bon_plan, Description, Date_debut, Date_fin, Status
							 FROM bon_plan 
							 WHERE ID_commercant = :ID_commercant');

		$lecture->execute(array(
					'ID_commercant' => $infos_boutique['ID_commercant'] ));	


		while($resultat = $lecture->fetch())
		{
			$cpt++;


			$infos_bon_plan['ID_bon_plan'] = $resultat['ID_bon_plan'];
			$infos_bon_plan['Description'] = $resultat['Description'];
			$infos_bon_plan['Date_debut'] = $resultat['Date_debut'];
			$infos_bon_plan['Date_fin'] = $resultat['Date_fin'];
			$infos_bon_plan['Status'] = $resultat['Status'];


			$tab[$i]=$infos_bon_plan;
			$i++;
	}		



	//on rentre le nombre total de bon plan de l'utilisa connecté dans la premiere valeur du tableau avant meme les bon plans
		$tab[0]=$cpt;

		//print_r($tab);

		//$infos_peche['Nombre_peche'] = $resultat['Nombre_peche'];
		//Recuperation des données sous forme de json
		

		echo json_encode($tab);






?>