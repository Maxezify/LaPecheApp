<?php


	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=application;charset=utf8','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	}
	catch(Exception $e)
	{
		die('Erreur : '.$e->getMessage());
	}
	
	

	
	echo $_POST['message'];
	echo '<pre>';
	echo $_POST['id_utili'];
	echo '<pre>';
	echo $_POST['prenom'];
	echo '<pre>';
	echo $_POST['nom'];
	echo '<pre>';



	// si les variables ne sont pas vides
	if(!empty($_POST['message']) AND !empty($_POST['id_utili']) AND !empty($_POST['prenom'])  AND !empty($_POST['nom']))
	{ 

    
		// nom complet
        $nom_personne = $_POST['prenom'].' '.$_POST['nom'];



        // puis on entre les données en base de données :

        $insertion = $bdd->prepare('INSERT INTO tchat(Nom_personne, Message, ID_utilisateurs) VALUES(:nom_personne, :message, :ID_utilisateurs)');

        $insertion->execute(array(
            'nom_personne' => $nom_personne,
            'message' => $_POST['message'],
            'ID_utilisateurs' => $_POST['id_utili']
        ));


    }
    else
    {
        echo "Vous avez oublié de remplir un des champs !";
    }


		

?>