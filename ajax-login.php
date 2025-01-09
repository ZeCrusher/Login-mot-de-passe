<?php
	session_start();

	// Définit l'en-tête de la réponse pour indiquer que le contenu est du JSON
	header('Content-Type: application/json; charset=utf-8');


	/* *************************************************************************************/
	// Connexion à la base de données
	/* *************************************************************************************/
    $servername 	= "localhost";
    $username 		= "ot-martigues";
    $db_password 	= "Ftp699M";
    $dbname 		= "ot-martigues";
	$encryption_key = "GargleBlasterPangalactique"; 
 	$base = mysqli_connect($servername , $username , $db_password ,$dbname);	
	/* ************************************************************************************ */

	/* *************************************************************************************/
	// Récupère les données envoyées via POST (corps de la requête JSON)
	/* *************************************************************************************/
	$input = file_get_contents('php://input');
	$data = json_decode($input, true); // Convertit le JSON en tableau PHP
	/* ************************************************************************************ */

	// $data['email']="webmaster@martigues-tourisme.com";
	// $data['password']="mclaren";	

	/* 
	* Récupère les données envoyées via POST (corps de la requête JSON)
	*/	
	
 	$sql='SELECT * FROM membre WHERE email = "'.$data['email'].'"';

	/*
	*
	* Le mot de passe est sauvegardé dans pass_md5
	* La variable "iv" est sauvegardé dans droit	
	*	
	*/

	$result = mysqli_query($base,$sql) or die(mysqli_error($base)." CONT=".$sql);
	$datasql = mysqli_fetch_array($result);
	
	/* Déchiffrer le mot de passe et comparer */

	$decrypted_password=openssl_decrypt(base64_decode($datasql['password']), "AES-128-CBC", $encryption_key, 0, base64_decode($datasql['iv']));

	// Si les informations d'identification sont correctes
	if ($data['password'] === $decrypted_password) {
			// Génération de la réponse en cas de succès
			$response = [
				"success" => true,
				"token" => bin2hex(random_bytes(16)), // Génération d'un token aléatoire
				"resetPassword" => false, // Exemple : pas besoin de réinitialisation de mot de passe
				"permissions" => ["read", "write", "delete"], // Permissions fictives
				"message" => "Bravo ! Connexion réussie !"
			];
			
			
				$sql 	= 'SELECT * FROM membre WHERE email="'.$data['email'].'"';
				$result = mysqli_query($base,$sql)  or die(mysqli_error($base)." select=".$sql);
				$datasql 	= mysqli_fetch_array($result);
				
				$_SESSION['login'] 						= ucfirst($datasql['login']);	
				
				$_SESSION['service'] 					= $datasql['compte'];
				$_SESSION['edit_message'] 			 	= $datasql['edit_message'];
				$_SESSION['sup_message'] 			 	= $datasql['sup_message'];		
				$_SESSION['affichage_calendrier'] 	 	= $datasql['affichage_calendrier'];		
				$_SESSION['menu_visite'] 			 	= $datasql['menu_visite'];		
				$_SESSION['menu_visible'] 			 	= $datasql['menu_visible'];	
				$_SESSION['todo']					 	= $datasql['todo'];					
				$_SESSION['mini_calendrier'] 			= $datasql['mini_calendrier'];	
				$_SESSION['menu_mouse'] 				= $datasql['menu_mouse'];		
				$_SESSION['theme'] 						= $datasql['theme'];		
				$_SESSION['droit'] 						= $datasql['droit'];					
				$_SESSION['livre_intra_reponses']		= $datasql['livre_intra_reponses'];	
	} 
	else 
	{

		if (md5($data['password'])==$datasql['pass_md5'])		
		{
		
			// Génération de la réponse en cas de succès
			$response = [
				"success" => true,
				"token" => bin2hex(random_bytes(16)), // Génération d'un token aléatoire
				"email" => $data['email'],
				"resetPassword" => true, // Exemple :  besoin de réinitialisation de mot de passe
				"permissions" => ["read", "write", "delete"], // Permissions fictives
				"message" => "Attention, Vous devez votre mot de passe"
			];
			$data['login']==$_POST['login'];
		}
		else
		{
			// Mauvaises informations d'identification
			$response = [
				"success" => false,
				"message" => "Nom d'utilisateur ou mot de passe incorrect."
			];
		}
	}

	// Envoie la réponse JSON
	echo json_encode($response);

/* 		
*  tracage : Création d'un fichier dans /log/tracage.log qui sert de traceur AJAX         		
*/ 
	
	function tracage($texte) {
		// Si on peut déterminer l'adresse IP
		$adresse_ip = Null;
		if(isset($_SERVER['REMOTE_ADDR'])) {
			$adresse_ip = '"'.$_SERVER['REMOTE_ADDR'].'"';
		}
		$txt_log=$adresse_ip.';'.date('d/m/Y H:i:s').';'.$texte."\n";
		// écriture dans un fichier de traçage
		// $fichier = "log/tracage_".date('Ymd').".log";
		$fichier = "tracage.txt";
		preg_match("`^(.*\/)([^\/]+)$`",$_SERVER['SCRIPT_FILENAME'], $matches);
		$chemin_script = $matches[1];
		$fichierCible = $chemin_script.$fichier;
		$myFile=fopen($fichierCible,'a+');
		fputs($myFile,$txt_log);
		fclose($myFile);
	}

?>	