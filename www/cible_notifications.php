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
	

		$lecture=$bdd ->prepare('SELECT ID_notif, Paiement_peche, Message, Nom_personne_debite, ID_utilisateurs
							 	  FROM notifications 
							 	  WHERE ID_utilisateurs = :ID_utilisateurs');

		$lecture->execute(array('ID_utilisateurs' => $_SESSION['ID']));	



		//cretion d'un tableau qui contiendra les notifications
		$infos_notifications = array();
		//creation d'un second tableau qui regroupera toutes les notifications + le compteur
		$tab = array();
		// initialisation de la varible i qui conptera le place de la boutique dans la bdd
		$i=1;
		//initialisation de la variable cpt qui comptera le nombre total de bon plan enregistré dans la bdd
		$cpt=0;

		while($resultat = $lecture->fetch())
		{
			$cpt++;

			$infos_notifications['ID_notif'] = $resultat['ID_notif'];
			$infos_notifications['Paiement_peche'] = $resultat['Paiement_peche'];
			$infos_notifications['Nom_personne_debite'] = $resultat['Nom_personne_debite'];
			$infos_notifications['Message'] = $resultat['Message'];
			$infos_notifications['ID_utilisateurs'] = $resultat['ID_utilisateurs'];

			$tab[$i]=$infos_notifications;
			$i++;
	}		



	//on rentre le nombre total de notifs de l'utilisa connecté dans la premiere valeur du tableau avant meme les notifs
		$tab[0]=$cpt;

		//print_r($tab);

		//$infos_peche['Nombre_peche'] = $resultat['Nombre_peche'];
		//Recuperation des données sous forme de json
		

		echo json_encode($tab);






?>