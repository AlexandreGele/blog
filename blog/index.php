<?php
	require("libs/smarty.class.php"); //inclusion de smarty 
	include('includes/connexion.inc.php');
	include('includes/haut.inc.php');
	include('includes/notifications.inc.php');
	include('includes/fonctions.inc.php'); 
	   
	$connecte = false; // a modifier !!!! ////
	$smarty = new Smarty();
	$articles=array();
	
	if(isset($_COOKIE['sid']))
	{
		$sql = "SELECT * FROM utilisateurs WHERE sid='".$_COOKIE['sid']."'";	
		$result =  mysql_query($sql);
		
		if(mysql_num_rows($result))
		{
			$connecte = true;
			$util = mysql_fetch_array($result);
		}	
	}
	
	//on definit les variables pour la pagination
	$app = 3 ; // article par page
	$page = (int)var_get('p'); // page en get
	$rech = var_get('r'); // si une rech est faite
	$rech = htmlspecialchars($rech);
	$rech_encode = urlencode($rech);
	if ($page==0) $page=1;
	$debut = ($page-1)*$app ; // 
	
	//on recupere le nb d'articles
	$where = ($rech)?"WHERE texte like '%$rech%'":"";
	$sql1 = "SELECT COUNT(*) AS total FROM articles $where ;";
	$result1 = mysql_query($sql1);
	$total = mysql_fetch_array($result1);
	$total_art = $total['total'];
	
	//declaration variable pour la recherche
	$rech = var_get('r');
	
	//on calcule le nb de pages
	$nb_pages = ceil($total_art/$app);
	
	if($rech)
	{
		$titre = "Resultat pour la recherche $rech";
	}
	
	else
	{
		$titre = "Derniers Articles";
	}
?>

<h2><?php echo $titre;?></h2>

<?php
	if($rech)
	{
		$sql = "SELECT * FROM articles WHERE texte LIKE '%$rech%' ORDER BY id DESC;";
		$result = mysql_query($sql);
	}


	
	else
	{

	// on recupere les articles par tranches de $app et avec pour départ $debut
		$sql = "SELECT * FROM articles ORDER BY date DESC LIMIT $debut, $app";  
		$result = mysql_query($sql);
	}

	while($data = mysql_fetch_array($result))
	{ //boucle qui fait apparaitre la liste d'article
		
		$articles[]= $data;
		
	}
		
	$smarty->assign('articles',$articles);
	$smarty->assign('connecte',$connecte);
	$smarty->assign('app',$app); // article par page
	$smarty->assign('page',$page); // page en get
	$smarty->assign('rech',$rech); // si une rech est faite
	$smarty->assign('debut',$debut); //
	$smarty->assign('nb_pages',$nb_pages);
	$smarty->assign('rech_encode',$rech_encode);	
	$smarty->display("templates/index.phtml");
	
	include('includes/bas.inc.php');

