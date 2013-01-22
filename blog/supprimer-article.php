<?php
include('includes/connexion.inc.php');
include('includes/fonctions.inc.php');

$id=(int)var_get('id');

if($id)
requete_notif("DELETE FROM articles WHERE id=$id",'article','supprime'); //fonction qui modifie et teste
header('Location:index.php');

//exit();