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
	

	//On va récuprer l'ID commercant
	$lecture2=$bdd ->prepare('SELECT ID_commercant
						 	  FROM commercant 
						 	  WHERE ID_utilisateurs = :ID_utilisateurs');

	$lecture2->execute(array('ID_utilisateurs' => $_SESSION['ID']));	

	$resultat2 = $lecture2->fetch();

	$infos_boutique = array();
	$infos_boutique['ID_commercant'] = $resultat2['ID_commercant'];
	//------------------------------------------------------------------------------


	//On va récupérer la date du jour
	$date = date("Y-m-d");

	//On va récuprer les dates des bon plans ainsi que le satut qu'on actualisera
	$lecture=$bdd ->prepare('SELECT ID_bon_plan, Date_debut, Date_fin, Status
					 		 FROM bon_plan 
					 		 WHERE ID_commercant = :ID_commercant');

	$lecture->execute(array('ID_commercant' => $infos_boutique['ID_commercant']));	

	while($resultat3 = $lecture->fetch())
	{	
		//$resultat3 = $lecture->fetch();

		echo $resultat3['ID_bon_plan'];
		//Ex: 2017-04-28 > 2017-04-26
		if($date>$resultat3['Date_fin'])
		{


			$res=$bdd ->prepare('UPDATE bon_plan
								SET Status = :status
								WHERE ID_commercant = :ID_commercant and ID_bon_plan=:id_bon_plan ');

			$res->execute(array(
						'status'=>'Ancien',
						'ID_commercant'=>$infos_boutique['ID_commercant'],
						'id_bon_plan' =>$resultat3['ID_bon_plan']));
					
				echo '<p>Le Bon plan est dépassé -> ANCIEN! </br> </p>';
		}
		else
		{
			$res=$bdd ->prepare('UPDATE bon_plan
								SET Status = :status
								WHERE ID_commercant = :ID_commercant and ID_bon_plan=:id_bon_plan ');

			$res->execute(array(
						'status'=>'En cours',
						'ID_commercant'=>$infos_boutique['ID_commercant'],
						'id_bon_plan' =>$resultat3['ID_bon_plan']));
					
			echo '<p>Le Bon plan est EN COURS !</br> </p>';	
		}

	}





?>