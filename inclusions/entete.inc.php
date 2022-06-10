<?php
  include('config/bd.cfg.php');
  
  spl_autoload_register(function($nomClasse) {
    //nomClasse = AccesBd qu'on transforme -- acces-bd --acces-bd-cls-php
    $nomFichier = "$nomClasse.cls.php";
    if(file_exists("modeles/$nomFichier")) {
      include("modeles/$nomFichier");
    }
    else if(file_exists("controleurs/$nomFichier")) {
      include("controleurs/$nomFichier");
    }
    else {
      exit("Boommm");
    }
  });
 
 
?>
<!DOCTYPE html>
<html>
<head>
  <link href='http://fonts.googleapis.com/css?family=Cinzel+Decorative:700,900|Roboto+Slab:300,700|Roboto:700,400' rel='stylesheet' type='text/css'>
  <meta charset="UTF-8">
  <!-- TODO : enlever avant le deployment -->
  <meta name="robots" content="noindex, nofollow">
  <title>Accueil | Restaurant Leila</title>
  <meta name="description" content="Restaurant Leila - Montréal">
  <link rel="stylesheet" href="css/ext/normalize.css">
  <link rel="stylesheet" href="css/leila.css">
</head>
<body>
  <div id="conteneur" class="page-accueil">
    <header>
      <div class="barre-haut">
        <nav class="social">
          <a href="http://www.facebook.com" target="lien-externe">
            <img alt="Facebook" src="images/iu/nav-icone-facebook.svg">
          </a>
          <a href="http://www.twitter.com" target="lien-externe">
            <img alt="Twitter" src="images/iu/nav-icone-twitter.svg">
          </a>
        </nav>
        <nav class="i18n">
          <a href="#" class="actif" title="Français">fr</a>
          <a href="#" title="English">en</a>
        </nav>
      </div>