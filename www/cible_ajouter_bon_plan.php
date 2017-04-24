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


	$date1 = new DateTime("14/02/2012");

$date2 = new DateTime("12/03/2013");

if( $date1 < $date2 ){

    echo $date2->format('d/m/Y');

}


	if(!empty($_POST['description']) AND !empty($_POST['date_debut']) AND !empty($_POST['date_fin']) AND !empty($_POST['id_commerce']))
	{
		if($_POST['date_fin']<$_POST['date_debut'])
		{
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