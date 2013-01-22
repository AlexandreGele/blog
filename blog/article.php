<?php 
	include('includes/connexion.inc.php');
	include('includes/fonctions.inc.php'); 
	
	define('cible_vign', 'img/vign/');
	
	//pour la modification
	$id =(int)var_get('id');
	$action_label=($id)?'modifie':'ajoute';
	
	//var_dump($_FILES['image']['size']);
	
	if ($id)
	{
		$resultat = mysql_query("SELECT * FROM articles WHERE id='$id'"); 
		$data = mysql_fetch_array($resultat);
	}

	if (isset($_POST['post']))
	{
		//vérification des valeurs entrées
		$titre= var_post('titre');
		$texte= var_post('texte');	
		
		if (!$titre || !$texte)
		{
			/*<div class='alert alert-error'>
				Veuillez saisir tous les champs.
			</div>*/
			
		}
		
		else
		{
			$titre = mysql_real_escape_string($titre);
			$texte = mysql_real_escape_string($texte);
			$id=(int)var_post('id');
			
			if ($id)
			{
				requete_notif("UPDATE articles SET titre='$titre', texte='$texte' WHERE id='$id'",'article','modifie'); //fonction qui modifie et teste
			}
			
			else
			{
				requete_notif("INSERT INTO articles (titre, texte) VALUES ('$titre','$texte')",'article','ajoute'); //fonction ajoute et teste
			}
			//redirection !
			//header('Location:index.php'); 
			
			//exit();
		}
		
		if (!empty($_FILES['image']))
		{
			//variables pour la verification et l'upload de l'image
			$image =  $_FILES['image'];
			$erreur = $_FILES['image']['error'];
			$type = $_FILES['image']['type'];
			//$taille = $_FILES['image']['size'];
			$taille = getimagesize($_FILES['image']['tmp_name']);
			$dossier = '/img';
		
			if ($erreur == 0)	
			{
				//upload_notif('image','ajoute'); //fonction ajoute et teste
				
				//ON va chercher l'iD correspondant
				$sql = "SELECT id FROM articles WHERE titre='$titre' AND texte='$texte'";
				$req = mysql_query($sql);
				
				$data = mysql_fetch_array($req);
				$id = $data['id'];
				
				if ($type != 'image/jpeg')
				{
					echo ("L'image doit être en JPEG"); 	
				}
				
				if ($taille[0] > 1024 && $taille[1] >500)
				{
					echo ("la taille de l'image est trop grandee");	
				}
				
				$dossier=dirname(__FILE__)."/img/$id.jpg"; // chemin absolu
				
				$cheminImage= $_FILES['image']['tmp_name']; //recupere l’image dans le dossier temporaire lors de l’upload
				//$largeur = 200; //tu definie une largeur pour la vignette
				//$hauteur=200; /// idem pour la hauteur
				$imageSource = imagecreatefromjpeg($cheminImage); //crée une copie de l’image temporaire
				$imageDestination= imagecreatetruecolor(300, 150); // crée une image vide pour ta vignette
				imagecopyresampled($imageDestination, $imageSource, 0, 0, 0,0, 300, 150, $taille[0], $taille[1]); //
				header("Content-Type: image/jpeg");
				imagejpeg($imageDestination,cible_vign.$id.'.jpg',100); // il copie dans le repertoire
				move_uploaded_file($_FILES['image']['tmp_name'],$dossier);
				
				
			}
			
			/*if ($taille > 500*1024)		
			{
				echo("La taille de l'image est trop voilumineuse");
			}
			
			if ($type != 'image/jpeg')		
			{
				echo("Euh et' n'image elle est pô en jpeg ti batarrrrd");
			}*/
		}
	}
	
echo ("<h2>".$action_label." un article</h2>");
include('includes/haut.inc.php');
		?>
<form action="article.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name='post' value="1"> <!-- Permet de savoir si on se trouve en traitement -->
	<input type="hidden" name='id' value="<?php if (isset($id)) echo $id; ?>"> <!-- Permet de savoir si on se trouve en modification -->
    
	
	<div class="clearfix">
		<label for="titre">Titre</label>
		<div class="input"><input type="text" name="titre" id="titre" value="<?php if (isset($data['titre'])) echo $data['titre']; ?>"></div> 
	</div>
	
	<div class="clearfix">
		<label for="texte">Texte</label>
		<div class="input"><textarea name="texte" id="texte"><?php if (isset($data['texte'])) echo $data['texte']; ?></textarea></div> 
	</div>
	
	<div class="clearfix">
		<div class="input"><input type="checkbox" name="publie" id="publie" value="1"><label for="publie">Publier</label></div> 
	</div>
	
    <div class="clearfix">
    	<label for="tag">Tag</label>
		<div class="input"><input type="text" name="tag" id="tag" value="<?php if (isset($data['tag'])) echo $data['tag']; ?>"></div> 
	</div>
    
	<div class="clearfix">
    	<input type="file" name="image" id="image">
    </div>
	
	
	
	<div class="form-actions">
		<input type="submit" value="<?php echo $action_label; ?>" class="btn btn-large btn-primary"> 
	</div>
</form>
<?php
require_once('includes/bas.inc.php');