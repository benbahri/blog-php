<?php
$serveurBD = "localhost";
$nomUtilisateur = "root";
$motDePasse = "root";
$baseDeDonnees = "dsi_projet_buvette";
$idConnexion  =  mysqli_connect($serveurBD,$nomUtilisateur,$motDePasse)
  or die("Problème de connexion à la base!!");

$connexionBase = mysqli_select_db($idConnexion, $baseDeDonnees)
  or die("Problème de selection de la base!!");
?>
