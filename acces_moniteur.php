<!DOCTYPE html>
<html>
  <meta charset="UTF-8">
    <head>
      <!-- Polices d'écriture et style CSS -->
      <link rel="stylesheet" href="css/newstyle.css">
      <link href="https://fonts.googleapis.com/css?family=Alegreya&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Crimson+Text&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lora&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Nobile&display=swap" rel="stylesheet">
      <link rel="icon" href="images/favicon.ico">
      <link rel="stylesheet" href="fonts/fonts.css" type="text/css"  />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <title>L'Autoécole du futur</title>
    </head>
    <body>
    <!-- Barre de navigation -->
    <div class="newnav">
      <div style="background-color:white">
          <a href="index.html"><img class="logo" height="54px" style="margin-left:95px;padding-bottom:9px;" src="images/logoRoro.png" alt="logo"></a>
            <!-- Menu Elèves -->
            <div style="margin-left:3.5%" class="dropdown">
                <button class="dropbtn">Elèves  <img src="images/icon_bottom.png" class="triangle" alt=""></button>
                <div class="dropdown-content">
                <a href="liste_eleves.php">Consulter un élève</a>
                <a href="ajouter_eleve2.html">Ajouter un élève</a>
                <a href="calendrier_eleve.php">Calendrier élève</a>
                <a href="statistiques_eleve.php">Statistiques élève</a>
                </div>
              </div>
          <!-- Menu Séances -->
          <div class="dropdown">
              <button class="dropbtn">Séances  <img src="images/icon_bottom.png" class="triangle" alt=""></button>
              <div class="dropdown-content">
              <a href="liste_seances.php">Afficher les séances</a>
              <a href="ajouter_seance.php">Ajouter une séance</a>
              <a href="supprimer_seance.php">Supprimer une séance</a>
              <a href="inscription.php">Inscrire un élève</a>
              <a href="desinscription.php">Désinscrire un élève</a>
              <a href="resultats.php">Saisir résultats d'une séance</a>
              </div>
            </div>
        <!-- Menu Thèmes -->
        <div class="dropdown">
            <button class="dropbtn">Thèmes  <img src="images/icon_bottom.png" class="triangle" alt=""></button>
            <div class="dropdown-content">
            <a href="liste_themes.php">Gérer les thèmes</a>
            <a href="ajouter_theme.html">Ajouter un thème</a>
            </div>
        </div>
        <a class="deco" href="index.html" style="padding:12px;float:right;margin-right:75px;">Déconnexion</a>
      </div>
      <!-- Ombre sous la barre -->
      <div class="shadow"></div>
    </div><br><br>
    <?php
      // Récupération du nom devant l'arobase
      $login = $_POST['login'];
      $password = $_POST['password'];
      $nom="";
      $cpt=0;
      while ($login[$cpt]!="@") {
        if ($login[$cpt]==".") {
          $nom=$nom." ";
        }
        else {
          $nom=$nom.$login[$cpt];
        }
        $cpt=$cpt+1;
      }
      echo "$nom";
    ?>
    <h3 style="font-size:3.5rem;text-align:left;color: #333;padding-top: 4%;position:absolute;padding-left: 5%;font-family: 'boldfont', serif;font-weight: lighter;">Bienvenue <?php echo "$nom"; ?> </h3>
    <br><br><br><br><br><br><br><br><br><br><br>
    <h2 style="margin-left: 7%;font-family: 'Roboto', sans-serif;">Utilisez les menus deroulants ou un des raccourcis rapides : </h2><br><br>
    <img src="images/voiture2.png" style="float:right;margin-top:-4%;margin-right:10%;height:300px;"alt="voiture_nitroschool">
    <div style="margin-left: 7%;height:230px;width:30%;border:3px solid black;border-radius:8px;">
      <h2 style="padding-left:12px;padding-right:12px;font-family: 'Roboto', sans-serif;width:130px;margin-top:-20px;margin-left:4%;background:white;">Raccourcis</h2>
      <br>
      <center>
      <a href="ajouter_eleve2.html" class="withinframe">Ajouter un élève</a><br><br><br>
      <a href="ajouter_seance.php" style="padding:5px 68px;" class="withinframe">Ajouter une séance</a><br><br><br>
      <a href="ajouter_theme.html" class="withinframe">Ajouter un thème</a>
      </center>
    </div>
    <!-- Pied de page -->
    <div class="bottom-container" style="margin-top:120px;">
      <a href="https://www.facebook.com/Nitroschool-105795200928016/"><img src="images/facebook.png" height="80px" alt=""></a>
      <a href="https://twitter.com/nitroschool/"><img src="images/twitter.png" height="80px" alt=""></a>
      <a href="https://www.instagram.com/nitroschool/?hl=fr/"><img src="images/instagram.png" height="80px" alt=""></a>
      <p style="word-spacing: normal ; color: white; font-size: 1em ; font-family: 'Lora', serif;";>© 2019 Benjamin Missaoui</p>
    </div>
  </body>
</html>
