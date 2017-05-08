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
	

	echo $_POST['nom_commerce'];
	echo '<pre>';
	echo $_POST['montant'];
	echo '<pre>';
	echo $_POST['solde'];
	echo '<pre>';
	echo $_POST['nom'];
	echo '<pre>';
	echo $_POST['prenom'];
	echo '<pre>';




	if(!empty($_POST['nom_commerce']) AND !empty($_POST['montant']) AND !empty($_POST['solde']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']))
	{

		//Recherche  de l'id  du commercant corrspondant aux nom de la boutique entré par l'utilisateur
		$req = $bdd ->prepare('SELECT ID_commercant, Nom_boutique, ID_utilisateurs
			   FROM commercant
			   WHERE Nom_boutique = :nom_boutique');

		$req->execute(array("nom_boutique"=>$_POST['nom_commerce']));

		$resultat = $req->fetch();

		$id_utilisateurs_du_commercant =  $resultat['ID_utilisateurs'];

		//Verif avec ce if si le nom de la boutique existe dans la bdd
		if($_POST['nom_commerce'] == $resultat['Nom_boutique'])
		{
			//verif avec ce if et cette expression reguliere si dans le champs entré par l'utilisateur, il y a bien un nombre
			if(preg_match("#^[0-9]+$#", $_POST['montant']))
			{
				//verif avec ce if si le nombre rentré ne depasse pas le solde de l'utilisateur
				if($_POST['montant']>$_POST['solde'])
				{
					echo 'Veuillez renseigner un montant inferieur ou égal à votre solde.';
				}
				else
				{

					//Récupération de l'ancien nombre de pêche du commercant
					$req2 = $bdd ->prepare('SELECT Nombre_peche
								   			FROM peche
								   			WHERE ID_utilisateurs = :id');

					$req2->execute(array("id"=>$id_utilisateurs_du_commercant));
					$resultat2 = $req2->fetch();

					$nb_peche_commercant_ancien =  $resultat2['Nombre_peche'];


					//Modification (Ajout) du nombre de peche du commercant
					$req3 = $bdd ->prepare('UPDATE peche 
											SET Nombre_peche = :nombre_peche
											WHERE ID_utilisateurs= :ID_utilisateurs');

					$req3->execute(array(
									'nombre_peche' => $nb_peche_commercant_ancien + $_POST['montant'],
									'ID_utilisateurs' => $id_utilisateurs_du_commercant));

					//Ajout du montant et de la persoone qu'il vient de recevoir dans la table notif
					$nom_complet = $_POST['prenom'].' '.$_POST['nom'];
					$req5 = $bdd ->prepare('INSERT INTO notifications(Paiement_peche, Nom_personne_debite, ID_utilisateurs) 
											VALUES (:paiement_peche, :nom_personne_debite, :ID_utilisateurs)');

					$req5->execute(array(
									'paiement_peche' => $_POST['montant'],
									'nom_personne_debite' => $nom_complet,
									'ID_utilisateurs' => $id_utilisateurs_du_commercant));


					//Modification (Retrait) du nombre de peche de l'utilisateur connecté
					$req4 = $bdd ->prepare('UPDATE peche 
											SET Nombre_peche = :nombre_peche
											WHERE ID_utilisateurs= :ID_utilisateurs');

					$req4->execute(array(
									'nombre_peche' => $_POST['solde'] - $_POST['montant'],
									'ID_utilisateurs' => $_SESSION['ID']));

					echo 'Achat Effectué !';

					

				}

			}
			else
			{
				echo 'Le montant doit être un nombre (sans espace).';
			}

		}
		else
		{
			echo 'Veuillez rentrer un nom de Boutique correspondant à la liste.';
		}
		
	}
	else
	{
		echo 'Un ou plusieurs champs n\'ont pas été remplis, veuillez vérifier.';
	}

	echo 'gfh';







?>