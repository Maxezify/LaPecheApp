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
	

	echo $_POST['nom_commerce_mp'];
	//echo '<pre>';

	if(!empty($_POST['nom_commerce_mp']))
	{
		echo $_POST['nom_commerce_mp'];
	}
	else
	{
		echo 'Veuillez selectionner le nom du commerce avec qui vous voulez discuter.'
	}






?>