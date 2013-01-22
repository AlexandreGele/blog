<?php
	
	include('includes/connexion.inc.php');
	include('includes/fonctions.inc.php');
	
	if(!isset($_POST['connexion']))
	{
		include('includes/haut.inc.php'); 
	}
	
	$email_ok='email';
	$mdp_ok='mdp';
	
	$id = (int)var_get('id');
	
	if ($id)
	{
		setcookie('sid', '', 1);
		header ('Location:index.php');	
	}
	
	
	if (isset($_POST['connexion']))
	{
		$email = mysql_real_escape_string(var_post('email'));
		$mdp = mysql_real_escape_string(var_post('password'));
		
		if (!$email || !$mdp)
		{
			connecte_notif(0, 'utilisateur', 'erreur-login-password-vide');
			header('location:conn.php');
			exit();
		}
		
		$sql = 'SELECT email, mdp FROM utilisateurs WHERE email = "'.$email.'" AND mdp = "'.$mdp.'" LIMIT 1' ;
		$requete = mysql_query($sql);
		
		if(mysql_num_rows($requete) == 0)
		{
			connecte_notif(0, 'utilisateur', 'erreur-login');
			header('location:conn.php');
			exit();
		}
		
		else
		{
			$sid=md5($email.time());
			
			$sql="UPDATE utilisateurs SET sid = '$sid' WHERE email = '$email'";
			$requete = mysql_query($sql);
			setcookie('sid', $sid, time()+15*60);
			connecte_notif(0, 'utilisateur', 'connecte');
			header('location:index.php');
			exit();
		
			
		}
	}
	
	?>

<h5>Veuillez remplir les champs suivants pour vous connecter : </h5>
	<form  id="form_connexion" action="conn.php" method="post">
    	<label>E-mail :</label><input type="text" name="email" id="email" placeholder="Votre email"></br>
        <label>Mot de Passe :</label><input type="password" name="password" id="password" placeholder="Votre mot de passe""></br>
        <input type ="submit" value = "connexion" name="connexion" id="connexion">
   	</form>
	<script type="text/javascript">
		$(function() { 
			$(" #form_connexion").submit(function(){
			  var email = $("#mail").val();
			  var mdp = $("#password").val();
			    	if (!email || !mdp ) {
					//console.debug("Aie !"); //affichage dans debugger
					$("#notif").hide();
					$("#notif span").html("ERREUR : Veuillez remplir tous les champs");
					$("#notif").removeClass();
							   .addClass("alert-error")
							   .show()
							   
				 return false;
				}
				
				else {
				return true;}
			});
		});
	</script>


<?php
	include('includes/bas.inc.php');
?>