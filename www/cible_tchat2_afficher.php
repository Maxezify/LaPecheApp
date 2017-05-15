<?php


	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=application;charset=utf8','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	

	//echo $_POST['id_utili'];
	//echo '<pre>';




		//cretion d'un tableau qui contiendra les messages + nom des gens
		$mess = array();
		//creation d'un second tableau qui regroupera toutes les infos des messages  + le compteur
		$tab = array();
		// initialisation de la varible i qui conptrara le numéro du message dans la bdd
		$i=1;
		//initialisation de la variable cpt qui comptera le nombre total de message enregistré dans la bdd
		$cpt=0;




	//ORDER BY ID_tchat DESC LIMIT 0,10'
	$req = $bdd ->query('SELECT * FROM tchat ORDER BY ID_tchat DESC LIMIT 0,10');

	/*$resultat = $req->fetch();
	echo $resultat['ID_tchat'];*/
	while($resultat = $req->fetch())
	{

    	$cpt++;

		$mess['ID_tchat'] = $resultat['ID_tchat'];
		$mess['Nom_personne'] = $resultat['Nom_personne'];
		$mess['Message'] = $resultat['Message'];
		$mess['ID_utilisateurs'] = $resultat['ID_utilisateurs'];

		$tab[$i]=$mess;
		$i++;
	}		



	//on rentre le nombre total de message  dans la premiere valeur du tableau avant meme les messages
	$tab[0]=$cpt;

	//print_r($tab);
	//Recuperation des données sous forme de json

		

	echo json_encode($tab);

	//echo $mess['ID_tchat'];


    

	

		

?>