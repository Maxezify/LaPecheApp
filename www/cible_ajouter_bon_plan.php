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
	

	echo $_POST['description'];
	echo '<pre>';
	echo $_POST['date_debut'];
	echo '<pre>';
	echo $_POST['date_fin'];
	echo '<pre>';
	echo $_POST['id_commerce'];



	if(!empty($_POST['description']) AND !empty($_POST['date_debut']) AND !empty($_POST['date_fin']) AND !empty($_POST['id_commerce']))
	{




		if($_POST['date_fin']>=$_POST['date_debut'])
		{
			//Inutile
			/*$date_debut1= explode("-",$_POST['date_debut'] );
			$date_fin1 = explode("-",$_POST['date_fin']);

			$date_debut2=$date_debut1[2].'-'.$date_debut1[1].'-'.$date_debut1[0];
			$date_fin2=$date_fin1[2].'-'.$date_fin1[1].'-'.$date_fin1[0];

			echo $date_debut2;
			echo $date_fin2;*/

			$res=$bdd ->prepare('INSERT INTO bon_plan(Description, Date_debut, Date_fin, ID_commercant) 
							VALUES(:description, :date_debut, :date_fin, :ID_commercant)');

			$res->execute(array(
					'description'=>$_POST['description'],
					'date_debut'=>$_POST['date_debut'],
					'date_fin'=>$_POST['date_fin'],
					'ID_commercant'=>$_POST['id_commerce']));
				
			echo '<p>Le Bon plan a été créé ! </br> </p>';
			
		}
		else
		{
			echo 'La date de fin est antérieur à la date de début, veuillez choisir des dates correspondantes.';
		}

	}
	else
	{
		echo'Veuillez renseigner les champs';
	}




?>